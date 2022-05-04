<?php

use App\Http\Controllers\BotManController;
use BotMan\BotMan\Messages\Incoming\Answer;

$botman = resolve('botman');

$botman->hears('Hi', BotManController::class . '@startConversation');

$botman->fallback(function ($bot) {
    $bot->reply("Sorry I can't understand! Please type 'Hi' to start conversation again.");
});
