<?php

namespace App\Repositories;

use App\Models\Chatbot;
use Illuminate\Http\Request;

interface ChatbotRepositoryInterface
{
    /**
     * Get all todos.
     *
     * @return Collection
     */
    public function all();

    /**
     * Store new todo.
     *
     * @param  array $data
     * @return Collection
     */
    public function store(array $data);
}
