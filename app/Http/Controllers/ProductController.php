<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;

class ProductController extends Controller
{
    public function totals(Request $request)
    {
        // validate product ids that they are exist in the database
        $request->validate([
            'products.*.product_id' => 'bail|required|exists:products,id'
        ]);

        // make a collection with the inputed products
        $items = collect($request->input("products",[]))->where('qty','>','0');
        // get all the products from the product_ids of the inputed data
        $products = Product::whereIn('id',$items->pluck('product_id'))->get();
    	$total = 0;

        // 
    	$items->transform(function ($item, $key) use($products)
        {
            $productModel = $products->where('id',$item['product_id'])->first();
            if($productModel )
            {
                $item['price'] = $productModel->price;
                $item['category'] = $productModel->category;
            }
            return $item;
        });

        // search for meal deals and lower the quantity of the items when adding a meal deal
        while ( $items->where('category','sandwich')->sum('qty') >= 1 
            && $items->where('category','drink')->sum('qty') >= 1 
            && $items->where('category','snack')->sum('qty') >= 1) 
        {
            $total += 3;
            
            $sandwich = $items->where('category','sandwich')->sortByDesc('price')->first();
            $drink = $items->where('category','drink')->sortByDesc('price')->first();
            $snack = $items->where('category','snack')->sortByDesc('price')->first();

            $items->transform(function ($item, $key) use($sandwich, $drink, $snack)
            {
                if($sandwich['product_id'] == $item['product_id'] || $drink['product_id'] == $item['product_id'] || $snack['product_id'] == $item['product_id'] )
                {
                    $item['qty'] = $item['qty'] - 1;
                }
                return $item;
            });
        }

        // remove the items with 0 quantity
        $items = $items->where('qty','>','0');

        // sum the price of the items that left
        foreach ($items as $item) 
        {
            $total += $item['price'] * $item['qty'];
        }

    	return response()->json(['total' => $total],200);
    }
}
