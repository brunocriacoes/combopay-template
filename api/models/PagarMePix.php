<?php
class PagarMePix extends PagarMe
{
    function __construct()
    {
        parent::__construct();
    }
    function pay(int $amount): array
    {
        $payload = [
            'payment_method' => 'pix',
            'amount' => $amount,
            'pix_expiration_date' => date('Y-m-d', strtotime('+7 days')),
            'pix_additional_fields' => [
                [
                    'name' => 'Doação',
                    'value' => 'R$' . number_format($amount / 100, 2, ',', '.')
                ]
            ]
        ];
        return $this->post('/transactions', $payload);
    }
    static function route()
    {

        

        $doador_id = 1;
        $metodo = $_REQUEST['metodo'];
        $instituicao_id = $_REQUEST['instituicao_id'];
        $quantia = intval( $_REQUEST['quantia'] );

        $pix = new PagarMePix();        
        $resposta = $pix->pay($quantia);

        $codigo_pix = $resposta['pix_qr_code'];
        $id = $resposta['id'];

        $created_at = date('Y-m-d H:i:s');
        $updated_at = date('Y-m-d H:i:s');

        $nome = $_REQUEST['cliente']['nome'];
        $cpf = $_REQUEST['cliente']['cpf'];

        $con = new BancoM();
        $sql = "INSERT INTO historico_compras ";
        $sql .= "( id, tipo, status, instituicao_id, doador_id, created_at, updated_at, quantia, nome, codigo_barras, url, cpf ) ";
        $sql .= "VALUES ";
        $sql .= "( '$id', '$metodo', 'waiting_payment', '$instituicao_id', '$doador_id', '$created_at', '$updated_at', '$quantia', '$nome', '$codigo_pix', 'http://doardigital.com.br', '$cpf' )";

        $con->exec( $sql );
       
        echo json_encode([
            'status' => 'success',
            'message' => 'Sucesso',
            'qr' => $resposta['pix_qr_code'],
            'id_transaction' => $resposta['id'], 
            'sql' => $sql
        ]);
    }
}
