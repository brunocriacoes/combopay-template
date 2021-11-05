<?php
class BancoM
{
    private $host, $db, $user, $pass;
    function __construct()
    {
        $this->host = 'server17.i7host.com.br';
        $this->db = 'doardi27_api';
        $this->user = 'doardi27_digital';
        $this->pass = 'Seraph@121';
    }
    function query(string $sql): array
    {
        try {
            $con = new PDO("mysql:host={$this->host};dbname={$this->db}", $this->user, $this->pass);
            $query = $con->query($sql);
            $result = $query->fetchAll();
            $con = null;
            return $result;
        } catch (\Throwable $th) {
            return [
                "error" => "Não foi possivel acessar o banco"
            ];
        }
    }
    function exec(string $sql): void
    {
        try {
            $con = new PDO("mysql:host={$this->host};dbname={$this->db}", $this->user, $this->pass);
            $query = $con->query($sql);
            $con = null;
        } catch (\Throwable $th) {
            echo "Não foi possivel acessar o banco";
        }
    }
}
