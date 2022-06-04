<?php

namespace App\SaveMethods;

abstract class BaseStorage
{
    public function save(array $formData): bool
    {
        $storage = $this->setStorage();
        return $storage->save($formData);
    }

    abstract protected function setStorage(): Storage;
}

