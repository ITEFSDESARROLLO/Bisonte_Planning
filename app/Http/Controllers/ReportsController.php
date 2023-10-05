<?php

namespace App\Http\Controllers;

use App\LineasProduccion;
use App\Asignaciones;
use App\ProdLineasAgregar;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReportsController extends Controller
{
    private $parent = 'Asignaciones';

    public function index(Request $request)
    {

        $begin = Carbon::parse($request->date_begin);
        $finish = Carbon::parse($request->date_finish)->endOfDay();

        $general = [
            'hours' => 0
        ];
        $data = Asignaciones::orderBy('projects_id', 'desc')
            ->where(function ($q) use ($request, $begin, $finish) {
                if ($request->date_begin && $request->date_finish) {
                    $q->whereDate('date_begin', '>=', $begin)
                        ->whereDate('date_finish', '<=', $finish);
                }
            })
            ->with(['ProdLineasAgregar'])
            ->get();
        foreach ($data as $d) {
             $check = Carbon::now()->startOfDay()->between($d->date_begin, $d->date_finish);
             $hours_all = 0;

            if ($d->ProdLineasAgregar) {
              $hours_all = array_sum($d->ProdLineasAgregar->pluck('hours')->toArray());
            }
          $general['hours'] += $hours_all;
              $d->setAttribute('hours_all', $hours_all);
              $d->setAttribute('is_range', $check);
        }
        return view($this->parent . '.view')->with(['data' => $data, 'general' => $general]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $LineasProduccion = LineasProduccion::orderBy('title', 'ASC')->with(['organization'])->get();

        return view($this->parent . '.create')->with([
            'LineasProduccion' => $LineasProduccion
        ]);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $request->validate([
            'date_begin' => 'required',
            'date_finish' => 'required',
            'project_with_organization' => 'required'
        ]);

        $parse = explode('_', $request->project_with_organization);

        $data = [
            'date_begin' => $request->input('date_begin'),
            'date_finish' => $request->input('date_finish'),
            'projects_id' => $parse[1] // 'organizations_id' si es necesario
        ];

        $asignacion = Asignaciones::create($data);
        $asignacionId = $asignacion->id;

        $agregar = [
            'report_id' => $asignacionId,
            'id' => $asignacionId,
            // Agrega otros campos necesarios aquí
        ];
        // Crear un nuevo registro en prod_lineas_agregars
        ProdLineasAgregar::create($agregar);
        // Actualizar report_id en el registro de prod_lineas_agregars
        ProdLineasAgregar::where('id', $asignacionId)->update(['report_id' => $asignacionId]);
        return redirect($this->parent);
    }
    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        $report = Asignaciones::where('projects_id', $id)->with(['project', 'ProdLineasAgregar'])->first();

        return view($this->parent . '.show')->with([
            'report' => $report
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $data = Asignaciones::where('projects_id', $id)->first();
        $LineasProduccion = LineasProduccion::orderBy('title', 'ASC')->with(['organization'])->get();
        return view($this->parent . '.edit')->with(['data' => $data, 'LineasProduccion' => $LineasProduccion]);
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
            'date_begin' => 'required',
            'date_finish' => 'required',
            'project_with_organization' => 'required'
        ]);

        $parse = explode('_', $request->project_with_organization);

        $data = [
            'date_begin' => $request->input('date_begin'),
            'date_finish' => $request->input('date_finish'),
            'organizations_id' => $parse[0],
            'projects_id' => $parse[1]
        ];

        Asignaciones::where('projects_id', $id)->update($data);
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
        Asignaciones::where('projects_id', $id)->delete();
        return redirect($this->parent);
    }
}

