<?php

class PagarMeCostumer implements IPagarMeCostumer{
    
    
    public function create(string $name, string $email, int $external_id, array $phone_numbers, array $cpf): int
    {
        $banco = new BancoM();
        $sql = "INSERT INTO pagarmecostumer";
        $sql .= "(id, nome, email, telefone, cpf, sexo, codigo_pagarme)";
        $sql .= "VALUES";
        $sql .= "('$name', '$email', '$external_id', '$phone_numbers', '$cpf')";
        $banco->exec($sql);
    }

    public function update(int $customer_id, string $name, string $email): void
    {
        
    }


   

}