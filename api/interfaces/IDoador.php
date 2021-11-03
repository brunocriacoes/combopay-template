<?php

interface IDoador
{

    public function exist(
        string $cpf,
        string $email
    ): bool;

    public function get_by_id(
        int $id
    ): array;

    public function get_by_costumer_id(
        int $id
    ): array;

    public function get_by_cpf(
        string $cpf
    ): array;

    public function get_by_email(
        string $email
    ): array;

    public function create(
        string $name,
        string $email,
        int $external_id,
        array $phone_numbers,
        array $cpf,
        string $senha = '',
        string $genero = '',
        int $costumer_id = 0
    ): int;

    public function add_costumer_id(
        int $id,
        int $costumer_id_pagar_me
    ): void;
}
