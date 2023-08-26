<?php

namespace Demo\Domain\Repository;

use Demo\Domain\Entity\Movie;

interface MovieRepository
{
    public function createIndex(): void;
    public function update(Movie $movie): void;
    public function delete(int $id): void;
    public function getByParams(array $params): array;
}
