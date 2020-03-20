<?php


namespace App\Client;


interface AuthenticationClientInterface
{
    public function authenticate(): void;
}
