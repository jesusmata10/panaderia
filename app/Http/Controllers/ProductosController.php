<?php

namespace App\Http\Controllers;

use App\Productos;
use App\Proveedores;
use Illuminate\Http\Request;
use App\Http\Requests\ProductoRequest;
use PDF;
use Illuminate\Support\Facades\Storage;

class ProductosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        
        $datatable = Productos::sqlReport($request);

        return view('producto.index', compact('datatable'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $proveedor = Proveedores::Consulta();

         return view('producto.create', compact('proveedor'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductoRequest $request)
    {

         try {

            $input = $request->all();
            $producto=Productos::create($input);

            if ($request->file('imagen') != null) {
                $file = $request->file('imagen');
                $fileName = 'imagen-'.time().'.'.$file->getClientOriginalExtension();
                $path = $file->storeAs($producto->id, $fileName);

            }

            return redirect('/producto')->with('success', __('¡Producto Creado sastifactoriamente!'));

        } catch (QueryException $e) {

            return redirect('/producto')->with('error', __('Ha ocurrido un Problema'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Productos  $productos
     * @return \Illuminate\Http\Response
     */
    public function show(Productos $productos)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Productos  $productos
     * @return \Illuminate\Http\Response
     */
    public function edit(Productos $productos, $producto)
    {
        //$productos = Productos::Consulta();

        try {

            $productos = Productos::where('id', $producto)->first();;
            //dd($producto);
            return view('producto.edit', ['productos' => $productos]);
            
        } catch (Exception $e) {
            
            return redirect('/producto')->with('error', __('Ha ocurrido un Problema'));

        }


    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Productos  $productos
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Productos $productos)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Productos  $productos
     * @return \Illuminate\Http\Response
     */
    public function destroy(Productos $productos, $producto)
    {
        try {
            $data = Productos::where('id', $producto)->delete();

            return back()->with('success', __('¡Producto eliminado sastifactoriamente!'));

        } catch (Exception $e) {

            return back()->with('error', __('¡Ha ocurrido un Error'));

        }

    }

    public function pdf(Request $request)
    {
        $datatable = Productos::sqlReport($request);
        return PDF::loadView('producto.productosPdf', compact('datatable'))
                  ->setPaper('letter')
                  ->stream('producto.productosPdf');
    }
}
