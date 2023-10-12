<?php

namespace App\Imports;

use App\ProcesosProduccion;
use App\Asignaciones;
use App\LineasProduccion;
use App\ProdLineasAgregar;
use App\ProductosLineas;
use App\Producto;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\DB;

class ExcelImports implements ToModel, WithHeadingRow
{
    private $valueToIdMap = [];


    public function model(array $row)
    {
        $projects_id = $row['projects_id'];
        $id = DB::table('lineas_produccions')->where('title', $projects_id)->value('id');
        $id = LineasProduccion::createIfNotExists($projects_id)->id;

        $featured_id = $row['featured_id'];
        $idProductos = DB::table('productos')->where('name', $featured_id)->value('id');
        $idProductos = Producto::createIfNotExists($featured_id)->id;

        if (!$idProductos) {
            $newProduct = new Producto([
                'name' => $featured_id,
                // Add any other columns or data for the new product
            ]);


            $newProduct->save();

            $idProductos = $newProduct->id;
        }
        $organizations_id = 1;

        $featured_id = $row['featured_id'];
        $producto = Producto::where('name', $featured_id)->first();
        if (!$producto->unid_x_hora) {
            // Tomar una acción específica, como asignar un valor predeterminado
            $tasaProduccion = 1; // Por ejemplo, asignar 1 si no hay un valor definido
        } else {
            $tasaProduccion = $producto->unid_x_hora;
        }
        $cantidad = $row['cantidad'];
        $valorhora = 1;
        if ($tasaProduccion == 0) {
            // Tomar una acción específica, como asignar un valor predeterminado
            $tasaProduccion = 1; // Por ejemplo, asignar 1 si no hay un valor definido
        }
        $horas = ($valorhora * $cantidad) / $tasaProduccion;

        $procesoProduccion = new ProcesosProduccion([
            'name' => $row['name'],
            'cantidad' => $row['cantidad'],
            'color' => $row['color'],
            'projects_id' => $id,
            'start_at' => $row['start_at'],
            'deadline_at' => $row['deadline_at'],
           // 'proyectos_id' => $row['proyectos_id'],
           'organizations_id' => $organizations_id,
            'featured_id' => $idProductos,
            'horas' => $horas
        ]);

        if (!is_null($row['name']) && !is_null($row['cantidad']) && !is_null($row['color']) && !is_null($id) && !is_null($row['start_at']) && !is_null($row['deadline_at']) && !is_null($idProductos)) {
            $procesoProduccion = new ProcesosProduccion([
                'name' => $row['name'],
                'cantidad' => $row['cantidad'],
                'color' => $row['color'],
                'projects_id' => $id,
                'start_at' => $row['start_at'],
                'deadline_at' => $row['deadline_at'],
                'featured_id' => $idProductos,
                'horas' => $horas
            ]);

            $procesoProduccion->save();

            $asignacionData = [
                'projects_id' => $procesoProduccion->projects_id,
                'date_begin' => $procesoProduccion->start_at,
                'date_finish' => $procesoProduccion->deadline_at,
                // ... (otros campos)
            ];



            $asignacion = Asignaciones::create($asignacionData);
            $asignacionId = $asignacion->id;
            $agregarData = [
                'title' => $procesoProduccion->id,
                'tag_id' => $procesoProduccion->id,
                'start' => $procesoProduccion->start_at,
                'end' => $procesoProduccion->deadline_at,
                'projects_id' => $procesoProduccion->projects_id,
                'hours' => $procesoProduccion->horas,
                'report_id' => $asignacionId,
                // ... (otros campos)
            ];


            $productosLineas = ProdLineasAgregar::create($agregarData);
            $productoId = $productosLineas->id;
            $productoData = [
                // Usar la clave primaria de ProcesosProduccion
                'featured_id' => $procesoProduccion->featured_id,
                'hours' => $procesoProduccion->horas,
                'issue_id' => $productoId
                // Agrega otros campos necesarios aquí
            ];

            $producto= new ProductosLineas($productoData);



            $agregar = new ProdLineasAgregar($agregarData);
            //$asignacion = new Asignaciones($asignacionData);


            $procesoProduccion->asignaciones()->save($asignacion);
            $procesoProduccion->prodLineasAgregar()->save($agregar);
            $procesoProduccion->productosLineas()->save($producto);

            return $procesoProduccion;
        }
    }
}

