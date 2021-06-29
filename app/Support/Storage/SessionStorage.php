<?php

namespace App\Support\Storage;
use App\Support\Storage\Contracts\StorageInterface;

class SessionStorage implements StorageInterface
{
    private $storageName;

    public function __construct($storageName = 'default')
    {
        $this->storageName = $storageName;
    }

    public function get($index)
    {
        return session()->get($this->storageName . '.' . $index);
    }

    public function set($index, $value)
    {
        return session()->put($this->storageName . '.' . $index, $value);
    }

    public function all()
    {
        return session()->get($this->storageName) ?? [];
    }

    public function exists($index)
    {
        return session()->has($this->storageName . '.' . $index);
    }

    public function unset($index)
    {
        return session()->forget($this->storageName . '.' . $index);
    }

    public function count()
    {
        return count($this->all());
    }

    public function clear()
    {
        return session()->forget($this->storageName);
    }
}
