<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Proveedores extends Model
{
    protected $table = 'proveedores';

    protected $fillable = [

        'nombre',
        'correo',
        'edad',

    ];

    protected $hidden = [

        'created_at',
        'updated_at',

    ];

    public static function consulta()
    {
        $data = DB::table('proveedores')
                    ->select( DB::raw( 'row_number() OVER (ORDER BY nombre) as num'), 'id', 'nombre', 'correo', 'edad')
                    ->get();

                    return $data;
    }

     public static function sqlReport($search)
    {
        $datatable = DB::table('proveedores')->select( DB::raw( 'row_number() OVER (ORDER BY nombre) as num'), 'id', 'nombre', 'correo', 'edad');

        if ($search->nombre != null) {
            $datatable->where('nombre', $search->nombre);
        }

        if ($search->correo != null) {
            $datatable->where('correo', $search->correo);
        }

        if ($search->edad != null) {
            $datatable->edad->where('edad', $search->edad);
        }

        return $datatable->orderBy('nombre')->distinct()->get();
    }

}
