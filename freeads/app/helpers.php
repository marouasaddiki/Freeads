<?php
 
use Illuminate\Database\Migrations\Migration;

function getBuyerName($buyer_id)
{
    $user = App\Models\User::find($buyer_id);
    return $user->name;
}