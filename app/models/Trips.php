<?php

namespace app\models;

class Trips
{
    private int $id;
    private string $title;
    private string $details;
    private string $location;
    private array $images;

    /**
     * @param int $id
     * @param string $title
     * @param string $details
     * @param string $location
     * @param array $images
     */
    public function __construct(int $id, string $title, string $details, string $location, array $images)
    {
        $this->id = $id;
        $this->title = $title;
        $this->details = $details;
        $this->location = $location;
        $this->images = $images;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getDetails(): string
    {
        return $this->details;
    }

    public function getLocation(): string
    {
        return $this->location;
    }

    public function getImages(): array
    {
        return $this->images;
    }






}