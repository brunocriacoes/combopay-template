<?php

class PagarMeCostumer extends PagarMe implements IPagarMeCostumer{
    
    
    public function get_by_id(int $customer_id): array
    {
    }

    public function create(string $name, string $email, int $external_id, array $phone_numbers, array $cpf): int
    {
        $payload = [
            'name' => $name,
            'email' => $email,
            'external_id' => $external_id,
            'type' => 'individual',
            'country' => 'br',
            'phone_numbers' => [$phone_numbers],
            'documents' => [
                'type' => 'cpf',
                'number' => $cpf
            ]
            
        ];
        return $this->post('/customers', $payload);
        
    
    
    }
    

    public function update(int $customer_id, string $name, string $email): void
    {}

    
    



   

}