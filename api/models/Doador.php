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
    
    public function exist(string $cpf, string $email): bool
    {
        $banco = new BancoM;
        $sql = "SELECT * FROM doador WHERE cpf='$cpf' or email='$email'";
        $guard = $banco->query($sql);
        return $sql;
    }
    

    public function get_by_costumer_id(int $id): array
    {
        $banco = new BancoM();
        $sql = "SELECT * FROM doador WHERE codigo_pagarme='$id'";
        $guard = $banco->query($sql);
                      
    }

    public function add_costumer_id(int $id, int $costumer_id_pagar_me): void
    {
        var_dump($guard);
        
    }

    public function get_by_id(int $id): array
    {
        $banco = new BancoM(); 
        $sql = "SELECT * FROM doador WHERE id='$id'";
        $guard = $banco->query($sql);
        
    }

    public function get_by_email(string $email): array
    {
        $banco = new BancoM();
        $sql = "SELECT * FROM doador WHERE email='$email'";
        $guard = $banco->query($sql);
    }

    public function get_by_cpf(string $cpf): array
    {
        $banco = new BancoM();
        $sql = "SELECT * FROM doador WHERE cpf=$cpf";
        $guard = $banco->query($sql);
        
        
    }
    public function create(string $name, string $email, int $external_id, array $phone_numbers, array $cpf, string $senha = '', string $genero = '', int $costumer_id = 0): int
    {
        $banco = new BancoM();
        $sql = "INSERT INTO doador";
        $sql .= "(id, nome, email, telefone, cpf, sexo, codigo_pagarme)";
        $sql .= "VALUES";
        $sql .= "('$external_id', '$name', '$email', '$phone_numbers', '$cpf', '$genero', '$costumer_id')";
        $banco->exec($sql);
       
    }

    static function teste()
    {
        Doador::get_by_cpf("63203995972");
    }



   
    
}
