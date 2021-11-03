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
        var_dump($guard);
        return $sql;
    }
    
    static function teste()
    {
            Doador::exist("02754669906", "");
    }

    public function get_by_costumer_id(int $id): array
    {
        
    }

    public function add_costumer_id(int $id, int $costumer_id_pagar_me): void
    {
                
    }

    public function get_by_id(int $id): array
    {}

    public function get_by_email(string $email): array
    {}

    public function get_by_cpf(string $cpf): array
    {}
    public function create(string $name, string $email, int $external_id, array $phone_numbers, array $cpf, string $senha = '', string $genero = '', int $costumer_id = 0): int
    {
        $banco = new BancoM();
        
    }




   
    
}
