<?php

namespace App\Model;

class User {
    private string $file = __DIR__ . '/../../data/users.json';

    public function all(): array {
        if (!file_exists($this->file)) return [];
        $json = file_get_contents($this->file);
        return json_decode($json, true);
    }

    public function findByEmail(string $email): ?array {
        foreach ($this->all() as $user) {
            if ($user['email'] === $email) return $user;
        }
        return null;
    }

    public function findById(int $id): ?array {
        foreach ($this->all() as $user) {
            if ($user['id'] === $id) return $user;
        }
        return null;
    }

    public function create(array $data): array {
        $users = $this->all();
        $data['id'] = count($users) + 1;
        $users[] = $data;
        file_put_contents($this->file, json_encode($users, JSON_PRETTY_PRINT));
        return $data;
    }
}
