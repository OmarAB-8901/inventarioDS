<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use \App\Models\productos;
use \App\Models\categorias_productos;

class inventario extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $productos = $this->getProducts();
        $categorias = categorias_productos::all();

        return json_encode([$productos, $categorias]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $producto = new productos();
        $producto->sku = $request['sku'];
        $producto->nombre = $request['nombre'];
        $producto->id_categoria = $request['categoria'];
        $producto->descripcion = $request['descripcion'];
        $producto->precio = $request['precio'];
        $producto->cantidad = $request['cantidad'];
        $producto->estado = 0;
        $producto->eliminado = 0;
        $producto->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return productos::where('id', $id)->get();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $producto = productos::findOrFail($id);
        $producto->sku = $request['sku'];
        $producto->nombre = $request['nombre'];
        $producto->id_categoria = $request['categoria'];
        $producto->descripcion = $request['descripcion'];
        $producto->precio = $request['precio'];
        $producto->cantidad = $request['cantidad'];
        $producto->estado = $request['stock'];
        $producto->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // $productos = productos::find($id);
        // $productos->delete();

        $productos = productos::findOrFail($id);
        $productos->eliminado = 1;
        $productos->save();
    }


    /**
     * @author: Carlos Omar Anaya Barajas
     * @date: 2022-04-21 16:53:33
     * @param:
     * @return:
     * @desc:
      */

      public function detailProduct($id){

        $detailProduct = $this->getProducts();

        return view("inventario/detailProduct", compact('detailProduct'));
      }

      public function registerProduct(){

        return view("inventario/registerProduct");
      }

      public function qualifyProduct(){

        return view("inventario/qualifyProduct");
      }

      public function getProducts(){

        return productos::where('eliminado', '0')
        ->selectRaw("id, sku, nombre, id_categoria, descripcion, precio, cantidad, IF(estado = 1, 1, 0) AS estado")
        ->get();
      }
}
