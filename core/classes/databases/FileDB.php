<?php

namespace Core\Databases;

/**
 * Class FileDB for file inputing and outputing
 */
class FileDB
{
    /**
     * @var FileDB property that stores file name
     */
    private $file_name;

    /**
     * @var FileDb property for data that will be stored
     */
    private $data;


    /**
     * Method, that will set $file_name property on new object creation
     * FileDB constructor.
     * @param $file_name
     */
    public function __construct(string $file_name)
    {
        $this->file_name = $file_name;
    }

    /**
     * Method, that will set $data property
     * @param $data_array
     */
    private function setData(array $data_array): void
    {
        $this->data = $data_array;
    }

    /**
     * Method, that encodes $data ant puts it in $file_name file
     * @return bool
     */
    public function save(): bool
    {
        $array = json_encode($this->data);

        $bytes_written = file_put_contents($this->file_name, $array);

        if ($bytes_written !== false) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Method, that loads and decodes all data from $file_name file and stores everything in $data property
     */
    public function load(): void
    {
        if (file_exists($this->file_name)) {
            $data = file_get_contents($this->file_name);
            if ($data !== false) {
                $this->data = json_decode($data, true);
            } else {
                $this->data = [];
            }
        } else {
            $this->data = [];
        }
    }

    /**
     * Method, that returns all data
     * @return array
     */
    private function getData(): ?array
    {
        return $this->data;
    }

    /**
     * Method, that creates table
     * @param string $table_name
     * @return bool
     */
    public function createTable(string $table_name): bool
    {
        if (!$this->tableExists($table_name)) {
            $this->data[$table_name] = [];
            return true;
        } else {
            return false;
        }
    }

    /**
     * Method, that checks if there is table named $table_name
     * @param $table_name
     * @return bool
     */
    public function tableExists(string $table_name): bool
    {
        if (isset($this->data[$table_name])) {
            return true;
        }

        return false;
    }

    /**
     * Method, that drops table without leaving index
     * @param $table_name
     * @return bool
     */
    public function dropTable($table_name): bool
    {
        if ($this->tableExists($table_name)) {
            unset($this->data[$table_name]);
            return true;
        }

        return false;
    }

    /**
     * Method, that makes table empty, but leaves index
     * @param $table_name
     * @return bool
     */
    public function truncateTable($table_name): bool
    {
        if ($this->tableExists($table_name)) {
            $this->data[$table_name] = [];
            return true;
        }

        return false;
    }

    /**
     * Inserts a row (another array) into the specified table
     * @param $table_name
     * @param $row
     * @param $row_id
     * @return mixed
     */
    public function insertRow(string $table_name, array $row, $row_id = null)
    {
        if ($row_id == null) {
            $this->data[$table_name][] = $row;
            return array_key_last($this->data[$table_name]);
        } elseif (!$this->rowExists($row_id, $table_name)) {
            $this->data[$table_name][$row_id] = $row;
            return $row_id;
        }

        return false;
    }

    /**
     * Checks if there is row in this table with the same row_id
     * @param string $table_name
     * @param $row_id
     * @return bool
     */
    public function rowExists(string $table_name, $row_id): bool
    {

        if (isset($this->data[$table_name][$row_id])) {
            return true;
        }

        return false;
    }

    /**
     * Updates row value, if there is row with this row_id
     * @param string $table_name
     * @param $row_id
     * @param array $row
     * @return bool
     */
    public function updateRow(string $table_name, $row_id, array $row): bool
    {
        if ($this->rowExists($table_name, $row_id)) {
            $this->data[$table_name][$row_id] = $row;

            return true;
        }

        return false;
    }

    /**
     * Deletes row, if there is row with this row_id
     * @param string $table_name
     * @param $row_id
     * @return bool
     */
    public function deleteRow(string $table_name, $row_id): bool
    {
        if ($this->rowExists($table_name, $row_id)) {
            unset($this->data[$table_name][$row_id]);

            return true;
        }

        return false;
    }

    /**
     * Returns row by row_id
     * @param string $table_name
     * @param $row_id
     * @return bool
     */
    public function getRowById(string $table_name, $row_id)
    {
        if ($this->rowExists($table_name, $row_id)) {
            return ['id' => $row_id] + $this->data[$table_name][$row_id];
        }

        return false;
    }

    /**
     * Get rows from DB FILE that matches the specified conditions
     * @param string $table_name
     * @param array $conditions
     * @return array
     */
    public function getRowsWhere(string $table_name, array $conditions = []): array
    {
        $result = [];
        foreach ($this->data[$table_name] as $row_id => $row) {
            $match = true;
            foreach ($conditions as $search_key => $search_value) {
                if (!isset($row[$search_key]) || $row[$search_key] != $search_value) {
                    $match = false;
                    break;
                }
            }
            if ($match) {
                $row['id'] = $row_id;
                $result[$row_id] = $row;
            }
        }
        return $result;
    }

    /**
     * Returns one row
     * @param string $table_name
     * @param array $conditions
     * @return array
     */
    public function getRowWhere(string $table_name, array $conditions = [])
    {
        $rows = $this->getRowsWhere($table_name, $conditions);

        return reset($rows);
    }

}