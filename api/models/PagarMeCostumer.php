<?php

include __DIR__ . '/../interfaces/IPagarMeCostumer.php';

class PagarMeCostumer extends PagarMe implements IPagarMeCostumer{
    
    function __construct()
    {
        parent::__construct();
    }
    
    public function get_by_id(int $customer_id): array
    {
    }

    public function create(string $name, string $email, string $external_id, array $phone_numbers, string $cpf): int
    {
        $payload = [
            'name' => $name,
            'email' => $email,
            'external_id' => $external_id,
            'type' => 'individual',
            'country' => 'br',
            'phone_numbers' => $phone_numbers,
            'documents' => [[
                'type' => 'cpf',
                'number' => $cpf
            ]]
            
        ];
        $res = $this->post('/customers', $payload, false);
        return $res['id'];
    
    }
    

    public function update(int $customer_id, string $name, string $email): void
    {}

    static function teste() {
        $costumer = new PagarMeCostumer();
        $costumer->create("victor", "victorfer@gmail.com", "12", ['+5538998019210'], '80303740035');
    }
    

}