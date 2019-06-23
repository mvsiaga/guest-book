<?php
namespace App\Helpers;

class CommonHelper
{
    public function genderList($value=null)
    {
        $genders = [
            [
                'value' => 1,
                'name' => 'Male'
            ],
            [
                'value' => 2,
                'name' => 'Female'
            ]
        ];

        if($value) {
            foreach($genders as $gender) {
                if($gender['value'] === $value) {
                    return $gender['name'];
                }
            }
        }

        return $genders;
    }
}