<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Imports\ProductosExcel;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ExcelImports;
 // Asegúrate de tener la ruta correcta a tu clase de importación

class ExcelUploadController extends Controller
{
    public function uploadExcel(Request $request)
    {
        $request->validate([
            'excel_file' => 'required|mimes:xls,xlsx',
        ]);
        if ($request->hasFile('excel_file')) {
            $file = $request->file('excel_file');
            $filterDate = $request->input('filter_date');
            $import = new ExcelImports(); // Utiliza el nombre correcto de la clase de importación
            Excel::import($import, $file);
            return redirect()->back()->with('success', 'Archivo Excel subido y procesado correctamente.');
        }
        return redirect()->back()->with('error', 'Error al subir el archivo Excel.');
    }







}
