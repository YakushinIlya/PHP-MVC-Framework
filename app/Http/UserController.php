<?php
declare(strict_types=1);

namespace App\Http;

use App\Core\DB;
use App\Core\Response;
use App\Core\Request;

final class UserController extends Controller
{
    public function show(Request $request, int $id, string $status): Response
    {
        $users = DB::query("select * from users where id = :id and status = :status")
            ->execute(['id'=>$id, 'status'=>$status])
            ->firstArray();

        return $users ? $this->view('user', [
            'id'     => $users['id'],
            'name'   => $users['name'],
            'email'  => $users['email'],
            'status' => $users['status'],
        ]) : $this->view('message', ['message'=>'No user data.']);
    }
}
