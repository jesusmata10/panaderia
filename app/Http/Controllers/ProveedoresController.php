<?php

namespace App\Http\Controllers;

use App\Proveedores;
use Illuminate\Http\Request;
use App\Http\Requests\ProveedorRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Arr;
use PDF;



class ProveedoresController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $proveedor = Proveedores::Consulta();
        $datatable = Proveedores::sqlReport($request);
        //dd($proveedor);
        return view('proveedor.index', compact('proveedor', 'datatable'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('proveedor.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProveedorRequest $request)
    {
       //dd($request);
        $proveedor = new Proveedores;
        $proveedor->nombre = $request->nombre;
        $proveedor->correo = $request->correo;
        $proveedor->edad = $request->edad;
        $proveedor->save();

        if ($proveedor->save()) {
            return redirect('/proveedor')->with('success', __('¡Proveedor creado sastifactoriamente!'));
        } else {
            return redirect('/proveedor')->with('error', __('¡Hubo un error¡'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Proveedores  $proveedores
     * @return \Illuminate\Http\Response
     */
    public function show(Proveedores $proveedores)
    {
       
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Proveedores  $proveedores
     * @return \Illuminate\Http\Response
     */
    public function edit(Proveedores $proveedores, $proveedor)
    {
        $proveedores = Proveedores::where('id', $proveedor)->first();;

        return view('proveedor.edit', ['proveedores' => $proveedores]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Proveedores  $proveedores
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Proveedores $proveedores, $proveedor)
    {
        $input = $request->all();

        try {

            $data = Arr::only($input, ['nombre', 'correo', 'edad']);
            $user = Proveedores::where('id', $proveedor)->update($data);

            return redirect('/proveedor')->with('success', __('¡Proveedor Actualizado sastifactoriamente!'));
        } catch (QueryException $e) {

            return redirect('/proveedor')->with('error', __('Ha ocurrido un Problema'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Proveedores  $proveedores
     * @return \Illuminate\Http\Response
     */
    public function destroy(Proveedores $proveedores, $proveedor)
    {
        $data = Proveedores::where('id', $proveedor)->delete();

        return back()->with('success', __('¡Proveedor eliminado sastifactoriamente!'));
    }

    public function pdf(Request $request)
    {
        $datatable = Proveedores::sqlReport($request);
        //dd($datatable);
        return PDF::loadView('proveedor.proveedorPdf', compact('datatable'))
                  ->setPaper('letter');
    }
}
