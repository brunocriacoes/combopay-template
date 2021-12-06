<?php

include __DIR__ . "/../interfaces/IDoador.php";
class Doador implements IDoador
{
    static function gravatar()
    {
        Header('Content-Type: image/png');
        $email = $_GET['email'] ?? 'default@default.com.br';
        $email = md5(strtolower(trim($email)));
        $img = "https://www.gravatar.com/avatar/{$email}";
        echo file_get_contents($img);
    }

    public function exist(string $cpf): bool
    {
        $banco = new BancoM;
        $sql = "SELECT * FROM doador WHERE cpf='$cpf'";
        $guard = $banco->query($sql);
        return !empty($guard);
    }


    public function get_by_costumer_id(int $id): array
    {
        $banco = new BancoM();
        $sql = "SELECT * FROM doador WHERE codigo_pagarme='$id'";
        $guard = $banco->query($sql);
    }

    public function add_costumer_id(int $id, int $costumer_id_pagar_me): void
    {
        $banco = new BancoM();
        $sql = "UPDATE doador SET codigo_pagarme='$costumer_id_pagar_me' WHERE id='$id'";
        $banco->exec($sql);
    }

    public function get_by_id(int $id): array
    {
        $banco = new BancoM();
        $sql = "SELECT * FROM doador WHERE id='$id'";
        $guard = $banco->query($sql);
        return $guard;
    }

    public function get_by_email(string $email): array
    {
        $banco = new BancoM();
        $sql = "SELECT * FROM doador WHERE email='$email'";
        $guard = $banco->query($sql);
        return $guard;
    }

    public function get_by_cpf(string $cpf): array
    {
        $banco = new BancoM();
        $sql = "SELECT * FROM doador WHERE cpf='$cpf'";

        $guard = $banco->query($sql);
        return $guard[0] ?? [];
    }
    public function create(string $name, string $email, string $phone_numbers, string $cpf, string $senha = '', string $genero = '', int $costumer_id = 0, int $instituicao_id = 1, array $options ): void
    {
        $banco = new BancoM();
        $dados_m = [
            'rua' => $options['cliente']['rua'] ?? null,
            'cidade' => $options['cliente']['cidade'] ?? null,
            'estado' => $options['cliente']['estado'] ?? null,
            'bairro' => $options['cliente']['bairro'] ?? null,
            'complemento' => '',
            'ativo' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
            'dataNascimento' => '',
            'numero' => $options['cliente']['numero'] ?? null,
            'cep' => $options['cliente']['cep'] ?? null,
            'sobrenome' => '',
            'sexo' => '',
            'codigo_zoop' => ''
        ];
        
        $cols = implode( ', ', array_keys($dados_m) );
        $values = implode( ', ', array_map( function( $v ) { return "'".$v."'"; }  ,array_values($dados_m)) );
        $sql = "INSERT INTO doador ";
        $sql .= "( nome, email, telefone, cpf, codigo_pagarme, instituicao_id, $cols ) ";
        $sql .= "VALUES ";
        $sql .= "('$name', '$email', '$phone_numbers', '$cpf', '1', '$instituicao_id', $values )";
        $banco->exec($sql);
    }

    static function teste()
    {
    }
}
