@extends('template.default')

@section('content')

    <div class="container mt-2 ">
        <div class="row justify-content-center">
            <div class="col-md-10 border p-2">
                <h4>Cadastro de cliente</h4>
                <form action="{{ route('client.store') }}" method="POST">
                    @csrf
                    <div class=" row mb-3">
                        <div class="col-md-8">
                            <label for="name" class="form-label">Nome</label>
                            <input type="text" name="name" id="name" class="form-control">
                        </div>
                        <div class="col-md-4">
                            <label for="cpf" class="form-label">CPF</label>
                            <input type="text" name="cpf" id="cpf" class="form-control">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="text" name="email" id="email" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label for="phone" class="form-label">Telefone</label>
                        <input type="text" name="phone" id="phone" class="form-control">
                    </div>

                    <div class=" row mb-3">
                        <div class="col-md-2">
                            <label for="cep" class="form-label">CEP</label>
                            <input type="text" name="cep" id="cep" class="form-control">
                        </div>

                        <div class="col-md-3">
                            <label for="localidade" class="form-label">Localidade</label>
                            <input type="text" name="localidade" id="localidade" class="form-control">
                        </div>

                        <div class="col-md-7">
                            <label for="logradouro" class="form-label">logradouro</label>
                            <input type="text" name="logradouro" id="logradouro" class="form-control">
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md">
                            <label for="complemento" class="form-label">Complemento</label>
                            <input type="text" name="complemento" id="complemento" class="form-control">
                        </div>

                        <div class="col-md">
                            <label for="bairro" class="form-label">Bairro</label>
                            <input type="text" name="bairro" id="bairro" class="form-control">
                        </div>

                        <div class="col-md-1">
                            <label for="uf" class="form-label">UF</label>
                            <input type="text" name="uf" id="uf" class="form-control">
                        </div>
                    </div>

                    <div class="d-flex justify-content-between">
                        <button type="submit" class="btn btn-primary">Cadastrar</button>
                        <a href="{{ route('client.index') }}" class="btn btn-danger">Voltar</a>
                    </div>
                </form>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-10">
                    @if ($errors->all())
                    <div class="alert alert-danger" role="alert">
                        @foreach ($errors->all() as $error)
                            {{$error}}
                        @endforeach
                    </div>
                @endif
                </div>
            </div>
        </div>
    </div>

@endsection
