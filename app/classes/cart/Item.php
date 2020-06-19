<?php

namespace App\Cart;

use App\Users\User;
use App\Drinks\Drink;
use Core\DataHolder;

class Item extends DataHolder
{
    const STATUS_IN_CART = 0;
    const STATUS_ORDERED = 1;

    /**
     * @param int $id
     */
    public function setId(int $id)
    {
        $this->id = $id;
    }

    /**
     * @return |null
     */
    public function getId()
    {
        return $this->id ?? null;
    }

    /**
     * @param int $drink_id
     */
    public function setDrinkId(int $drink_id)
    {
        $this->drink_id = $drink_id;
    }

    /**
     * @return |null
     */
    public function getDrinkId()
    {
        return $this->drink_id ?? null;
    }

    /**
     * @param int $user_id
     */
    public function setUserId(int $user_id)
    {
        $this->user_id = $user_id;
    }

    /**
     * @return |null
     */
    public function getUserId()
    {
        return $this->user_id ?? null;
    }

    /**
     * @param $order_id
     */
    public function setOrderId($order_id)
    {
        $this->order_id = $order_id;
    }

    /**
     * @return |null
     */
    public function getOrderId()
    {
        return $this->order_id ?? null;
    }


    public function getStatus()
    {
        return $this->status ?? null;
    }

    public function setStatus($status): void
    {
        $this->status = $status;
    }

    public function user(): User
    {
        return \App\Users\Model::get($this->getUserId());
    }

    public function drink(): Drink
    {
        return \App\Drinks\Model::get($this->getDrinkId());
    }

    public function order(): Order
    {
        return \App\Cart\Orders\Model::get($this->getOrderId());
    }
}