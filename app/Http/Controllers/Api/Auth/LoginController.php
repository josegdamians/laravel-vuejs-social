<?php

namespace App\Http\Controllers\Api\Auth;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class loginController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $request->request->add([
            'grant_type' => 'password',
            'client_id' => '93d11c48-7db1-4e94-99a4-2b22700a9c0a',
            'client_secret' => 'jG9cdnQOa46rHXd3vZW2gW9AFs7oIYaY6QWeLrKt',
            'username' => $request->username,
            'password' => $request->password,
        ]);

        $requestToken = Request::create(env('APP_URL') . 'oauth/token','post');
        $response = Route::dispatch($requestToken);
        return $response;
    }

    public function destroy(Request $request)
    {
        $request->user()->token()->revoke();

        return response()->noContent();
    }
}
