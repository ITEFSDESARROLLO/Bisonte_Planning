<?php

namespace App\Http\Controllers;

use App\usuarios;
use App\Producto;
use App\LineasProduccion;
use App\ProductosLineas;
use App\ProcesosProduccion;
use App\ProdLineasAgregar;
use App\Asignaciones;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;

//Cuando salga error de undefine:variable es porque se debe cofigurar la variable en el controlador
//tener encuenta donde se define si en el funcion index o en el create

class TagController extends Controller
{
    use SoftDeletes;
    private $parent = 'ProcesosProduccion';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {


        $data = ProcesosProduccion::orderBy('id', 'desc')->with(['LineasProduccion', 'Producto'])
            ->get();

        $data->map(function ($item) {

            $item->is_range = (Carbon::now()->startOfDay()->between($item->start_at, $item->deadline_at)) ? 'current' :
                (Carbon::now()->addWeek()->between($item->start_at, $item->deadline_at) ? 'next_week' : '');
            return $item;
        });

        return view($this->parent . '.view')->with(['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $LineasProduccion = LineasProduccion::orderBy('id', 'DESC')->get();
        $Producto = Producto::orderBy('id', 'DESC')->get();
        return view($this->parent . '.create')->with(['LineasProduccion' => $LineasProduccion, 'Producto' => $Producto]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'cantidad' => 'required',
            'color' => 'required',
            'start_at' => 'required',
            'deadline_at' => 'required',
            'projects_id' => 'required',
            'featured_id' => 'required'
        ]);

        // Solo crea un registro de ProcesosProduccion
        $procesoProduccion = ProcesosProduccion::create($validatedData);
        $prodLineasAgregar = ProdLineasAgregar::where('tag_id', $procesoProduccion->featured_id)->first();
        $prodLineasAgregar = ProdLineasAgregar::where('tag_id', $procesoProduccion->id)->first();
        $prodLineasAgregar = ProdLineasAgregar::where('title', $procesoProduccion->id)->first();
        $prodLineasAgregar = ProdLineasAgregar::where('start', $procesoProduccion->start_at)->first();
        $prodLineasAgregar = ProdLineasAgregar::where('end', $procesoProduccion->deadline_at)->first();
        $prodLineasAgregar = ProdLineasAgregar::where('projects_id', $procesoProduccion->projects_id)->first();
        $prodLineasAgregar = ProdLineasAgregar::where('id', $procesoProduccion->projects_id)->first();
        $productoData = ProductosLineas::where('featured_id', $procesoProduccion->featured_id)->first();
        $procesoProduccion->update($validatedData);



        if ($prodLineasAgregar) {
            $prodLineasAgregar->checked = true;
            $prodLineasAgregar->save();
        }

        $asignacionData = [
            'id' => $procesoProduccion->projects_id,
            'projects_id' => $procesoProduccion->projects_id,
            'date_begin' => $procesoProduccion->start_at,
            'date_finish' => $procesoProduccion->deadline_at
            // Agrega otros campos necesarios aquí
        ];


        $asignacion = Asignaciones::create($asignacionData);
        $asignacionId = $asignacion->id;
        //dd($asignacionId);

        $agregarData = [

            'title' => $procesoProduccion->id,
            'tag_id' => $procesoProduccion->id,
            'start' => $procesoProduccion->start_at,
            'end' => $procesoProduccion->deadline_at,
            'projects_id' => $procesoProduccion->projects_id,
            'report_id' => $asignacionId,
            // Agrega otros campos necesarios aquí
        ];

        $productosLineas = ProdLineasAgregar::create($agregarData);
        $productoId = $productosLineas->id;
        //dd($productoId);

        $productoData = [
            // Usar la clave primaria de ProcesosProduccion
            'featured_id' => $procesoProduccion->featured_id,
            'issue_id' => $productoId
            // Agrega otros campos necesarios aquí
        ];


        //ProdLineasAgregar::create($agregarData);
        // Asignaciones::create($asignacionData);
        ProductosLineas::create($productoData);

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
        $LineasProduccion = LineasProduccion::orderBy('id', 'DESC')->get();
        $Producto = Producto::orderBy('id', 'DESC')->get();
        $data = ProcesosProduccion::with(['LineasProduccion', 'Producto'])->find($id);

        //        dd($data->trixRichText());
        return view($this->parent . '.edit')->with([
            'data' => $data,
            'LineasProduccion' => $LineasProduccion,
            'Producto' => $Producto
        ]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'cantidad' => 'required',
            'color' => 'required',
            // Si no es un campo requerido, déjalo en blanco
            'start_at' => 'required|date',
            // Asegura que la fecha esté en el formato correcto
            'deadline_at' => 'required|date',
            // Asegura que la fecha esté en el formato correcto
            'projects_id' => 'required',
            'featured_id' => '' // Si no es un campo requerido, déjalo en blanco
        ]);

        // Obtén el objeto ProcesosProduccion
        $procesoProduccion = ProcesosProduccion::find($id);

        // Verifica si se encontró el objeto antes de continuar


        // Actualiza las propiedades específicas del proceso de producción
        $procesoProduccion->start_at = $request->start_at;
        $procesoProduccion->projects_id = $request->projects_id;
        $procesoProduccion->deadline_at = $request->deadline_at;
        $procesoProduccion->featured_id = $request->featured_id;


        $prodLineasAgregar = ProdLineasAgregar::where('tag_id', $procesoProduccion->id)->first();
        if ($prodLineasAgregar) {
            $prodLineasAgregar->start = $request->start_at;
            $prodLineasAgregar->end = $request->deadline_at;
            $prodLineasAgregar->save();
        }
        // Guarda los cambios
        $procesoProduccion->save();
        $procesoProduccion = ProcesosProduccion::find($id);

        ProcesosProduccion::where('id', $id)
            ->update($validatedData);

        return redirect($this->parent);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        ProcesosProduccion::where('id', $id)
            ->delete();
        return redirect($this->parent);
    }

    public function filtrarProduccion(Request $request)
    {
        $fechaInicio = $request->input('fecha_inicio');
        $fechaFin = $request->input('fecha_fin');

        $data = ProcesosProduccion::whereBetween('start_at', [$fechaInicio, $fechaFin])
            ->orWhereBetween('deadline_at', [$fechaInicio, $fechaFin])
            ->orderBy('id', 'desc')
            ->with(['LineasProduccion', 'Producto'])
            ->get();

        $data->map(function ($item) {
            // ...
        });

        return view($this->parent . '.view')->with(['data' => $data]);
    }
    public function quitarFiltro()
    {
        // Obtén los datos sin aplicar ningún filtro
        $data = ProcesosProduccion::orderBy('id', 'desc')->with(['LineasProduccion', 'Producto'])->get();

        $data->map(function ($item) {
            // ...
        });

        return view($this->parent . '.view')->with(['data' => $data]);
    }



}
