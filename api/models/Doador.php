<?php

class Doador
{
    static function gravatar()
    {
        Header('Content-Type: image/png');
        $email = $_GET['email'] ?? 'default@default.com.br';
        $email = md5(strtolower(trim($email)));
        $img = "https://www.gravatar.com/avatar/{$email}";
        echo file_get_contents($img);
    }

    static function pesquisa($nome): bool{
        $con = new BancoM();
        $sql = "SELECT * FROM doador WHERE nome=$nome";
        $guard = $con->query($sql);
        return empty($guard);
        var_dump($guard);
    }
    
    static function teste(){

        Doador::pesquisa("kleber");
    }

    
}
