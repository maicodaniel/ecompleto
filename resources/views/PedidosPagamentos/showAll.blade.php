@extends('layout.adm')

@section('content')
    <div class="col ">
        <div class='row '>
            <div class="col-md-12 ">
                <div class="card">
                    <table id="table" class="tb hover dataTable table-striped no-footer" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>Nome</th>
                                <th>Email</th>
                                <th>Valor</th>
                                <th>Nome no cartão</th>
                                <th>Data da compra</th>
                                <th>Situação</th>
                                <th>Gateway</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pedidosPagamentos as $pedidos )
                            <tr>
                                <td>{{$pedidos['name']}}</td>
                                <td>{{$pedidos['email']}}</td>
                                <td>{{$pedidos['amount']}}</td>
                                <td>{{$pedidos['cardHolderName']}}</td>
                                <td>{{date('d/m/Y',strtotime($pedidos['dateBuy']))}}</td>
                                <td>{{$pedidos['idSituation']}}</td>
                                <td>{{$pedidos['idGateway']}}</td>
                                <td>
                                    <div class="row">
                                        <div>

                                        </div>
                                        <div>

                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <hr>
                <div class="card-footer">
                    <a class="btn btn-link" href="{{ route('pedidos.index') }}">Home</a>
                    <a class="btn btn-link" href="{{ route('integracao') }}">API</a>
                </div>
            </div>
        </div>
    </div>

@endsection
