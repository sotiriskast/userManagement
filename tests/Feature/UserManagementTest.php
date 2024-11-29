<?php
namespace Tests\Feature;

use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserManagementTest extends TestCase
{
    use RefreshDatabase;

    public function test_super_admin_can_create_user(): void
    {
        $superAdmin = User::factory()->create();
        $superAdmin->roles()->attach(Role::where('name', 'super_admin')->first());

        $this->actingAs($superAdmin)
            ->post(route('users.store'), [
                '_token' => csrf_token(),
                'name' => 'John Doe',
                'email' => 'john@example.com',
                'password' => 'password',
                'password_confirmation' => 'password',
                'role_id' => Role::where('name', 'admin')->first()->id,
            ])
            ->assertRedirect(route('users.index'))
            ->assertSessionHas('success', 'User created successfully.');

        $this->assertDatabaseHas('users', ['email' => 'john@example.com']);
    }

    public function test_super_admin_cannot_edit_themselves(): void
    {
        $superAdmin = User::factory()->create();
        $superAdmin->roles()->attach(Role::where('name', 'super_admin')->first());

        $this->actingAs($superAdmin)
            ->put(route('users.update', $superAdmin), [
                'name' => 'New Name',
                'email' => 'newemail@example.com',
            ])
            ->assertForbidden();
    }

    public function test_admin_cannot_create_users(): void
    {
        $admin = User::factory()->create();
        $admin->roles()->attach(Role::where('name', 'admin')->first());

        $this->actingAs($admin)
            ->post(route('users.store'), [
                '_token' => csrf_token(),
                'name' => 'John Doe',
                'email' => 'john@example.com',
                'password' => 'password',
                'password_confirmation' => 'password',
                'role_id' => Role::where('name', 'user')->first()->id,
            ])
            ->assertForbidden();
    }

    public function test_super_admin_cannot_edit_another_super_admin(): void
    {
        $superAdmin = User::factory()->create();
        $superAdmin->roles()->attach(Role::where('name', 'super_admin')->first());

        $anotherSuperAdmin = User::factory()->create();
        $anotherSuperAdmin->roles()->attach(Role::where('name', 'super_admin')->first());

        $this->actingAs($superAdmin)
            ->put(route('users.update', $anotherSuperAdmin), [
                'name' => 'Changed Name',
            ])
            ->assertForbidden();
    }
}
