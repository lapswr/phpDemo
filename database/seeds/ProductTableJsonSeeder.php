<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use App\Product;

class ProductTableJsonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	if( File::exists(base_path("database/seeds/json/products.json")) )
    	{
    		$productsArray = json_decode(File::get(base_path("database/seeds/json/products.json")));
    		foreach ($productsArray->products as $key => $product)
            {
    			$productModel = new Product();
    			$productModel->name = $product->name;
    			$productModel->price = $product->price;
    			$productModel->category = $product->category;
    			$productModel->save();
    		}
    	}
    }
}
