<?php

namespace App\Http\Controllers;

use App\Exceptions\QuantityExceededException;
use App\Models\Product;
use App\Support\Basket\Basket;
use Illuminate\Http\Request;

class BasketController extends Controller
{
    private $basket;

    public function __construct(Basket $basket)
    {
        $this->basket = $basket;
    }

    public function add(Product $product)
    {
        try{
            $this->basket->add($product, 1);

            return back()->with('success', __('payment.add to basket'));

        }catch(QuantityExceededException $e){

            return back()->with('error', __('payment.quantity exceeded'));
            
        }


    }

    public function has(Product $product)
    {
        return $this->basket->has($product);
    }
}
