<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Collaborators;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class CollaboratorAuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $collaborator = Collaborators::where('email', $request->email)->first();

        if (! $collaborator || ! Hash::check($request->password, $collaborator->password)) {
            return response()->json([
                'message' => 'As credenciais fornecidas estão incorretas.',
            ], 401);
        }

        return response()->json([
            'message' => 'Login realizado com sucesso',
            'collaborator' => $collaborator,
        ]);
    }
    public function birthdays()
    {
        $today = date('m-d');

        $collaboratorsWithBirthdayList = Collaborators::whereNotNull('birth_date')->get(['name', 'birth_date','url_photo']);

        return response()->json([
            'birthdays' => $collaboratorsWithBirthdayList->values(),
        ]);
    }
}
