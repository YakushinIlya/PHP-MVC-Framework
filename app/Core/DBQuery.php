<?php
declare(strict_types=1);

namespace App\Core;

use PDO;
use PDOStatement;

final class DBQuery
{
    private PDOStatement $stmt;

    public function __construct(private PDO $pdo, private string $sql)
    {
        $this->stmt = $this->pdo->prepare($this->sql);
    }

    // Параметры через массив ['id' => 1]
    public function execute(array $params = []): self
    {
        $this->stmt->execute($params);
        return $this;
    }

    // Получить все записи как массив
    public function array(): array
    {
        return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Получить все записи как объекты
    public function object(): array
    {
        return $this->stmt->fetchAll(PDO::FETCH_OBJ);
    }

    // Получить одну запись как массив
    public function firstArray(): ?array
    {
        $row = $this->stmt->fetch(PDO::FETCH_ASSOC);
        return $row ?: null;
    }

    // Получить одну запись как объект
    public function firstObject(): ?object
    {
        $row = $this->stmt->fetch(PDO::FETCH_OBJ);
        return $row ?: null;
    }

    // Количество затронутых строк
    public function affected(): int
    {
        return $this->stmt->rowCount();
    }

    // Последний вставленный ID (для INSERT)
    public function lastId(): string
    {
        return $this->pdo->lastInsertId();
    }
}
