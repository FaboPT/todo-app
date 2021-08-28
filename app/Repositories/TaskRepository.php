<?php

namespace App\Repositories;

use App\Models\Task;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;

class TaskRepository extends BaseRepository
{
    protected $task;
    public function __construct(Task $task)
    {
        $this->task = $task;
        parent::__construct($this->task);
    }

    public function all(): Collection{
        return $this->task->with('user')->myTasks(Auth::user()->getAuthIdentifier())->get();
    }

    public function setStatus($id,$statusId): bool {
        return $this->task->findOrFail($id)->update(['status'=>$statusId]);
    }

}
