<?php
namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Routing\Controller;
use App\Services\RoleService;

class UserController extends Controller
{
    use AuthorizesRequests;

    protected $userService;
    protected $roleService;

    public function __construct(UserService $userService,RoleService $roleService)
    {
        $this->middleware('role:super_admin')->except(['index', 'show']);
        $this->userService = $userService;
        $this->roleService = $roleService;

    }

    public function index()
    {
        $this->authorize('viewAny', User::class);
        $users = $this->userService->getAllPaginatedUsers(10);
        return view('users.index', compact('users'));
    }

    public function create()
    {
        $roles = $this->roleService->getAllRoles(); // Fetch all roles
        $this->authorize('create', User::class);
        return view('users.create', compact('roles'));
    }

    public function store(UserRequest $request)
    {
        $this->authorize('create', User::class);
        $this->userService->createUserWithRole($request->validated(), $request->role);
        return redirect()->route('users.index') ->with('type', 'success')
            ->with('message', 'Transaction user successfully!');
    }

    public function show(User $user)
    {
        $this->authorize('view', $user);
        return view('users.show', compact('user'));
    }

    public function edit(User $user)
    {
        $roles = $this->roleService->getAllRoles();
        $this->authorize('update', $user);
        return view('users.edit', compact('user', 'roles'));
    }

    public function update(UserRequest $request, User $user)
    {
        $this->authorize('update', $user); // Ensure the user has permission to edit
        $this->userService->updateUserWithRole($user->id, $request->validated(), $request->role);
        return redirect()->route('users.index') ->with('type', 'success')
            ->with('message', 'User updated successfully!');
    }

    public function destroy(User $user)
    {
        $this->authorize('delete', $user);
        $this->userService->deleteUser($user->id);
        return redirect()->route('users.index')->with('success', 'User deleted successfully.');
    }
}
