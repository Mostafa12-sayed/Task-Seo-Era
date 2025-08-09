<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\UserService;
use App\Http\Requests\Admin\CreateUserRequest;
use App\Http\Requests\Admin\UpdateUserRequest;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct(private UserService $userService)
    {
    }

    public function index(Request $request)
    {
        $perPage = $request->get('per_page', 15);
        $users = $this->userService->getAllUsers($perPage);

        return view('users.index', ['users' => $users]);
    }

    public function create()
    {
        return view('users.create' , ['user' => new User()]);
    }
    public function store(CreateUserRequest $request)
    {
        try {
            $user = $this->userService->createUser($request->validated());
            if (!$user) {
                flash()->error('Failed to create user');
                return redirect()->back();
            }
            flash()->success('Updated successfully');
            return redirect()->back();
        } catch (\Exception $e) {
            flash()->error('Error creating user: ' . $e->getMessage());

            return redirect()->back();


        }
    }
    public function edit(int $id)
    {
        $user = $this->userService->findUser($id);

        if (!$user) {
            flash()->error('User not found');

            return redirect()->back();
        }
        return view('users.create' , ['user' => $user]);


    }
    public function show(int $id)
    {
    }

    public function update(CreateUserRequest $request, int $id)
    {
        try {
            $updated = $this->userService->updateUser($id, $request->validated());

            if (!$updated) {
              flash()->error('User not found');
              return redirect()->back();
            }
            flash()->success('Updated successfully');
            return redirect()->back();

        } catch (\Exception $e) {
            flash()->error('Error Updating user: ' . $e->getMessage());

            return redirect()->back();
        }
    }

    public function destroy(int $id)
    {
        try {
            $deleted = $this->userService->deleteUser($id);

            if (!$deleted) {
                flash()->error('User not found');
                return redirect()->back();
            }

            flash()->success('User Deleted successfully');

            return redirect()->back();
        } catch (\Exception $e) {
            flash()->error('Error Deleting user: ' . $e->getMessage());

            return redirect()->back();
        }
    }
}
