<?php

namespace App\Http\Controllers;

use App\LineasProduccion;
use App\Asignaciones;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ChartController extends Controller
{
    private $parent = 'chart';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $dataRaw = [];
        $data = LineasProduccion::orderBy('id', 'DESC')
            ->with(['series'])
            ->get();
        foreach ($data as $datum) {
            $clear_series = [];
            foreach ($datum->series as $v) {
                $calc = $v->get_calc($v->id);
                if ($calc['start'] && $calc['end']) {
                    $clear_series[] = array_merge(
                        [
                            'color' => $v->color,
                            'titulo' => "<span><canvas class='pointer-color' style='background-color:" . $v->color . "'></canvas>  " . $v->nombre . "</span>",
                            'contenido' => $v->contenido
                        ],
                        $calc
                    );
                    $clear_series[] = [
                        'title' => '<span class="text-white"><i class="fas fa-clock"></i> Ejecución</span>',
                        'start' => $v->start_at,
                        'end' => $v->deadline_at,
                        'content' => $v->content
                    ];
                }
            }
            $dataRaw[] = array(
                'id' => $datum['id'],
                'name' => $datum['title'],
                'series' => $clear_series
            );
        }
        return view($this->parent . '.view')->with(['data' => $dataRaw]);
    }

    /**
     * Muestra el formulario para crear un nuevo recurso.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }
    /**
     * Almacena un recurso recién creado en el almacenamiento.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }
    /**
     * Muestra el recurso especificado.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }
    /**
     * Muestra el formulario para editar el recurso especificado.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }
    /**
     * Actualiza el recurso especificado en el almacenamiento.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }
    /**
     * Elimina el recurso especificado del almacenamiento.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

