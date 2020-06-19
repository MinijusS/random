<?php

namespace App\Drinks;

use Core\DataHolder;

class Drink extends DataHolder
{

    /**
     * Sets y if its int
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * Returns set y
     * @return int
     */
    public function getId(): ?int
    {
        return $this->id ?? null;
    }

    /**
     * Sets x if its int
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * Returns set x
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name ?? null;
    }

    /**
     * Sets y if its int
     * @param int $degrees
     */
    public function setDegrees(int $degrees): void
    {
        $this->degrees = $degrees;
    }

    /**
     * Returns set y
     * @return int
     */
    public function getDegrees(): ?int
    {
        return $this->degrees ?? null;
    }

    /**
     * Sets y if its int
     * @param int $capacity
     */
    public function setCapacity(int $capacity): void
    {
        $this->capacity = $capacity;
    }

    /**
     * Returns set y
     * @return int
     */
    public function getCapacity(): ?int
    {
        return $this->capacity ?? null;
    }

    /**
     * Sets y if its int
     * @param int $storage
     */
    public function setStorage(int $storage): void
    {
        $this->storage = $storage;
    }

    /**
     * Returns set y
     * @return int
     */
    public function getStorage(): ?int
    {
        return $this->storage ?? null;
    }

    /**
     * Sets y if its int
     * @param int $price
     */
    public function setPrice(int $price): void
    {
        $this->price = $price;
    }

    /**
     * Returns set y
     * @return int
     */
    public function getPrice(): ?int
    {
        return $this->price ?? null;
    }

    /**
     * Sets y if its int
     * @param string $photo
     */
    public function setPhoto(string $photo): void
    {
        $this->photo = $photo;
    }

    /**
     * Returns set y
     * @return int
     */
    public function getPhoto(): ?string
    {
        return $this->photo ?? null;
    }
}
