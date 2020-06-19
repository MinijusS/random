<?php

namespace App\Cart\Orders;

use App\Users\User;
use Core\DataHolder;

class Order extends DataHolder
{

    const STATUS_SUBMITTED = 0;
    const STATUS_SHIPPED = 1;
    const STATUS_DELIVERED = 2;
    const STATUS_CANCELED = 3;

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
    public function setUserId(int $user_id)
    {
        $this->userId = $user_id;
    }

    /**
     * @return |null
     */
    public function getUserId()
    {
        return $this->userId ?? null;
    }

    /**
     * @param int $user_id
     */
    public function setDate(int $date)
    {
        $this->date = $date;
    }

    /**
     * @return |null
     */
    public function getDate()
    {
        return $this->date ?? null;
    }

    /**
     * @param int $user_id
     */
    public function setPrice(int $price)
    {
        $this->price = $price;
    }

    /**
     * @return |null
     */
    public function getPrice()
    {
        return $this->price ?? null;
    }

    public function getStatus()
    {
       return $this->status ?? null;
    }

    public function _getStatusName(int $status = null)
    {
        $status = $status ?? $this->getStatus();
        switch ($status) {
            case self::STATUS_SUBMITTED:
                $status = 'Submitted';
                break;
            case self::STATUS_SHIPPED:
                $status = 'Shipped';
                break;
            case self::STATUS_DELIVERED:
                $status = 'Delivered';
                break;
            case self::STATUS_CANCELED:
                $status = 'Canceled';
                break;
        }
        return $status;
    }

    public function setStatus($status)
    {
        $this->status = $status ?? null;
    }

    public function user(): User
    {
        return \App\Users\Model::get($this->getUserId());
    }
}