<?php

class PagarMeCostumer extends PagarMe{

    function cadastro(int $amount, array $split): array
    {

        $payload = [
            'name' => null,
            'email' => null,
            'external_id' => null,
            'type' => null,
            'country' => null,
            'birthday' => null,
            'phone_numbers' => [],
            'documents' => []
            
        ];
        return $this->post('/transactions', $payload);
    }


    static function router(){
        
        
    }

}