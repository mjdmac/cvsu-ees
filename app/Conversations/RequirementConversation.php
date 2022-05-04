<?php

namespace App\Conversations;

use App\Models\Chatbot;
use App\Repositories\ChatbotRepositoryInterface;
use BotMan\BotMan\Messages\Incoming\Answer;
use BotMan\BotMan\Messages\Outgoing\Question;
use BotMan\BotMan\Messages\Outgoing\Actions\Button;
use BotMan\BotMan\Messages\Conversations\Conversation;

class RequirementConversation extends Conversation
{

    protected $repo;

    public function __construct()
    {
        $this->repo = app(ChatbotRepositoryInterface::class);
    }

    public function run()
    {
        $concerns = $this->repo->all()->where('category', 'Requirements');

        $buttons = [];

        foreach ($concerns as $concern) {
            $buttons[] = Button::create($concern->question)
                ->value($concern->id)
                ->name('concern');
        }
        $buttons[] = Button::create('Didn\'t see any question related to your concern?')
            ->value('other')
            ->name('other_concern');


        $question = Question::create("Find any related question to your concern.")
            ->fallback('Can not fetch all questions')
            ->callbackId('ask_all_questions')
            ->addButtons($buttons);

        $this->ask($question, function (Answer $answer) {
            if ($answer->isInteractiveMessageReply()) {
                $this->handleValue($answer->getValue());
            }
        });
    }

    public function handleValue(string $id)
    {
        $chatbot = Chatbot::find($id);
        $botman = resolve('botman');

        if ($id === "other") {
            $this->say("If you have other concerns, please contact admission@cvsu.edu.ph");
        } else {
            $this->bot->reply("Question: " . $chatbot->question . "<br>Answer: " . $chatbot->answer);
        }

        $question = Question::create("Do you have other concern?")
            ->fallback('Can not fetch question')
            ->callbackId('ask_question')
            ->addButtons([
                Button::create("Yes")->value("yes")->name('yes_chat'),
                Button::create("No")->value("no")->name('no_chat'),
            ]);

        $this->ask($question, function (Answer $answer) use ($id) {
            if ($answer->getValue() == 'yes') {
                $this->bot->startConversation(new OptionConversation());
            } elseif ($answer->getValue() == 'no') {
                $this->bot->reply("If you have other concerns, please contact admission@cvsu.edu.ph");
                $this->bot->reply("Thank you. Type 'Hi' to start new conversation.");
            }
        });
    }
}
