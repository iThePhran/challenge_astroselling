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
     * Devuelve usuarios paginados en formato de JSON a demanda.
     */
    public function index(Request $request)
    {
        $users = $this->getPaginatedUsers($request);
        return response()->json($users);
    }

    /**
     * retorna usuarios paginados en formato de JSON.
     */
    private function getPaginatedUsers(Request $request)
    {
        $perPage = $request->get('per_page', 10);
        $page = $request->get('page', 1);
        

        return User::paginate($perPage, ['*'], 'page', $page);
    }

    /**
     * Devuelve la vista de usuarios paginados.
     */
    public function userList(Request $request)
    {
        $users = $this->getPaginatedUsers($request);

        $users->getCollection()->transform(function ($user) {
            $cacheKey = "user_result_{$user->id}";
            $data = Cache::get($cacheKey);

            $user->alert_count = $data['alerts_count'] ?? 0;
            $user->nivel_alerta = $data['alert_level'] ?? 'sin datos';
            return $user;
        });

        return view('users.index', compact('users'));
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
