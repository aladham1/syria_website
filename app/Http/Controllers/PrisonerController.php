<?php

namespace App\Http\Controllers;

use App\Models\Prisoner;
use App\Http\Requests\StorePrisonerRequest;
use App\Http\Requests\UpdatePrisonerRequest;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

class PrisonerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('manage.prisoners.index');
    }

    /**
     * @return LengthAwarePaginator
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function getPrisoners(): LengthAwarePaginator
    {
        return Prisoner::filter()->orderBy('id', 'DESC')->paginate(20);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePrisonerRequest $request)
    {
        return Prisoner::create($request->all());

    }

    /**
     * @param StorePrisonerRequest $request
     * @param Prisoner $prisoner
     * @return Prisoner
     */
    public function update(StorePrisonerRequest $request, Prisoner $prisoner): Prisoner
    {
        $prisoner->update($request->all());
        return $prisoner;
    }

    public function destroy(Prisoner $prisoner)
    {
        $prisoner->delete();
        $data = [
            'status' => 'success',
            'message' => 'تم حذف السجين بنجاح'
        ];
        return response($data, 200);
    }
}