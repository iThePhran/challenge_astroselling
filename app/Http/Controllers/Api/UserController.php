<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Jobs\ProcessUserJob;
use Illuminate\Support\Facades\Cache;

class UserController extends Controller
{
     /**
     * Devuelve usuarios paginados en formato de JSON.
     */
    public function index(Request $request)
    {
        $perPage = $request->get('per_page', 10);
        $users = User::paginate($perPage);

        return response()->json($users);
    }



    /**
     * Procesar usuarios por pagina (solo Admin)
     */
    public function process(Request $request)
    {
        //$this->authorize('admin'); // aca habria que aplicar un middleware de permisos. utilizamos can en la route.
    
        $page = $request->get('page', 1);
        $perPage = $request->get('per_page', 10);
    
        $users = User::paginate($perPage, ['*'], 'page', $page);
    
        foreach ($users as $user) {
            ProcessUserJob::dispatch($user);
        }
    
        return response()->json([
            'message' => "Procesando usuarios de la página {$page}",
            'count'   => $users->count(),
        ]);
    }


    /**
     * Consultar resultado en cache si no existe devolvemos el error 404.
     */
    public function result($id)
    {
        $data = Cache::get("user_result_{$id}");

        if (!$data) {
            return response()->json(['message' => 'Resultado no encontrado'], 404);
        }

        return response()->json($data);
    }
}
