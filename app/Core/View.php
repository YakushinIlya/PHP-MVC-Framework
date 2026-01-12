<?php
declare(strict_types=1);

namespace App\Core;

final class View
{
    public function __construct(
        private string $template,
        private array $params = []
    ) {}

    public function render(): Response
    {
        extract($this->params, EXTR_SKIP);

        ob_start();
        require dirname(__DIR__, 2) . "/views/{$this->template}.php";
        $content = ob_get_clean();

        return new Response($content);
    }
}
