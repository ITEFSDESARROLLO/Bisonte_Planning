<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use App\Producto;

class ProductosExcel implements ToCollection, WithHeadingRow
{
    /**
     * @param Collection $collection
     */
    public function collection(Collection $collection)
    {
        foreach ($collection as $row) {
            Producto::create([
                'codigo' => $row['codigo'],
                'name' => $row['name'],
                'unid_x_hora' => $row['unid_x_hora'],
                'default_value' => $row['default_value'],
            ]);
        }
    }
}
