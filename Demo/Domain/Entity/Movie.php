<?php

namespace Demo\Domain\Entity;

use DateTime;

class Movie
{
    private ?int $id;
    private DateTime $createdAt;
    private DateTime $updatedAt;

    public function __construct(private string $title, private string $genre)
    {
        $this->id = null;
        $this->title = $title;
        $this->genre = $genre;
    }

    public function changeCreatedAt(DateTime $createdAt)
    {
        $this->createdAt = $createdAt;
    }

    public function changeUpdatedAt(DateTime $updatedAt)
    {
        $this->updatedAt = $updatedAt;
    }

    public function title(): string
    {
        return $this->title;
    }

    public function genre(): string
    {
        return $this->genre;
    }


}
