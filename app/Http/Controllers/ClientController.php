<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Client;
use App\Models\Email;
use App\Models\Phone;
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
            'name' => 'required|min:4|max:30|regex:/^[a-zA-Z ]+$/',
            'cpf' => 'required|formato_cpf|cpf|max:14|unique:clients,cpf',
            'email' => 'required|email|max:30|unique:emails,email',
            'phone' => 'required|telefone|max:9|nullable|alpha_dash',
            'celphone' => 'required|Celular|max:10|alpha_dash',
            'cep' => 'required|formato_cep|max:9|alpha_dash',
            'localidade' => 'required|max:30',
            'logradouro' => 'required|max:30',
            'complemento' => 'required|max:30',
            'bairro' => 'required|max:30',
            'uf' => 'required|uf|max:2|alpha',
        ]);

        // Array associativo do cliente
        $client = [
            'name' => $request->name,
            'cpf' => $request->cpf,
        ];
        Client::create($client);

        // Array associativo do endereço, usando o id do ultimo cliente adicionado como referencia para id_client
        $address = [
            'cep' => $request->cep,
            'localidade' => $request->localidade,
            'logradouro' => $request->logradouro,
            'complemento' => $request->complemento,
            'bairro' => $request->bairro,
            'uf' => $request->uf,
            'id_client' => DB::table('clients')
                ->latest()
                ->first()->id
        ];
        Address::create($address);

        // Array associativo do email,  usando o id do ultimo cliente adicionado como referencia para id_client
        $email = [
            'email' => $request->email,
            'id_client' => DB::table('clients')
                ->latest()
                ->first()->id
        ];
        Email::create($email);

        // Array associativo do phone,  usando o id do ultimo cliente adicionado como referencia para id_client
        $phone = [
            'phone' => $request->phone,
            'celphone' => $request->celphone,
            'id_client' => DB::table('clients')
                ->latest()
                ->first()->id
        ];
        Phone::create($phone);

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
        //buscando os registros para tela de exibição
        $client = Client::find($id);
        $address = Address::where(["id_client" => $client->id])->first();
        $email = Email::where(["id_client" => $client->id])->first();
        $phone = Phone::where(["id_client" => $client->id])->first();
        return view('client.view', compact('client', 'address','email','phone'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // Buscando os registros para pagina de update
        $client = Client::find($id);
        $address = Address::where(["id_client" => $client->id])->first();
        $email = Email::where(["id_client" => $client->id])->first();
        $phone = Phone::where(["id_client" => $client->id])->first();
        
        return view('client.create', compact('client', 'address','email','phone'));
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
            'name' => 'required|min:4|max:30|regex:/^[a-zA-Z ]+$/',
            'cpf' => 'required|formato_cpf|cpf|max:14',
            'email' => 'required|email|max:30',
            'phone' => 'required|telefone|max:9|nullable|alpha_dash',
            'celphone' => 'required|Celular|max:10|alpha_dash',
            'cep' => 'required|formato_cep|max:9|alpha_dash',
            'localidade' => 'required|max:30',
            'logradouro' => 'required|max:30',
            'complemento' => 'required|max:30',
            'bairro' => 'required|max:30',
            'uf' => 'required|uf|max:2|alpha',
        ]);

        // Buscando o registro do cliente na tabela clients
        $client = Client::find($id);

        // Array associativo do cliente , atualizando as colunas e alterando a coluna update para o dia atual.
           $client_data = [
            'name' => $request->name,
            'cpf' => $request->cpf,
            'updated_at' => date('Y-m-d H:i:s')
        ];
        Client::where(['id' => $client->id])->update($client_data);

        // Array associativo do endereço, atualizando as colunas e alterando a coluna update para o dia atual.
        $address = [
            'cep' => $request->cep,
            'localidade' => $request->localidade,
            'logradouro' => $request->logradouro,
            'complemento' => $request->complemento,
            'bairro' => $request->bairro,
            'uf' => $request->uf,
            'updated_at' => date('Y-m-d H:i:s')
        ];
        Address::where(['id_client' => $client->id])->update($address);

        // Array associativo do email,  atualizando as colunas e alterando a coluna update para o dia atual.
        $email = [
            'email' => $request->email,
            'updated_at' => date('Y-m-d H:i:s')
        ];
        Email::where(['id_client' => $client->id])->update($email);

        // Array associativo do phone,  atualizando as colunas e alterando a coluna update para o dia atual.
        $phone = [
            'phone' => $request->phone,
            'celphone' => $request->celphone,
            'updated_at' => date('Y-m-d H:i:s')
        ];
        Phone::where(['id_client' => $client->id])->update($phone);

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
        // busca o registro do cliente para ser deletado. Obs: delete cascade.
        $client = Client::find($id);
        $client->delete();
        return redirect()->route('client.index')->with('msg', "Cliente deletado com sucesso!");
    }
}
