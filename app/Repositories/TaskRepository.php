<?php

namespace App\Repositories;

use App\Models\Task;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class TaskRepository extends BaseRepository
{
    protected Task $task;
    public function __construct(Task $task)
    {
        $this->task = $task;
    }


    public function all(): Collection{
        return $this->task->with('user')->myTasks(Auth::user()->getAuthIdentifier())->get();
    }

    public function store(array $attributes): Model
    {
        return $this->task->create($attributes);
    }

    public function update(int $id, array $attributes): bool
    {
        return $this->task->findOrFail($id)->update($attributes);
    }

    public function destroy(int $id): bool
    {
        return $this->task->findOrFail($id)->delete();
    }

    public function edit(int $id): Task {
        return $this->task->findOrFail($id);
    }

    public function setStatus(int $id,array $attributes): bool {
        return $this->task->findOrFail($id)->update($attributes);
    }
}
