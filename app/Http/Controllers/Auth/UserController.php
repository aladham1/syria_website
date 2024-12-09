<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Manager;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
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



    public function getUsers()
    {
        if (request()->get('all')){
            return User::NotIsAdmin()->orderBy('id', 'DESC')->get();
        }
        return User::filter()->with('roles')->where('id', '!=', 1)->orderBy('id', 'DESC')->paginate(20);
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
            'is_admin' => $request->user_type == 'admin' ? 1 : 0,
            'login_code' => $request->login_code,
            'password' => bcrypt($request->password),
        ]);
        if ($user->isAdmin){
            $user->roles()->sync($request->roles);
        }
        return $user?->load('roles');
    }

    /**
     * @param User $user
     * @param UpdateUserRequest $request
     * @return User
     */
    public function update(User $user, UpdateUserRequest $request): User
    {
        $input = $request->only('name', 'email', 'phone', 'password','login_code');
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
}
