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
        $clients = Client::all();
        return view('client.index', compact('clients'));
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
        //Validações do fomulário
        $request->validate([
            'name' => 'required|min:4|max:30',
            'cpf' => 'required|formato_cpf|cpf|unique:clients,cpf|max:14',
            'email' => 'required|email|unique:clients,email|max:30',
            'phone' => 'required|Celular|unique:clients,phone|max:10',
            'cep' => 'required|formato_cep|max:9',
            'localidade' => 'required',
            'logradouro' => 'required',
            'complemento' => 'required',
            'bairro' => 'required',
            'uf' => 'required|uf|max:2',
        ]);
        // Array associativo do endereço
        $address = [
            'cep' => $request->cep,
            'localidade' => $request->localidade,
            'logradouro' => $request->logradouro,
            'complemento' => $request->complemento,
            'bairro' => $request->bairro,
            'uf' => $request->uf,
        ];

        Address::create($address);
        
        // Array associativo do cliente, pegando o ultimo registro de endereço como id no id_address
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

        return redirect()->route('client.index')->with('msg', "Cliente adicionado com sucesso!");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $client = Client::find($id);
        $address = Address::where(["id" => $client->id_address])->first();
        return view('client.view', compact('client', 'address'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $client = Client::find($id);
        $address = Address::where(["id" => $client->id_address])->first();
        return view('client.create', compact('client', 'address'));
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
        // Validações do formulário
        $request->validate([
            'name' => 'required|min:4|max:30',
            'cpf' => 'required|formato_cpf|cpf|max:14',
            'email' => 'required|email|max:30',
            'phone' => 'required|Celular|max:10',
            'cep' => 'required|formato_cep|max:9',
            'localidade' => 'required',
            'logradouro' => 'required',
            'complemento' => 'required',
            'bairro' => 'required',
            'uf' => 'required|uf|max:2',
        ]);

        // Array associativo do endereço
        $address = [
            'cep' => $request->cep,
            'localidade' => $request->localidade,
            'logradouro' => $request->logradouro,
            'complemento' => $request->complemento,
            'bairro' => $request->bairro,
            'uf' => $request->uf,
            'updated_at' => date('Y-m-d H:i:s')
        ];

        $client = Client::find($id);

        Address::where(['id' => $client->id_address])->update($address);

        // Array associativo do cliente
        $client_data = [
            'name' => $request->name,
            'cpf' => $request->cpf,
            'email' => $request->email,
            'phone' => $request->phone,
            'updated_at' => date('Y-m-d H:i:s')
        ];

        Client::where(['id' => $client->id])->update($client_data);

        return redirect()->route('client.index')->with('msg', "Cliente alterado com sucesso!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $client = Client::find($id);
        $client->delete();
        return redirect()->route('client.index')->with('msg', "Cliente deletado com sucesso!");
    }
}
