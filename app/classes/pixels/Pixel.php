<?php

namespace App\Pixels;

class Pixel
{
    /**
     * @var array pixel array
     */
    private $data = [];

    /**
     * @var array properties array
     */
    private $properties = [
        'x',
        'y',
        'color',
        'email'
    ];

    public function __construct(array $data)
    {
        if ($data != null) {
            $this->setData($data);
        }
    }

    /**
     * Sets x if its int
     * @param int $x
     */
    public function setX(int $x): void
    {
        $this->data['x'] = $x;
    }

    /**
     * Returns set x
     * @return int
     */
    public function getX(): ?int
    {
        return $this->data['x'] ?? null;
    }

    /**
     * Sets y if its int
     * @param int $y
     */
    public function setY(int $y): void
    {
        $this->data['y'] = $y;
    }

    /**
     * Returns set y
     * @return int
     */
    public function getY(): ?int
    {
        return $this->data['y'] ?? null;
    }

    /**
     * Sets color if $color is hex
     * @param string $color
     */
    public function setColor(string $color): void
    {
        $this->data['color'] = $color;
    }

    /**
     * Returns set color
     * @return string
     */
    public function getColor(): ?string
    {
        return $this->data['color'] ?? null;
    }

    /**
     * Sets email if right format
     * @param string $email
     */
    public function setEmail(string $email): void
    {
        $this->data['email'] = $email;
    }

    /**
     * Returns set email
     * @return string
     */
    public function getEmail(): ?string
    {
        return $this->data['email'] ?? null;
    }

    /**
     * Sets all data from the given array
     * @param array $data
     */
    public function setData(array $data): void
    {
        foreach ($this->properties as $property_name) {
            $method = 'set' . $property_name;
            $method = str_replace('_', '', $method);
            $this->{$method}($data[$property_name]);
        }
    }

    /**
     * Returns array with given data
     * @return array
     */
    public function getData(): array
    {
        $data = [];

        foreach ($this->properties as $property_name) {
            $method = 'get' . $property_name;
            $method = str_replace('_', '', $method);
            $data[$property_name] = $this->{$method}();
        }

        return $data;
    }
}