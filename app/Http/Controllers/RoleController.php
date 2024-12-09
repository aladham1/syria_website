<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRoleRequest;
use App\Models\Manager;
use App\Models\Role;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

class RoleController extends Controller
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
        $this->authorizeResource(Role::class);
    }


    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        $this->authorize('view-any', Role::class);
        return view(self::PREFIX . 'managers.roles');
    }


    /**
     * @return \Illuminate\Config\Repository|Application|mixed
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function getAbilities()
    {
        $this->authorize('view-any', Role::class);
        return config('abilities');
    }


    /**
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function getRoles()
    {
        $roles = Role::query();
        if (\request()->get('query') != 'null' && !empty(\request()->get('query'))) {
            $roles = $roles->where('title', 'LIKE', '%' . \request()->get('query') . '%');
        }
        return $roles->orderBy('id', 'DESC')->get();
    }

    /**
     * @return mixed
     */
    public function store(StoreRoleRequest $request)
    {
        return Role::forceCreate($request->all());
    }


    /**
     * @param StoreRoleRequest $request
     * @param Role $role
     * @return Role
     */
    public function update(StoreRoleRequest $request, Role $role)
    {
         $role->update($request->all());
         return $role;
    }


    /**
     * @param Role $role
     * @return Application|ResponseFactory|Response
     */
    public function destroy(Role $role)
    {
        $role->delete();
        $data = [
            'status' => 'success',
            'message' => 'تم حذف الصلاحية بنجاح'
        ];
        return response($data, 200);
    }
}
