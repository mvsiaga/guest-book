<?php
namespace App\Services\Guests;

class GuestsService
{
    public function getRepository()
    {
        return new Repositories\GuestsRepository;
    }
}