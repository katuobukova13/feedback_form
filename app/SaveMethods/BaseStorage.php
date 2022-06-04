<?php

namespace App\SaveMethods;

abstract class BaseStorage
{
    abstract protected function setStorage(): Storage;

    public function save(array $formData): bool
    {
        $storage = $this->setStorage();
        return $storage->save($formData);
    }
}

