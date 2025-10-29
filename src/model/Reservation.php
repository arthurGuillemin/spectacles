<?php

namespace App\Model;

class Reservation {
    private string $file = __DIR__ . '/../../data/reservations.json';

    public function all(): array {
        if (!file_exists($this->file)) return [];
        $json = file_get_contents($this->file);
        return json_decode($json, true) ?: [];
    }

    public function findByUserId(int $userId): array {
        return array_filter($this->all(), fn($r) => $r['user_id'] === $userId);
    }

    public function create(array $data): array {
        $reservations = $this->all();
        $data['id'] = $this->getNextId($reservations);
        $reservations[] = $data;
        file_put_contents($this->file, json_encode($reservations, JSON_PRETTY_PRINT));
        return $data;
    }

    private function getNextId(array $reservations): int {
        if (empty($reservations)) return 1;
        $ids = array_column($reservations, 'id');
        return max($ids) + 1;
    }

    public function delete(int $id): bool {
        $reservations = $this->all();
        $filtered = array_filter($reservations, fn($r) => $r['id'] !== $id);
        if (count($filtered) === count($reservations)) return false;
        file_put_contents($this->file, json_encode(array_values($filtered), JSON_PRETTY_PRINT));
        return true;
    }
}
