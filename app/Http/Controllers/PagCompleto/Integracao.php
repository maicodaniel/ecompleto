<?php

namespace App\Http\Controllers\PagCompleto;

use App\Http\Controllers\Controller;
use App\Models\clientes;
use App\Models\lojas_gateways;
use App\Models\pedidos;
use App\Models\pedidos_pagamentos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class Integracao extends Controller
{

    /**
     * Busca os dados brutos da tabela e envia para a ordenacao dos mesmos
     */
    public function transacaoLojas()
    {
        $lojasGateway = lojas_gateways::where('id_gateway',1)->get();

        foreach ($lojasGateway as $loja ) {
            $nloja = $loja->id_loja;
            $pedidos = pedidos::where([['id_situacao',1],['id_loja',$nloja]])->get();

            foreach ($pedidos as $pagamentos) {
                $npedido = $pagamentos->id;
                $pedidosPagamentos = pedidos_pagamentos::where([['id_formapagto',3],['id_pedido',$npedido]])->get();
                $dados = new Integracao();
                $dados->dados($pedidosPagamentos);
            }
        }
    }

    /**
     * monta o corpo da requisicao
     */
    public function integracao($dados)
    {
        $endPoint =  '/exams/processTransaction';
        $url = 'https://api11.ecompleto.com.br'.$endPoint;

        foreach ($dados as $data) {
            $pedidoPagamentoId = $data['pedidoPagamentoId'];
            $externalOrderId = $data['externalOrdemId'];
            $amount = $data['amount'];
            $cardNumber = $data['cardNumber'];
            $cardCvv = $data['cardCvv'];
            $cardExpiration = $data['cardExpiration'];
            $cardHolderName = $data['cardHolderName'];
            $externalId = $data['externalId'];
            $name = $data['name'];
            $type = $data['type'];
            $email = $data['email'];
            $docType = $data['docType'];
            $docNumber = $data['docNumber'];
            $birthday = $data['birthday'];
        }

        $header = [
            'Authorization:  API_KEY',
            'Content-Type: application/json'
        ];
        $post = [
            "external_order_id" => $externalOrderId,
            "amount" => $amount,
            "card_number" => $cardNumber,
            "card_cvv" => $cardCvv,
            "card_expiration_date" => $cardExpiration,
            "card_holder_name" => $cardHolderName,
            "customer" => [
                "external_id" => $externalId,
                "name" => $name,
                "type" => $type,
                "email" => $email,
                "documents" => [
                    [
                        "type" => $docType,
                        "number" => $docNumber
                    ]
                ],
                "birthday" => $birthday
            ]
        ];

        $json = json_encode($post);
        $curl = curl_init();
        curl_setopt_array($curl,
         [
            CURLOPT_URL => $url,
            CURLOPT_POST => 'true',
            CURLOPT_VERBOSE => 1,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => $header,
            CURLOPT_POSTFIELDS => $json,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_HEADER => true
         ]);

        $response = curl_exec($curl);


        if($errno = curl_errno($curl)) {
            $error_message = curl_strerror($errno);
            echo "cURL error ({$errno}):\n {$error_message}";
        }

        curl_close($curl);

    }

    /**
     * atribui os dados recebidos as chaves que serao enviadas
     */
    public function dados($dados)
    {

        $resp = array();

        foreach ($dados as $data) {
            $pedidoPagamentoId = $data->id;
            $cardExpiration = $data->vencimento;
            $cardNumber = $data->num_cartao;
            $cardCvv = $data->codigo_verificacao;
            $cardHolderName = $data->nome_portador;
            $pedidos = pedidos::where('id',$data->id_pedido)->get();

            foreach ($pedidos as $pedido) {
                $amount = ($pedido->valor_total)+($pedido->valor_frete);
                $externalOrderId = $pedido->id;
                $clientes = clientes::where('id',$pedido->id_cliente)->get();

                foreach ($clientes as $cliente) {
                    $externalId = $cliente->id;
                    $name = $cliente->nome;
                    $email = $cliente->email;
                    $docNumber = $cliente->cpf_cnpj;
                    $birthday = $cliente->data_nasc;
                }
            }
        }

        $type ='individual';
        $docType ='cpf';

        array_push($resp,
            [
                "pedidoPagamentoId" => $pedidoPagamentoId,
                "docNumber" => $docNumber,
                "docType" => $docType,
                "birthday" => $birthday,
                "type" => $type,
                "email" => $email,
                "name" => $name,
                "externalId" => $externalId,
                "amount" => $amount,
                "cardHolderName" => $cardHolderName,
                "cardCvv" => $cardCvv,
                "cardNumber" => $cardNumber,
                "cardExpiration" => $cardExpiration,
                "externalOrdemId" => $externalOrderId
            ]
        );


        $inter =  new Integracao();
       // $inter->integracao($resp);
        $api = $this->apiRequest($resp);
    }

    public function apiRequest($dados)
    {

        $endPoint =  '/exams/processTransaction';
        $url = 'https://api11.ecompleto.com.br'.$endPoint;
        $response = Http::withHeaders(
            [
                'Authorization' => 'API_KEY'
            ]
                )->post($url, $dados);
var_dump($response);
        return response($response);
    }
}
