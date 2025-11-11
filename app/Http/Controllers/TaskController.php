<?php

namespace App\Http\Controllers;

use App\Exceptions\TaskNotFoundException;
use App\Http\Requests\CreateTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Http\Resources\TaskResource;
use App\Http\Services\TaskService;
use App\Models\Task;
use Illuminate\Http\Client\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class TaskController extends Controller
{
    /**
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        return TaskResource::collection(Task::orderBy('id', 'asc')->get());
    }

    /**
     * @param \App\Http\Requests\CreateTaskRequest $request
     * @return JsonResponse
     */
    public function store(CreateTaskRequest $request): JsonResponse
    {
        $task = Task::create($request->all());

        return (new TaskResource($task))
            ->response()
            ->setStatusCode(\Symfony\Component\HttpFoundation\Response::HTTP_CREATED);
    }

    /**
     * @param int $taskId
     * @return TaskResource
     */
    public function show(int $taskId): TaskResource|JsonResponse
    {
        $task = TaskService::getTask($taskId);

        return TaskResource::make($task);
    }

    /**
     * @param \App\Http\Requests\UpdateTaskRequest $request
     * @param int $taskId
     * @return TaskResource
     */
    public function update(UpdateTaskRequest $request, int $taskId): TaskResource|JsonResponse
    {
        $task = TaskService::getTask($taskId);

        $validatedData = $request->validated();
        $task->update($validatedData);

        return TaskResource::make($task);
    }

    /**
     * @param int $taskId
     * @return \Illuminate\Contracts\Routing\ResponseFactory
     */
    public function destroy(int $taskId): mixed
    {
        $task = TaskService::getTask($taskId);

        $task->delete();
        return response(null, JsonResponse::HTTP_NO_CONTENT);
    }
}
