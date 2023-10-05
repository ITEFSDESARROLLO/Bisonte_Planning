<?php

namespace App\Http\Controllers;

use App\usuarios;
use App\LineasProduccion;
use Illuminate\Http\Request;

class ProjectsController extends Controller
{
    private $parent = 'LineasProduccion';

    public function index()
    {
        $data = LineasProduccion::orderBy('id', 'desc')->with(['organization'])->get();

        return view($this->parent . '.view')->with(['data' => $data]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $usuarios = usuarios::orderBy('name', 'ASC')->get();
        return view($this->parent . '.create')->with(['usuarios' => $usuarios]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return string
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'planta' => 'required',
            'title' => 'required',
            'organizations_id' => 'required'
        ]);

        LineasProduccion::create($validatedData);
        return redirect($this->parent);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $data = LineasProduccion::find($id);
        $usuarios = usuarios::orderBy('name', 'ASC')->get();
        return view($this->parent . '.edit')->with(['data' => $data, 'usuarios' => $usuarios]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'planta' => 'required',
            'title' => 'required',
            'organizations_id' => 'required'
        ]);

        LineasProduccion::where('id', $id)
            ->update($validatedData);

        return redirect($this->parent);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        LineasProduccion::where('id', $id)
            ->delete();
        return redirect($this->parent);
    }
}
