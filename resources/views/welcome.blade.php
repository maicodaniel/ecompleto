@extends('layout.adm')

@section('content')
    <div  class="row justify-content-center">
        <div class="col-6 text-center">
            <h1>Ola</h1>
        </div>
        <div>
            <a class="btn btn-link" href="{{ route('pedidos-pagamento.index') }}">Detalhes</a>
        </div>
    </div>


@endsection

