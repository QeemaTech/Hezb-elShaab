<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\UserRequest;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;

class UserController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index()
    {
        $type = request()->input('type', 'active-members');
        $users = $this->userService->getAllUsers();
        $breadcrumbs = [
            ['name' => __('messages.users'), 'url' => route('admin.users.index')],
        ];
        return view('admin.users.index', compact('users', 'breadcrumbs', 'type'));
    }

    public function show($uuid)
    {
        $user = $this->userService->getUserByUuid($uuid);
        $breadcrumbs = [
            ['name' => __('messages.users'), 'url' => route('admin.users.index')],
            ['name' => __('messages.show'), 'url' => null]
        ];
        return view('admin.users.show', compact('user', 'breadcrumbs'));
    }
    public function create()
    {
        $breadcrumbs = [
            ['name' => __('messages.users'), 'url' => route('admin.users.index')],
            ['name' => __('messages.create'), 'url' => null]
        ];
        $permissions = Permission::all();
        return view('admin.users.create', compact('breadcrumbs','permissions'));
    }

    public function store(UserRequest $request)
    {
        $this->userService->createUser($request->validated() + [
            'status' => (bool) $request->boolean('status'),
            'image' => $request->file('image'),
            'video' => $request->file('video')
        ]);
        return redirect()->route('admin.users.index')->with('success', 'User created!');
    }

    public function edit($uuid)
    {
        $user = $this->userService->getUserByUuid($uuid);
        $breadcrumbs = [
            ['name' => __('messages.users'), 'url' => route('admin.users.index')],
            ['name' => __('messages.update'), 'url' => null]
        ];
        return view('admin.users.edit', compact('user', 'breadcrumbs'));
    }
    public function update(UserRequest $request, User $user)
    {
        $this->userService->updateUser($user, $request->validated() + [
            'status' => (bool) $request->boolean('status'),
            'image' => $request->file('image'),
            'video' => $request->file('video')
        ]);
        return redirect()->route('admin.users.index')->with('success', 'User updated!');
    }

    public function destroy($uuid)
    {
        $user =  $this->userService->getUserByUuid($uuid);

        if ($user) {
            $user->delete();
            return response()->json(['success' => true]);
        }

        $this->userService->deleteUser($user);
        return response()->json(['success' => false], 404);
    }

    public function accept(User $user)
    {
        if ($user->member_id) {
            $user->update([
                'member_status' => 'active',
                'member_reviewed_by' => Auth::id(),
            ]);
        }
        return response()->json(['message' => 'Request accepted successfully.']);
    }

    public function reject(User $user)
    {
        if ($user->member_id) {
            $user->update([
                'member_status' => 'rejected',
                'member_reviewed_by' => Auth::id(),
            ]);
        }
        return response()->json(['message' => 'Request rejected successfully.']);
    }
}
