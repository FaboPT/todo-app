<?php

namespace App\Services;

use App\Repositories\TaskRepository;
use Illuminate\Database\Eloquent\Collection;

class TaskService
{
    protected $taskRepository;
    public function __construct(TaskRepository $taskRepository)
    {
        $this->taskRepository = $taskRepository;
    }

    public function all(): Collection
    {
        return $this->taskRepository->all();
    }

    public function store($data): bool
    {
        return $this->taskRepository->store($data);
    }

    public function update($id,$data): bool
    {
        return $this->taskRepository->update($id,$data);
    }

    public function destroy($id): bool
    {
        return $this->taskRepository->destroy($id);
    }

    public function setStatus($id,$status): bool{
        return $this->taskRepository->setStatus($id,$status);
    }
}
