@extends('template.default')

@section('content')

<div class="container h-100">
    <div class="row justify-content-center mt-4">
        <div class="col-md-4">

            <!-- Inicio da tabela de informaões -->
            <table class="table">
                <tr>
                    <th>Nome: </th>
                    <td>{{$client->name}}</td>
                </tr>
                <tr>
                    <th>CPF: </th>
                    <td>{{$client->cpf}}</td>
                </tr>
                <tr>
                    <th>Email: </th>
                    <td>{{$client->email}}</td>
                </tr>
                <tr>
                    <th>Telefone: </th>
                    <td>{{$client->phone}}</td>
                </tr>
                <tr>
                    <th>CEP: </th>
                    <td>{{$address->cep}}</td>
                </tr>
                <tr>
                    <th>Localidade: </th>
                    <td>{{$address->localidade}}</td>
                </tr>
                <tr>
                    <th>Logradouro: </th>
                    <td>{{$address->logradouro}}</td>
                </tr>
                <tr>
                    <th>Complemento: </th>
                    <td>{{$address->complemento}}</td>
                </tr>
                <tr>
                    <th>Bairro: </th>
                    <td>{{$address->bairro}}</td>
                </tr>
                <tr>
                    <th>UF: </th>
                    <td>{{$address->uf}}</td>
                </tr>
            </table>
            <!-- Fim da tabela de informaões -->
            <div class="d-flex justify-content-center">
                <a href="{{ route('client.index') }}" class="btn btn-danger">Voltar</a>
            </div>

        </div>
    </div>
    @endsection