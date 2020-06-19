<?php

namespace App\Pixels;

use Core\DataHolder;

class Pixel extends DataHolder
{
    /**
     * Sets x if its int
     * @param int $x
     */
    public function setX(int $x): void
    {
        $this->x = $x;
    }

    /**
     * Returns set x
     * @return int
     */
    public function getX(): ?int
    {
        return $this->x ?? null;
    }

    /**
     * Sets y if its int
     * @param int $y
     */
    public function setY(int $y): void
    {
        $this->y = $y;
    }

    /**
     * Returns set y
     * @return int
     */
    public function getY(): ?int
    {
        return $this->y ?? null;
    }

    /**
     * Sets color if $color is hex
     * @param string $color
     */
    public function setColor(string $color): void
    {
        $this->color = $color;
    }

    /**
     * Returns set color
     * @return string
     */
    public function getColor(): ?string
    {
        return $this->color ?? null;
    }

    /**
     * Sets email if right format
     * @param string $email
     */
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    /**
     * Returns set email
     * @return string
     */
    public function getEmail(): ?string
    {
        return $this->email ?? null;
    }
}
