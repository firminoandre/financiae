<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;
use App\Http\Resources\Categoria as CategoriaResource;

class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        //
        $categoria = Categoria::paginate(15)->where('user_id', $id);
        return CategoriaResource::collection($categoria);
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
        //
        $categoria = new Categoria;
        $categoria->categoria = $request->input('categoria');
        $categoria->user_id = $request->input('user_id');

        if( $categoria->save() ){
            return new CategoriaResource( $categoria );
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
    public function update($id, Request $request)
    {
        $this->validate($request, [
            'categoria' => 'required|max:255',
        ]);
        $categoria = Categoria::findOrFail( $request->id );                
        $categoria->categoria = $request->input('categoria');
        

        if( $categoria->save() ){
            return new CategoriaResource( $categoria );
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $categoria = Categoria::find($id);
        $categoria->delete();
        return response()->json('categoria deleted!');
    }
}
