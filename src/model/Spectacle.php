<?php

namespace App\Model;

class Spectacle {
    private string $file = __DIR__ . '/../../data/spectacles.json';

    public function all(): array {
        if (!file_exists($this->file)) return [];
        $json = file_get_contents($this->file);
        return json_decode($json, true) ?: [];
    }

    public function findById(int $id): ?array {
        foreach ($this->all() as $spectacle) {
            if ($spectacle['id'] === $id) return $spectacle;
        }
        return null;
    }

    public function create(array $data): array {
        $spectacles = $this->all();
        $data['id'] = $this->getNextId($spectacles);
        $spectacles[] = $data;
        file_put_contents($this->file, json_encode($spectacles, JSON_PRETTY_PRINT));
        return $data;
    }

    private function getNextId(array $spectacles): int {
        if (empty($spectacles)) return 1;
        $ids = array_column($spectacles, 'id');
        return max($ids) + 1;
    }

    public function update(int $id, array $data): ?array {
        $spectacles = $this->all();
        foreach ($spectacles as &$spectacle) {
            if ($spectacle['id'] === $id) {
                $spectacle = array_merge($spectacle, $data);
                file_put_contents($this->file, json_encode($spectacles, JSON_PRETTY_PRINT));
                return $spectacle;
            }
        }
        return null;
    }

    public function delete(int $id): bool {
        $spectacles = $this->all();
        $filtered = array_filter($spectacles, fn($s) => $s['id'] !== $id);
        if (count($filtered) === count($spectacles)) return false; // pas trouvé
        file_put_contents($this->file, json_encode(array_values($filtered), JSON_PRETTY_PRINT));
        return true;
    }
}
