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
                                <th>Data de nascimento</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($gateways as $gate )
                            <tr>
                                <td>{{$gate->nome}}</td>
                                <td>{{$gate->cpf_cnpj}}</td>

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

                </div>
            </div>
        </div>
    </div>

@endsection
