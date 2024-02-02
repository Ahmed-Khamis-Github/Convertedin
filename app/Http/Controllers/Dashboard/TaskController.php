<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\TaskRequest;
use App\Models\Admin;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Statistics;


class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tasks = Task::with(['admin', 'assignedTo'])
            ->orderByDesc('created_at')  
            ->paginate(10);

        return view('dashboard.tasks.index', compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Retrieve the list of admins and non-admin users
        $admins = Admin::all();
        $users = User::all();

        return view('dashboard.tasks.create', compact('admins', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TaskRequest $request)
    {
        $validatedData = $request->validated();
        // dd($validatedData) ;

        Task::create($validatedData);


        // Update or create statistics for the assigned user
        $assignedUserId = $validatedData['assigned_to_id'];

        $currentTaskCount = Statistics::where('user_id', $assignedUserId)->value('task_count');

        Statistics::updateOrCreate(
            ['user_id' => $assignedUserId],
            ['task_count' => $currentTaskCount + 1]
        );

        return redirect()->route('dashboard.tasks.index')->with('success', 'Task Created Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Retrieve a single task with associated admin and assigned user

        $task = Task::with(['admin', 'assignedTo'])->findOrFail($id);

        return view('dashboard.tasks.show', compact('task'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {

        // Retrieve the list of admins and non-admin users
        $admins = Admin::all();
        $users = User::all();

        return view('dashboard.tasks.edit', compact('task', 'admins', 'users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TaskRequest $request, Task $task)
    {

        $validatedData = $request->validated();

        $task->update($validatedData);

        $assignedUserId = $validatedData['assigned_to_id'];

        // Check if the assigned user ID has changed before updating the task
        if ($task->assigned_to_id != $assignedUserId) {
            $task->update($validatedData);

            $currentTaskCount = Statistics::where('user_id', $assignedUserId)->value('task_count');

            Statistics::updateOrCreate(
                ['user_id' => $assignedUserId],
                ['task_count' => $currentTaskCount + 1]
            );
        }


        return redirect()->route('dashboard.tasks.index')->with('success', 'Task Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        $task->delete();
        return redirect()->route('dashboard.tasks.index')->with('success', 'Task Deleted Successfully');
    }
}
