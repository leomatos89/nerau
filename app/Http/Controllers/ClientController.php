<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('client.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('client.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'cpf' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'cep' => 'required',
            'localidade' => 'required',
            'logradouro' => 'required',
            'complemento' => 'required',
            'bairro' => 'required',
            'uf' => 'required',
        ]);

        $address = [
            'cep' => $request->cep,
            'localidade' => $request->localidade,
            'logradouro' => $request->logradouro,
            'complemento' => $request->complemento,
            'bairro' => $request->bairro,
            'uf' => $request->uf,
        ];

        Address::create($address);

        $client = [
            'name' => $request->name,
            'cpf' => $request->cpf,
            'email' => $request->email,
            'phone' => $request->phone,
            'id_address' => DB::table('addresses')
            ->latest()
            ->first()->id
        ];

        Client::create($client);

        return redirect()->route('client.index')->with('msg',"Cliente adicionado com sucesso!");
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
    }
}
