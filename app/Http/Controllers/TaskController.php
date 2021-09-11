<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskRequest;
use App\Http\Requests\TaskSetStatusRequest;
use App\Services\TaskService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class TaskController extends Controller
{
    private $taskService;

    public function __construct(TaskService $taskService)
    {
        $this->taskService = $taskService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(): View
    {
        $items = $this->taskService->all();
        return view('tasks.index', compact('items'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param TaskRequest $request
     * @return RedirectResponse
     */
    public function store(TaskRequest $request): RedirectResponse
    {
        $request->merge(['user_id' => Auth::user()->getAuthIdentifier()]);
        return $this->taskService->store($request->except('_token'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return View
     *
     */
    public function edit(int $id): View
    {
        $item = $this->taskService->edit($id);

        return view('tasks.edit', compact('item'));

    }


    /**
     * Update the specified resource in storage.
     *
     * @param TaskRequest $request
     * @param int $id
     * @return RedirectResponse
     */
    public function update(TaskRequest $request, int $id): RedirectResponse
    {
        return $this->taskService->update($id, $request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return bool
     */
    public function destroy(int $id): bool
    {
        return $this->taskService->destroy($id);
    }

    /**
     * Change status in task
     *
     * @param int $id
     * @return bool
     */
    public function setStatus(int $id, TaskSetStatusRequest $request): bool
    {
        $data = ['status' => $request->input('status'), 'done_at' => $request->input('done_at')];
        return $this->taskService->setStatus($id, $data);
    }
}
