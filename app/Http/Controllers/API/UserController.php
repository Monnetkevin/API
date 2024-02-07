<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function currentUser()
    {
        return response()->json([
            'message' => 'Utilisateur trouvé avec succès',
            'user' => auth()->user()
        ]);
    }
}
