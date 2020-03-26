<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateTask;
use App\Http\Requests\SearchTask;
use App\Http\Resources\TaskResource;
use App\Models\Status;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index(SearchTask $request)
    {
        try{
            $tasks = Task::StatusOrder($request)->get();
        }catch (\Exception $exception){
            return response()->json([
                'error' => $exception->getMessage(),
            ]);
        }
        return TaskResource::collection($tasks);
    }

    public function store(CreateTask $request)
    {
        try{
           $status = ['status_id' => Status::where('status','View')->first()['id']];
           $task = Task::create(array_merge($request->only(['title', 'description','user']),$status));
        }catch (\Exception $exception){
            return response()->json([
                'error' => $exception->getMessage(),
            ]);
        }
        return new TaskResource($task);
    }

    public function show($id)
    {
        try{
            $task = Task::findOrFail($id);
        }catch (\Exception $exception)
        {
            return response()->json([
                'error' => $exception->getMessage(),
            ]);
        }
        return new TaskResource($task);
    }

    public function update(Request $request, $id)
    {
        try{
            $status = $request->status ? ['status_id' => $request->status]:[];
            $task = Task::where('id', $id)->update(array_merge($request->only(['title', 'description','user']),$status));
            if($task){
                $task = Task::findOrFail($id);
            }else{
                throw new \Exception(__('messages.updateFailed'));
            }
        }catch (\Exception $exception){
            return response()->json([
                'error' => $exception->getMessage(),
            ],500);
        }
        return new TaskResource($task);
    }

    public function destroy($id)
    {
        try{
            $task = Task::findOrfail($id);
            Task::destroy($id);
        }catch (\Exception $exception){
            return response()->json([
                'error' => $exception->getMessage(),
            ],500);
        }
        return new TaskResource($task);
    }
}
