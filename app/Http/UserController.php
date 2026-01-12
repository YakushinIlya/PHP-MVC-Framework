<?php
declare(strict_types=1);

namespace App\Http;

use App\Core\DB;
use App\Core\Response;
use App\Core\Request;

final class UserController extends Controller
{
    public function show(Request $request, string $id): Response
    {
        $users = DB::query("select * from users")->execute()->firstArray();
        return $this->view('user', [
            'id'    => $users['id'],
            'name'  => $users['name'],
            'email' => $users['email'],
        ]);
    }
}
