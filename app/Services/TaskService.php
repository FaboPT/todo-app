<?php

namespace App\Services;

use App\Models\Task;
use App\Repositories\TaskRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;

class TaskService
{
    protected TaskRepository $taskRepository;

    public function __construct(TaskRepository $taskRepository)
    {
        $this->taskRepository = $taskRepository;
    }

    public function all(): Collection
    {
        return $this->taskRepository->all();
    }

    public function store($data): RedirectResponse
    {
        DB::beginTransaction();
        try {
            $this->taskRepository->store($data);;
            DB::commit();
            flash()->success('Task successfully created')->important();
            return redirect()->route('task.index');

        } catch (\Exception $e) {
            DB::rollBack();
            flash()->error('Something went wrong')->important();
            return back(307);
        }
    }

    public function edit(int $id): Task
    {
        return $this->taskRepository->edit($id);
    }


    public function update($id, $data): RedirectResponse
    {
        DB::beginTransaction();
        try {
            $this->taskRepository->update($id, $data);
            DB::commit();
            flash()->success('Task successfully updated')->important();
            return redirect()->route('task.index');

        } catch (\Exception $e) {
            DB::rollBack();
            flash()->error('Something went wrong')->important();
            return back(307)->withInput();
        }
    }

    public function destroy($id): bool
    {
        DB::beginTransaction();
        try {
            $this->taskRepository->destroy($id);
            DB::commit();
            return true;

        } catch (\Exception $e) {
            DB::rollBack();
            return false;
        }
    }

    public function setStatus($id, $data): bool
    {
        DB::beginTransaction();
        try {
            $this->taskRepository->setStatus($id, $data);
            DB::commit();
            return true;

        } catch (\Exception $e) {
            DB::rollBack();
            return false;
        }
    }
}
