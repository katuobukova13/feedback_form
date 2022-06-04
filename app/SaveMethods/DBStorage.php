<?php

namespace App\SaveMethods;

class DBStorage extends BaseStorage
{
    public function setStorage(): Storage
    {
        return new DBSafekeeping();
    }
}
