<?php

namespace App\Http\Controllers;

use App\Producto;
use App\User;
use App\ProdLineasAgregar;
use App\ProductosLineas;
use App\Asignaciones;
use App\ProcesosProduccion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class IssuesController extends Controller
{
    private $parent = 'ProdLineasAgregar';

    public function index()
    {
        return view($this->parent . '.view');
    }

    public function create(Request $request)
    {
        $id_report = $request->report;
        $report = Asignaciones::where('id', $id_report)->with('project')->first();
        $productos = Producto::orderBy('name', 'DESC')->get();
        $developers = User::orderBy('name', 'ASC')->get();
        $procesosProduccion = ProcesosProduccion::orderBy('name', 'ASC')->where('projects_id', $report->project->id)->get();

        return view($this->parent . '.create')->with([
            'productos' => $productos,
            'report' => $report,
            'developers' => $developers,
            'procesosProduccion' => $procesosProduccion
        ]);
    }

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();

            $request->validate([
                'title' => 'required',
                'users_id' => 'required',
                'projects_id' => 'required',
                'Producto' => 'required',
                'tag_id' => 'required'
            ]);

            $productos = [];

            $report = Asignaciones::find($request->report_id);



            $data_issue = [
                'title' => $request->title,
                'users_id' => $request->users_id,
                'projects_id' => $request->projects_id,
                'observations' => $request->observations,
                'tag_id' => $request->tag_id,
                'report_id' => $request->report_id,
                'start' => $report->date_begin,
                'end' => $report->date_finish,
            ];

            $data = ProdLineasAgregar::create($data_issue);
            $prodLineasAgregarId = $data->id;
            ProdLineasAgregar::where('id', $prodLineasAgregarId)->update(['report_id' => $request->report_id]);

            foreach ($request->hours_list as $feature => $value) {
                if ($value) {
                    $productos[] = [
                        'issue_id' => $data->id,
                        'featured_id' => $feature,
                    ];
                }
            }

            ProductosLineas::insert($productos);

            DB::commit();
            return redirect('Asignaciones');
        } catch (\Exception $e) {
            DB::rollBack();
            dd($e->getMessage());
        }
    }

    public function show($id)
    {
        // Implementa el código necesario para mostrar un registro específico si es necesario.
    }

    public function edit($id)
    {
        // Implementa el código necesario para editar un registro específico si es necesario.
    }

    public function update(Request $request, $id)
    {
        // Implementa el código necesario para actualizar un registro específico si es necesario.
    }

    public function destroy($id)
    {
        // Implementa el código necesario para eliminar un registro específico si es necesario.
    }
}
