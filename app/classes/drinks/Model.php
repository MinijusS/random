<?php

namespace App\Drinks;

use App\App;

class Model
{
    const TABLE = 'drinks';

    public static function insert(Drink $drink)
    {
        App::$db->insertRow(self::TABLE, $drink->_getData());
    }

    public static function getWhere(array $conditions = [])
    {
        $rows = App::$db->getRowsWhere(self::TABLE, $conditions);
        $drinks = [];

        foreach ($rows as $row) {
            $drinks[] = new Drink($row);
        }

        return $drinks;
    }

    public static function get(int $id): ?Drink
    {
        if ($row = App::$db->getRowById(self::TABLE, $id)) {
            return new Drink($row);
        } else {
            return null;
        }
    }

    public static function update(Drink $drink)
    {
        App::$db->updateRow(self::TABLE, $drink->getId(), $drink->_getData());
    }

    public static function delete(Drink $drink)
    {
        App::$db->deleteRow(self::TABLE, $drink->getId());
    }

    public static function deleteById(int $id)
    {
        App::$db->deleteRow(self::TABLE, $id);
    }

}