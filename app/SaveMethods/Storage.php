<?php

namespace App\SaveMethods;

Interface Storage
{
    public function save(array $formData): bool;
}
