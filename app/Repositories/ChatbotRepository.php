<?php

namespace App\Repositories;

use App\Models\Chatbot;
use App\Repositories\ChatbotRepositoryInterface;

class ChatbotRepository implements ChatbotRepositoryInterface
{
    /**
     * @var App\Models\Chatbot
     */
    protected $model;

    /**
     * Constrcutor.
     *
     * @param Todo $model
     */
    public function __construct(Chatbot $model)
    {
        $this->model = $model;
    }

    /**
     * @inheritDoc
     */
    public function all()
    {
        return $this->model->all();
    }


    /**
     * @inheritDoc
     */
    public function store(array $data)
    {
        return $this->model->create($data);
    }
}
