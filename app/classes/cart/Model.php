<?php

namespace App\Cart;

use App\App;

class Model
{
    const TABLE = 'items';

    public static function insert(Item $item)
    {
        App::$db->insertRow(self::TABLE, $item->_getData());
    }

    public static function getWhere(array $conditions = [])
    {
        $rows = App::$db->getRowsWhere(self::TABLE, $conditions);
        $items = [];

        foreach ($rows as $row) {
            $items[] = new Item($row);
        }

        return $items;
    }

    public static function get(int $id): ?Item
    {
        if ($row = App::$db->getRowById(self::TABLE, $id)) {
            return new Item($row);
        } else {
            return null;
        }
    }

    public static function update(Item $item)
    {
        App::$db->updateRow(self::TABLE, $item->getId(), $item->_getData());
    }

    public static function delete(Item $item)
    {
        App::$db->deleteRow(self::TABLE, $item->getId());
    }

    public static function deleteById(int $id)
    {
        App::$db->deleteRow(self::TABLE, $id);
    }

}