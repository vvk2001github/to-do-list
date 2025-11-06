<?php

namespace App\Http\Services;

use App\Exceptions\TaskNotFoundException;
use App\Models\Task;

class TaskService
{
    /**
     * Получаем модель Task по её id
     * @param int $taskId
     * @throws \App\Exceptions\TaskNotFoundException
     * @return Task|\Illuminate\Database\Eloquent\Builder<Task>
     */
    public static function getTask(int $taskId): Task
    {
        $task = Task::find($taskId);
        if (!$task) {
            throw new TaskNotFoundException();
        }

        return $task;
    }
}