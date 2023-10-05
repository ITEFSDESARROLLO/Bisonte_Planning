<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Imports\ProductosExcel;
use Maatwebsite\Excel\Facades\Excel;
use App\Producto;

class ExcelController extends Controller
{
    public function subirExcel(Request $request)
    {
        $request->validate([
            'excel_file' => 'required|mimes:xls,xlsx',
        ]);
        if ($request->hasFile('excel_file')) {
            $file = $request->file('excel_file');
            $import = new ProductosExcel();
            Excel::import($import, $file);

            return redirect()->back()->with('success', 'Archivo Excel subido y procesado correctamente.');
        }
        return redirect()->back()->with('error', 'Error al subir el archivo Excel.');
    }
}
