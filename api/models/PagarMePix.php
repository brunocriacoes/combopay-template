<?php
class PagarMePix extends PagarMe
{
    function __construct()
    {
        parent::__construct();
    }
    function pay(int $amount, array $split): array
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
            ],
            'split_rules' => $split
        ];
        return $this->post('/transactions', $payload);
    }
    static function route()
    {
        header("Content-Type: application/json");

        $metodo = $_REQUEST['metodo'];
        $instituicao_id = $_REQUEST['instituicao_id'];
        $quantia = intval($_REQUEST['quantia']);

        $con = new BancoM();
        $cons = "SELECT * FROM split_configs 
        WHERE instituicao_id=$instituicao_id";
        $res_splits = $con->query($cons);
        $dados_splits = [];
        foreach ($res_splits as $i) {
            $dados_splits[] =  [
                'recipient_id' =>  $i['recebedor_id'],
                'liable' => (bool) intval($i['responsavel']),
                'percentage' => intval($i['porcetagem']),

            ];
        }

        $doador = new Doador();

        $pix = new PagarMePix();
        $resposta = $pix->pay($quantia, $dados_splits);

        $codigo_pix = $resposta['pix_qr_code'];
        $id = $resposta['id'];

        $created_at = date('Y-m-d H:i:s');
        $updated_at = date('Y-m-d H:i:s');

        $nome = $_REQUEST['cliente']['nome'];
        $cpf = $_REQUEST['cliente']['cpf'];

        $costumer = null;

        if( !$doador->exist( $cpf ) ) {
            
            $doador->create(
                $_REQUEST['cliente']['nome'],
                $_REQUEST['cliente']['email'],
                $_REQUEST['cliente']['telefone'],
                $cpf,
                '',
                '',
                0,
                $_REQUEST['instituicao_id'],
                $_REQUEST
            );
        } 

        $costumer = $doador->get_by_cpf($cpf);

        if( $costumer['codigo_pagarme'] == '1' ) {
            $pagar_me_costumer = new PagarMeCostumer();

            $id_costumer = $pagar_me_costumer->create(
                $_REQUEST['cliente']['nome'],
                $_REQUEST['cliente']['email'],
                $costumer['id'],
                [$_REQUEST['cliente']['telefone']],
                $cpf
            );
            $doador->add_costumer_id( $costumer['id'], $id_costumer );
        }

        $costumer = $doador->get_by_cpf($cpf);

        $doador_id = $costumer['id'];
        $sql = "INSERT INTO historico_compras ";
        $sql .= "( id, tipo, status, instituicao_id, doador_id, created_at, updated_at, quantia, nome, codigo_barras, url, cpf ) ";
        $sql .= "VALUES ";
        $sql .= "( '$id', '$metodo', 'waiting_payment', '$instituicao_id', '$doador_id', '$created_at', '$updated_at', '$quantia', '$nome', '$codigo_pix', 'http://doardigital.com.br', '$cpf' )";

        $con->exec($sql);

        echo json_encode([
            'status' => 'success',
            'message' => 'Sucesso',
            'qr' => $resposta['pix_qr_code'],
            'id_transaction' => $resposta['id'],
            'sql' => $sql
        ]);
    }
}
