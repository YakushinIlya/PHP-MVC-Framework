<?php
declare(strict_types=1);

namespace App\Http;

use App\Core\Request;
use App\Core\Response;

final class AboutController extends Controller
{
    public function index(Request $request): Response
    {
        return $this->view('about', ['title' => 'About Page']);
    }
}
