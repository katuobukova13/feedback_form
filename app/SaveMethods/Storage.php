<?php

namespace App\SaveMethods;

interface Storage
{
    public function save(array $formData): bool;
}
