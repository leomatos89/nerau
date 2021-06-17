@extends('template.default')

@section('content')

<div class="container mt-2 ">
    <div class="row justify-content-center">
        <div class="col-md-10 border p-2">
            <h4>@if(isset($client)) Cadastro @else Editar @endif de cliente</h4>
            @if (isset($client))
            <form action="{{ route('client.update',$client->id) }}" method="POST"> <!-- Formulário do update quando chamado atráves da rota edit -->
                @method('PUT')
                @else
                <form action="{{ route('client.store') }}" method="POST"> <!-- Formulário do store quando chamado atráves da rota create -->
                    @endif

                    @csrf

                    <div class="row mb-3">
                        <div class="col-md-8">
                            <label for="name" class="form-label">Nome</label>
                            <input type="text" name="name" id="name" class="form-control" placeholder="Nome"
                                value="{{$client->name ?? old('name')}}">
                        </div>
                        <div class="col-md-4">
                            <label for="cpf" class="form-label">CPF</label>
                            <input type="text" name="cpf" id="cpf" class="form-control" maxlength="14"
                                placeholder="xxx.xxx.xxx-xx" value="{{$client->cpf ?? old('cpf')}}">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" name="email" id="email" class="form-control"
                                placeholder="exemplo@exemplo.com" value="{{$email->email ?? old('email')}}">
                        </div>

                        <div class="col">
                            <label for="celphone" class="form-label">Telefone Celular</label>
                            <input type="text" name="celphone" id="celphone" class="form-control" placeholder="12345-6789"
                                value="{{$phone->celphone ?? old('celphone')}}" maxlength="10">
                        </div>

                        <div class="col">
                            <label for="phone" class="form-label">Telefone Fixo</label>
                            <input type="text" name="phone" id="phone" class="form-control" placeholder="1234-5678"
                                value="{{$phone->phone ?? old('phone')}}" maxlength="9">
                        </div>
                    </div>
                    <div class=" row mb-3">
                        <div class="col-md-2">
                            <label for="cep" class="form-label">CEP</label>
                            <input type="text" name="cep" id="cep" class="form-control" maxlength="9"
                                placeholder="xxxxx-xxx" value="{{$address->cep ?? old('cep')}}">
                        </div>

                        <div class="col-md-3">
                            <label for="localidade" class="form-label">Localidade</label>
                            <input type="text" name="localidade" id="localidade" class="form-control"
                                placeholder="Praça da Sé" value="{{$address->localidade ?? old('localidade')}}">
                        </div>

                        <div class="col-md-7">
                            <label for="logradouro" class="form-label">logradouro</label>
                            <input type="text" name="logradouro" id="logradouro" class="form-control"
                                placeholder="Jardim Sp" value="{{$address->logradouro ?? old('logradouro')}}">
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md">
                            <label for="complemento" class="form-label">Complemento</label>
                            <input type="text" name="complemento" id="complemento" class="form-control"
                                placeholder="lado impar" value="{{$address->complemento ?? old('complemento')}}">
                        </div>

                        <div class="col-md">
                            <label for="bairro" class="form-label">Bairro</label>
                            <input type="text" name="bairro" id="bairro" class="form-control"
                                placeholder="Jd. Bela vista" value="{{$address->bairro ?? old('bairro')}}">
                        </div>

                        <div class="col-md-1">
                            <label for="uf" class="form-label">UF</label>
                            <input type="text" name="uf" id="uf" class="form-control" placeholder="SP"
                                value="{{$address->uf ?? old('uf')}}">
                        </div>
                    </div>

                    <div class="d-flex justify-content-between">
                        <button type="submit" class="btn btn-primary">@if(isset($client)) Editar @else Cadastrar
                            @endif</button>
                        <a href="{{ route('client.index') }}" class="btn btn-danger">Voltar</a>
                    </div>
                </form> <!-- fim do formulário -->
        </div>
        <div class="row justify-content-center mt-2">
            <div class="col-md-10">
                @if ($errors->all())
                <div class="alert alert-danger" role="alert">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{$error}}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

@endsection