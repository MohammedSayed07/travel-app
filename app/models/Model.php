<?php

namespace app\models;

abstract class Model
{
    public static function factory(array $data): static
    {
        $obj = new static();
        $mapper = ($obj)->dataMapper();

        if (isset($data['images'])) {
            $data['images'] = explode(',', $data['images']);
        }

        foreach ($data as $key => $value) {
            if (array_key_exists($key, $mapper)) {
                $setterMethod = 'set'.$mapper[$key];
                $obj->{$setterMethod}($value);
            }
        }
        return $obj;
    }

    abstract protected function dataMapper(): array;
}