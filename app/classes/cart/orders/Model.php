<?php

namespace App\Cart\Orders;

use App\App;

class Model
{
    const TABLE = 'orders';

    public static function insert(order $order)
    {
        return App::$db->insertRow(self::TABLE, $order->_getData());
    }

    public static function getWhere(array $conditions = [])
    {
        $rows = App::$db->getRowsWhere(self::TABLE, $conditions);
        $orders = [];

        foreach ($rows as $row) {
            $orders[] = new order($row);
        }

        return $orders;
    }

    public static function get(int $id): ?Order
    {
        if ($row = App::$db->getRowById(self::TABLE, $id)) {
            return new Order($row);
        } else {
            return null;
        }
    }

    public static function update(Order $order)
    {
        App::$db->updateRow(self::TABLE, $order->getId(), $order->_getData());
    }

    public static function delete(Order $order)
    {
        App::$db->deleteRow(self::TABLE, $order->getId());
    }

    public static function deleteById(int $id)
    {
        App::$db->deleteRow(self::TABLE, $id);
    }

}