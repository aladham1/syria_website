<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Manager;
use App\Models\User;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

class UserController extends Controller
{
    /**
     *
     */
    const PREFIX = 'manage.';

    /**
     *
     */
    public function __construct()
    {
        $this->authorizeResource(User::class);

    }

    /**
     * @return Application|Factory|View
     */
    public function index(): View|Factory|Application
    {
        return view(self::PREFIX . 'users.index');
    }


    public function myAccount()
    {
        return view(self::PREFIX . 'users.my_account', ['user' => auth()->user()]);
    }

    public function updateMyAccount(Request $request): ?Authenticatable
    {
        $user = auth()->user();
        $this->extracted($user, $request);
        return $user;
    }

    public function getUsers()
    {
//            return User::NotIsAdmin()->orderBy('id', 'DESC')->get();
        return User::whereNot('id', 1)->filter()->with('roles')->orderBy('id', 'DESC')->paginate(20);
    }

    /**
     * @param StoreUserRequest $request
     * @return mixed
     */
    public function store(StoreUserRequest $request): mixed
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => bcrypt($request->password),
        ]);
        $user->roles()->sync($request->roles);
        return $user?->load('roles');
    }

    /**
     * @param User $user
     * @param UpdateUserRequest $request
     * @return User
     */
    public function update(User $user, UpdateUserRequest $request): User
    {
        $input = $request->only('name', 'email', 'phone', 'password');
        if ($request->Input('password')) {
            $bcrypt_pass = bcrypt($request->Input('password'));
            $input['password'] = $bcrypt_pass;
        } else {
            unset($input['password']);
        }
        $user->update($input);
        $user->roles()->sync(\request()->roles);
        return $user->load('roles');
    }


    /**
     * @param User $user
     * @return Application|ResponseFactory|\Illuminate\Foundation\Application|Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        $data = [
            'status' => 'success',
            'message' => 'تم حذف المستخدم بنجاح'
        ];
        return response($data, 200);
    }

    public function extracted(?Authenticatable $user, Request $request): void
    {
        $this->validate(request(), [
            'name' => 'required',
            'email' => "required|max:190|unique:users,email,$user->id,id",
            'phone' => "required|max:190|unique:users,phone,$user->id,id",
        ]);
        $input = $request->only('name', 'email', 'phone', 'password', 'js_judge');
        if ($request->Input('password')) {
            $bcrypt_pass = bcrypt($request->Input('password'));
            $input['password'] = $bcrypt_pass;
        } else {
            unset($input['password']);
        }
        $input['judge'] = $request->is_judge ? 1 : 0;
        $user->update($input);
    }
}
