<?php

namespace App\Http\Controllers;

use App\Models\Transacoes;
use Illuminate\Http\Request;
use App\Http\Resources\Transacoes as TransacoesResource;

class TransacoesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        //
        $transacoes = Transacoes::latest()->paginate(15)->where('user_id', $id);
        return TransacoesResource::collection($transacoes);
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
        $transacoes = new Transacoes();
        $transacoes->date = $request->input('date');
        $transacoes->valor = $request->input('valor');
        $transacoes->descricao = $request->input('descricao');
        $transacoes->categoria = $request->input('categoria');
        $transacoes->user_id = $request->input('user_id');

        if( $transacoes->save() ){
            return new TransacoesResource( $transacoes );
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
    public function update(Request $request, $id)
    {
        //
        $this->validate($request, [
            'date' => 'required|max:255',
            'valor' => 'required|max:255',
            'descricao' => 'required|max:255',
            'categoria' => 'required|max:255',
        ]);
        $transacoes = Transacoes::findOrFail( $request->id );                
        $transacoes->date = $request->input('date');
        $transacoes->valor = $request->input('valor');
        $transacoes->descricao = $request->input('descricao');
        $transacoes->categoria = $request->input('categoria');
        

        if( $transacoes->save() ){
            return new TransacoesResource( $transacoes );
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
        $transacoes = Transacoes::find($id);
        $transacoes->delete();
        return response()->json('transacoes deleted!');
    }
}
