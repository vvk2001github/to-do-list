<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTaskRequest;
use App\Http\Requests\PaginateRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Http\Resources\TaskResource;
use App\Http\Services\TaskService;
use App\Models\Task;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class TaskController extends Controller
{
    /**
     * @param \App\Http\Requests\PaginateRequest $request
     * @return AnonymousResourceCollection
     */
    public function index(PaginateRequest $request): AnonymousResourceCollection
    {
        $tasks = Task::orderBy('id', 'asc')->paginate(request('per_page'));

        return TaskResource::collection($tasks);
    }

    /**
     * @param \App\Http\Requests\CreateTaskRequest $request
     * @return JsonResponse|TaskResource
     */
    public function store(CreateTaskRequest $request): JsonResponse|TaskResource
    {
        try {
            $task = Task::create($request->all());
        } catch (\Exception $e) {
            return response()->json(['message' => 'Сouldn\'t create a task'], JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
        }

        return TaskResource::make($task);
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
