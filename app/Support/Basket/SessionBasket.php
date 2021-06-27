<?php

namespace App\Support\Basket;

use App\Support\Basket\Contracts\BasketInterface;
use Countable;

class SessionBasket implements BasketInterface
{
    private $basketName;

    public function __construct($basketName = 'default')
    {
        $this->basketName = $basketName;
    }

    public function get($index)
    {
        return session()->get($this->basketName . '.' . $index);
    }

    public function set($index, $value)
    {
        return session()->put($this->basketName . '.' . $index, $value);
    }

    public function all()
    {
        return session()->get($this->basketName);
    }

    public function exists($index)
    {
        return session()->has($this->basketName . '.' . $index);
    }

    public function unset($index)
    {
        return session()->forget($this->basketName . '.' . $index);
    }

    public function count()
    {
        session()->count($this->all());
    }

    public function clear()
    {
        return session()->forget($this->basketName);
    }
}
