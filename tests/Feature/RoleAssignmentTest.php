<?php
namespace Tests\Feature;

use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RoleAssignmentTest extends TestCase
{
    use RefreshDatabase;

    public function test_super_admin_can_assign_roles(): void
    {
        $superAdmin = User::factory()->create();
        $superAdmin->roles()->attach(Role::where('name', 'super_admin')->first());

        $user = User::factory()->create();

        $this->actingAs($superAdmin)
            ->put(route('users.update', $user), [
                'name' => $user->name,
                'email' => $user->email,
                'role_id' => Role::where('name', 'admin')->first()->id,
            ])
            ->assertRedirect(route('users.index'))
            ->assertSessionHas('success', 'User updated successfully.');

        $this->assertDatabaseHas('role_user', ['user_id' => $user->id]);
    }

    public function test_admin_cannot_assign_roles(): void
    {
        $admin = User::factory()->create();
        $admin->roles()->attach(Role::where('name', 'admin')->first());

        $user = User::factory()->create();

        $this->actingAs($admin)
            ->put(route('users.update', $user), [
                'name' => $user->name,
                'email' => $user->email,
                'role_id' => Role::where('name', 'super_admin')->first()->id,
            ])
            ->assertForbidden();
    }
}
