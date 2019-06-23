<?php
namespace App\Services\Guests\Repositories;

use App\Models\Guest;

class GuestsRepository
{
    /**
     * Create new guest
     *
     * @param [type] $params
     *
     * @return void
     */
    public function createGuest(array $params)
    {
        return Guest::create($params);
    }

    public function updateGuest(int $id, array $params)
    {
        $guest = Guest::find($id);
        $guest->first_name = $params['first_name'];
        $guest->last_name = $params['last_name'];
        $guest->email = $params['email'];
        $guest->phone_number = $params['phone_number'];
        $guest->gender = $params['gender'];
        $guest->address = $params['address'];
        
        return $guest->save();
    }

    /**
     * Get guest list
     *
     * @return void
     */
    public function getGuestList()
    {
        return Guest::all();
    }

    /**
     * Delete a guest
     *
     * @param integer $id
     *
     * @return void
     */
    public function deleteGuest(int $id)
    {
        return Guest::destroy($id);
    }

    /**
     * Get guest
     *
     * @param integer $id
     *
     * @return void
     */
    public function getGuest(int $id)
    {
        return Guest::find($id);
    }
}