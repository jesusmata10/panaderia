<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Productos extends Model
{
    protected $table = 'productos';

    protected $fillable = [

        'nombre',
        'precio',
        'proveedores_id',
        'url',

    ];

    protected $hidden = [

        'created_at',
        'updated_at',

    ];

    /*protected $with = [
        'perfil'
    ];

    public function perfil()
    {
        return $this->hasOne(Proveedores::class);
    }*/

     public static function consulta()
    {
        $data = DB::table('productos as p')
                    ->select( DB::raw( 'row_number() OVER (ORDER BY p.nombre) as num'), 'p.id', 'p.nombre', 'p.precio', 'p.proveedores_id', 'pr.nombre as nombre_proveedor')
                    ->join('proveedores as pr', 'pr.id', 'p.proveedores_id')
                    ->get();

                    return $data;
    }

    public static function sqlReport($search)
    {
        $datatable = DB::table('productos as p')->select( DB::raw( 'row_number() OVER (ORDER BY p.nombre) as num'), 'p.id', 'p.nombre as producto_nombre', 'p.precio', 'p.proveedores_id', 'p.url', 'pr.nombre')
        ->join('proveedores as pr', 'pr.id', 'p.proveedores_id');

        if ($search->nombre != null) {
            $datatable->where('p.nombre', $search->nombre);
        }

        if ($search->precio != null) {
            $datatable->where('p.precio', $search->precio);
        }

         if ($search->nombres!= null) {
            $datatable->where('pr.nombre', $search->nombres);
        }

        return $datatable->orderBy('p.nombre')->distinct()->get();
    }

}
