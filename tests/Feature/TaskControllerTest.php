<?php

namespace Tests\Feature;

use App\Models\Admin;
use App\Models\Statistics;
use App\Models\Task;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TaskControllerTest extends TestCase
{
    use RefreshDatabase;


    // Test if the task creation form is displayed.

    public function test_task_creation_form_displayed()
    {
        $admin = Admin::factory()->create();

        $this->actingAs($admin, 'admin');

        $response = $this->get(route('dashboard.tasks.create'));

        $response->assertStatus(200)
            ->assertViewIs('dashboard.tasks.create')
            ->assertSee('Admin Name')
            ->assertSee('Title')
            ->assertSee('Description')
            ->assertSee('Assigned User');
    }


    //   Test if a task can be created successfully.

    public function test_task_creation()
    {
        $admin = Admin::factory()->create();
        $user = User::factory()->create();


        $this->actingAs($admin, 'admin');


        $data = [
            'admin_id' => $admin->id,
            'title' => 'Test Task',
            'description' => 'This is a test task',
            'assigned_to_id' => $user->id,
        ];

        $response = $this->post(route('dashboard.tasks.store'), $data);

        $response->assertRedirect(route('dashboard.tasks.index'))
            ->assertSessionHas('success', 'Task Created Successfully');

        $this->assertDatabaseCount('tasks', 1);
        $this->assertDatabaseHas('tasks', $data);

        $this->assertEquals(1, Statistics::where('user_id', $user->id)->value('task_count'));
    }


    // Test if the task list page is displayed.

    public function test_task_list_page_displayed()
    {
        $admin = Admin::factory()->create();

        $this->actingAs($admin, 'admin');

        $response = $this->get(route('dashboard.tasks.index'));

        $response->assertStatus(200)
            ->assertViewIs('dashboard.tasks.index')
            ->assertSee('Tasks')
            ->assertSee('Title')
            ->assertSee('Description')
            ->assertSee('Assigned Name')
            ->assertSee('Admin Name');
    }
}
