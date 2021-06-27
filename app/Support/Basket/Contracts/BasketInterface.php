<?php

namespace App\Support\Basket\Contracts;

interface BasketInterface
{
    public function get($index);
    public function set($index, $value);
    public function all();
    public function exists($index);
    public function unset($index);
    public function count();
    public function clear();
}
