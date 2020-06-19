<?php

namespace Core;

class DataHolder
{
    public function __construct(array $data)
    {
        if ($data != null) {
            $this->_setData($data);
        }
    }

    /**
     * Calls out when object property is set to some value.
     * @param $property_key
     * @param $value
     * @return null
     */
    public function __set($property_key, $value)
    {
        if ($method = $this->_getSetterMethod($property_key)) {
            $this->{$method}($value);
        }

        return null;
    }

    /**
     * Calls out when object property is given only
     * @param $property_key
     * @return |null
     */
    public function __get($property_key)
    {
        if ($method = $this->_getGetterMethod($property_key)) {
            return $this->{$method}();
        }
    }

    /**
     * Sets all data from the given array
     * @param array $data
     */
    public function _setData(array $data): void
    {
        foreach ($data as $property_key => $value) {
            $this->__set($property_key, $value);
        }
    }

    /**
     * Returns array with given data
     * @return array
     */
    public function _getData(): array
    {
        $data = [];

        foreach ($this->_getPropertyKeys() as $property_name) {
            $data[$property_name] = $this->__get($property_name);
        }

        return $data;
    }

    /**
     * Checks if getter method exists
     * @param $property_key
     * @return string|null
     */
    private function _getGetterMethod($property_key): ?string
    {
        $method = $this->_keyToMethod('get', $property_key);

        if (method_exists($this, $method)) {
            return $method;
        }

        return false;
    }

    /**
     * Checks if setter method exists
     * @param $property_key
     * @return string|null
     */
    private function _getSetterMethod($property_key): ?string
    {
        $method = $this->_keyToMethod('set', $property_key);

        if (method_exists($this, $method)) {
            return $method;
        }

        return false;
    }

    /**
     * Generates method name from property name
     * @param $prefix
     * @param $property_key
     * @return string
     */
    private function _keyToMethod($prefix, $property_key)
    {
        return $prefix . str_replace('_', '', $property_key);
    }

    /**
     * Generates key name from method name
     * @param string $prefix
     * @param string $method
     * @return string
     */
    private function _methodToKey(string $prefix, string $method): string
    {
        $s_case = strtolower(preg_replace('/\B([A-Z])/', '_$0', $method));

        return str_replace($prefix . '_', '', $s_case);
    }

    /**
     * Finds and returns all properties
     * @return array
     */
    private function _getPropertyKeys(): array
    {
        $properties = [];
        $methods = preg_grep('/^get/', get_class_methods($this));

        foreach ($methods as $method) {
            $properties[] = $this->_methodToKey('get', $method);
        }

        return $properties;
    }
}