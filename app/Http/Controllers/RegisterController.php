<?php

namespace App\Http\Controllers;

use App\Events\UserHasRegisteredEvent;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{


    public function create (array $data)
    {
        // la fonction create me renvoi une instance d'utilisateur
        $user = User::create([
            "name" => $data["name"],
            "email" => $data["email"],
            "password" => Hash::make($data["password"])
        ]);

        // Event (appel event et lui passer la classe event créé)
        // Je crée un nouvel évenement, et je lui passe mon nouvel event
        // et à la construction de la classe event, je lui passe le mode User.
        event(new UserHasRegisteredEvent($user));

        return $user;
    }

}
