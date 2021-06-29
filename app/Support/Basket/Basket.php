<?php


namespace App\Support\Basket;

use App\Exceptions\QuantityExceededException;
use App\Models\Product;
use App\Support\Storage\Contracts\StorageInterface;
use phpDocumentor\Reflection\DocBlock\Tags\See;

class Basket
{
    private $storage;

    public function __construct(StorageInterface $storage)
    {
        $this->storage = $storage;
    }


    public function add(Product $product, int $quantity)
    {
        if($this->has($product)){
            $quantity = $this->get($product)['quantity'] + $quantity;
        }

        $this->update($product,$quantity);

    }

    public function countItems()
    {
        return $this->storage->count();
    }

    public function update(Product $product,int $quantity)
    {
        if(!$product->hasStock($quantity)){
            throw new QuantityExceededException();
        }

        $this->storage->set($product->id,[
            'quantity' => $quantity,
        ]);
    }

    public function all()
    {
        $products = Product::find(array_keys($this->storage->all()));
        foreach($products as $product){
            $product->quantity = $this->get($product)['quantity'];
        }
        return $products;
    }

    public function subTotal()
    {
        $total = 0;
        foreach($this->all() as $item){
            $total += $item->price * $item->quantity;
        }

        return $total;
    }

    public function get(Product $product)
    {
        return $this->storage->get($product->id);
    }

    public function has(Product $product)
    {
        return $this->storage->exists($product->id);
    }
}
