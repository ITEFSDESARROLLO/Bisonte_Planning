<?php

namespace App\Http\Controllers;

use App\Producto;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    private $parent = 'Producto';

    public function index()
    {
        $data =Producto::orderBy('name', 'desc')->get();
        return view($this->parent . '.view')->with(['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view($this->parent . '.create');
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
            'codigo'=> 'required',
            'name' => 'required',
            'unid_x_hora' => 'required',
            'default_value' => 'required'
        ]);

        Producto::create($validatedData);
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
        $data = Producto::find($id);
        return view($this->parent . '.edit')->with(['data' => $data]);
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
            'codigo' => 'required',
            'name' => 'required',
            'unid_x_hora' => 'required',
            'default_value' => 'required'
        ]);

        Producto::where('id', $id)
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
        Producto::where('id', $id)
            ->delete();
        return redirect($this->parent);
    }
}
