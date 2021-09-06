<?php

namespace App\Http\Controllers\PagCompleto;

use App\Http\Controllers\Controller;
use App\Models\clientes;
use App\Models\gateways;
use App\Models\lojas_gateways;
use App\Models\pedidos;
use App\Models\pedidos_pagamentos;
use App\Models\pedidos_situacao;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\Cast\Object_;
use App\Http\Controllers\PagCompleto\Integracao;

class PedidosPagamentosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rest = array();
        $pedidosPagamentos = pedidos_pagamentos::all();
        foreach ($pedidosPagamentos as $data) {
            $pedidoPagamentoId = $data->id;
            $cardExpiration = $data->vencimento;
            $cardNumber = $data->num_cartao;
            $cardCvv = $data->codigo_verificacao;
            $cardHolderName = $data->nome_portador;
            $pedidos = pedidos::where('id',$data->id_pedido)->get();

            foreach ($pedidos as $pedido) {
                $amount = ($pedido->valor_total)+($pedido->valor_frete);

                $idSituation = $pedido->id_situacao;
                $dateBuy = $pedido->data;
                $externalOrderId = $pedido->id;

                $idSituation = pedidos_situacao::where('id',$pedido->id_situacao)->value('descricao');

                $idLoja = lojas_gateways::where('id_loja',$pedido->id_loja)->value('id_gateway');
                $idGateway = gateways::where('id',$idLoja)->value('descricao');

                $clientes = clientes::where('id',$pedido->id_cliente)->get();

                foreach ($clientes as $cliente) {
                    $externalId = $cliente->id;
                    $name = $cliente->nome;
                    $email = $cliente->email;
                    $docNumber = $cliente->cpf_cnpj;
                    $birthday = $cliente->data_nasc;

                    $resp = array();


                            $resp["pedidoPagamentoId"] = $pedidoPagamentoId;
                            $resp["docNumber"] = $docNumber;
                            $resp["birthday"] = $birthday;
                            $resp["email"] = $email;
                            $resp["name"] = $name;
                            $resp["externalId"] = $externalId;
                            $resp["amount"] = $amount;
                            $resp["cardHolderName"] = $cardHolderName;
                            $resp["cardCvv"] = $cardCvv;
                            $resp["cardNumber"] = $cardNumber;
                            $resp["cardExpiration"] = $cardExpiration;
                            $resp["externalOrderId"] = $externalOrderId;
                            $resp["dateBuy"] = $dateBuy;
                            $resp['idSituation'] = $idSituation;
                            $resp['idGateway'] = $idGateway;



                    array_push($rest, $resp);
                }
            }
        }


        $response = (Object)$rest;

        return view('PedidosPagamentos.showAll',['pedidosPagamentos' => $rest]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\pedidos_pagamentos  $pedidos_pagamentos
     * @return \Illuminate\Http\Response
     */
    public function show(pedidos_pagamentos $pedidos_pagamentos)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\pedidos_pagamentos  $pedidos_pagamentos
     * @return \Illuminate\Http\Response
     */
    public function edit(pedidos_pagamentos $pedidos_pagamentos)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\pedidos_pagamentos  $pedidos_pagamentos
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, pedidos_pagamentos $pedidos_pagamentos)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\pedidos_pagamentos  $pedidos_pagamentos
     * @return \Illuminate\Http\Response
     */
    public function destroy(pedidos_pagamentos $pedidos_pagamentos)
    {
        //
    }
}
