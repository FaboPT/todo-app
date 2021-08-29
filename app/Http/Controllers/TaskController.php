<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskSetStatusRequest;
use App\Http\Requests\TaskRequest;
use App\Models\Task;
use App\Services\TaskService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
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
        DB::beginTransaction();
        try {
            $request->merge(['user_id'=>Auth::user()->getAuthIdentifier()]);
            $task = $this->taskService->store($request->except('_token'));
            if($task)
            {
                DB::commit();
                flash()->success('Task successfully created')->important();
                return redirect()->route('task.index');
            }
            Throw new \Exception();
        }
        catch (\Exception $e)
        {
            DB::rollBack();
            flash()->error('Something went wrong')->important();
            return back(307);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
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
    public function update(TaskRequest $request, int $id):RedirectResponse
    {
        DB::beginTransaction();
        try {
            $task = $this->taskService->update($id,$request->all());
            if($task)
            {
                DB::commit();
                flash()->success('Task successfully updated')->important();
                return redirect()->route('task.index');
            }
            Throw new \Exception();
        }
        catch (\Exception $e)
        {
            DB::rollBack();
            flash()->error('Something went wrong')->important();
            return back(307)->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return bool
     */
    public function destroy(int $id): bool
    {
        DB::beginTransaction();
        try {
            $task = $this->taskService->destroy($id);
            if($task)
            {
                DB::commit();
                return true;
            }
            Throw new \Exception();
        }
        catch (\Exception $e)
        {
            DB::rollBack();
            return false;
        }
    }

    /**
     * Change status in task
     *
     * @param  int $id
     * @return bool
     */
    public function setStatus(int $id, TaskSetStatusRequest $request): bool
    {
        DB::beginTransaction();
        try {
            $data = ['status'=>$request->input('status'),'done_at'=>$request->input('done_at')];
            $task = $this->taskService->setStatus($id,$data);
            if($task)
            {
                DB::commit();
                return true;
            }
            Throw new \Exception();
        }
        catch (\Exception $e)
        {
            DB::rollBack();
            return false;
        }
    }
}
