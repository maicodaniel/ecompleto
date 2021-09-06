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
                                <th>Loja</th>
                                <th>Gateway</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($lojasGateway as $gate )
                            <tr>
                                <td>{{$gate->id}}</td>
                                <td>{{$gate->id_loja}}</td>
                                <td>{{$gate->id_gateway}}</td>

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
