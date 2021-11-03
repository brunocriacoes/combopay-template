<?php


interface IPagarMeCostumer extends PagarMe
{
    public function create(
        string $name,
        string $email,
        int $external_id,
        array $phone_numbers,
        array $cpf
    ): int;

    public function get(
        int $customer_id
    ): array;

    public function update(
        int $customer_id,
        string $name,
        string $email
    ): void;
}
