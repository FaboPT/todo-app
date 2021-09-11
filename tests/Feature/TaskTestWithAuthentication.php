<?php

namespace Tests\Feature;

use App\Models\Task;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class TaskTestWithAuthentication extends TestCase
{
    private function user()
    {
        $user = User::firstOrNew(['email'=>'test@email.com']);
        $user->name = 'Test';
        $user->password = 'secret12345?';
        $user->save();
        return $user;

    }

    public function test_access_tasks_with_authentication()
    {
        $this->actingAs($this->user());
        $response = $this->get(route('task.index'));

        $response->assertViewIs('tasks.index')->assertSuccessful();
    }

    public function test_store_tasks_with_authentication()
    {
        $this->actingAs($this->user());
        $data = [
            'name'=>'Task test',
            'user_id'=>Auth::user()->getAuthIdentifier()
        ];


        $response = $this->post(route('task.store'),$data);

        $response->assertRedirect(route('task.index'))->assertStatus(302);
    }

    public function test_edit_tasks_with_authentication()
    {
        $this->actingAs($this->user());
        $response = $this->get(route('task.edit',1));


        $response->assertViewIs('tasks.edit')->assertSuccessful();
    }

    public function test_update_tasks_with_authentication()
    {
        $this->actingAs($this->user());
        $task = Task::findOrFail(1);
        $data = [
            'name'=>'Task test 2',
        ];
        $response = $this->put(route('task.update', $task->id),$data);

        $response->assertRedirect(route('task.index'))->assertStatus(302);
    }

    public function test_set_status_tasks_with_authentication()
    {
        $this->actingAs($this->user());
        $task = Task::findOrFail(1);
        $data = [
            'status'=>$task->status === 0 ? 1 : 0,
            'done_at'=>$task->done_at ? null : Carbon::now(),
        ];
        $response = $this->put(route('task.setStatus', $task),$data);

        $response->assertSuccessful();
    }
    public function test_destroy_tasks_with_authentication()
    {
        $this->actingAs($this->user());
        $task = Task::findOrFail(1);

        $response = $this->delete(route('task.destroy', $task));

        $response->assertSuccessful();
    }
}
