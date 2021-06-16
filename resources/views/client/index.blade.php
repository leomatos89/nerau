@extends('template.default')

@section('content')
    
    <div class="container h-100 p-2">
        <div class="row">
            <div class="col-md">
                Teste Nerau <br> <b> Cadastro de Cliente </b>
            </div>
        </div>
        @if (session('msg'))
            <div class="alert alert-success" role="success">
                {{session('msg')}}
            </div>
        @endif
        <div class="border p-2 mt-3">
        <div class="row mt-4">
            <div class="d-flex justify-content-between">
                <div class="col-md-4 text-start">
                    <h4>Tabela de Clientes</h4>
                </div>
                <div class="col-md-4 text-end">
                    <a href="{{ route('client.create') }}" class="btn btn-success">Novo Cliente</a>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md">
                <table class="table">
                    <thead>
                        <th>Nome</th>
                        <th>CPF</th>
                        <th>Email</th>
                        <th>Telefone</th>
                        <th>Endereço</th>
                        <th>Ações</th>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
    </div>

@endsection
