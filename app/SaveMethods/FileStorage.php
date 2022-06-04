<?php

namespace App\SaveMethods;

class FileStorage extends BaseStorage
{
    public function setStorage(): Storage
    {
        return new FileSafekeeping();
    }
}
