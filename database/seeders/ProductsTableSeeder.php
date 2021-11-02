<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=1; $i<30; $i++){
        Product::create([
            'name'=>'Laptop'.$i,
            'slug'=>'Laptop-'.$i,
            'details'=>[13,15,17][array_rand([13,15,17])].' inch, '. [1,2,3][array_rand([1,2,3])].' TB SSD, 32GB RAM',
            'price'=>random_int(149999, 249999),
            'description'=>'Lorem ipsum '. $i .' dolor sit amet, consectetur adipisicing elit. Deserunt, illum?',
            'image' => 'assets/products_photos/laptop-1.jpg'
            ])->categories()->attach(1);
        }
        //Tabletss
        for ($i=1; $i<9; $i++){
            Product::create([
                'name'=>'Tablets'.$i,
                'slug'=>'Tablets-'.$i,
                'details'=>[13,15,17][array_rand([13,15,17])].' inch, '. [1,2,3][array_rand([1,2,3])].' TB SSD, 32GB RAM',
                'price'=>random_int(149999, 249999),
                'description'=>'Lorem ipsum '. $i .' dolor sit amet, consectetur adipisicing elit. Deserunt, illum?',
                'image' => 'assets/products_photos/tablet.png'
            ])->categories()->attach(2);
        }

        //Phones
        for ($i=1; $i<9; $i++){
            Product::create([
                'name'=>'Phone'.$i,
                'slug'=>'phone-'.$i,
                'details'=>[13,15,17][array_rand([13,15,17])].' inch, '. [1,2,3][array_rand([1,2,3])].' TB SSD, 32GB RAM',
                'price'=>random_int(109999, 209999),
                'description'=>'Lorem ipsum '. $i .' dolor sit amet, consectetur adipisicing elit. Deserunt, illum?',
                'image' => 'assets/products_photos/phone-1.png'
            ])->categories()->attach(3);
        }

        //Tvs
        for ($i=1; $i<9; $i++){
            Product::create([
                'name'=>'Tv'.$i,
                'slug'=>'tv-'.$i,
                'details'=>[13,15,17][array_rand([13,15,17])].' inch, '. [1,2,3][array_rand([1,2,3])].' TB SSD, 32GB RAM',
                'price'=>random_int(149999, 249999),
                'description'=>'Lorem ipsum '. $i .' dolor sit amet, consectetur adipisicing elit. Deserunt, illum?',
                'image' => 'assets/products_photos/tv.png'
            ])->categories()->attach(5);
        }

        //Digital Cameras
        for ($i=1; $i<9; $i++){
            Product::create([
                'name'=>'Digital camera'.$i,
                'slug'=>'digital camera-'.$i,
                'details'=>[13,15,17][array_rand([13,15,17])].' inch, '. [1,2,3][array_rand([1,2,3])].' TB SSD, 32GB RAM',
                'price'=>random_int(149999, 249999),
                'description'=>'Lorem ipsum '. $i .' dolor sit amet, consectetur adipisicing elit. Deserunt, illum?',
                'image' => 'assets/products_photos/camera.png'
            ])->categories()->attach(6);
        }
        $product = Product::find(1);
        $product->categories()->attach(2);
        //Appliances
        for ($i=1; $i<9; $i++){
            Product::create([
                'name'=>'appliance'.$i,
                'slug'=>'appliance-'.$i,
                'details'=>[13,15,17][array_rand([13,15,17])].' inch, '. [1,2,3][array_rand([1,2,3])].' TB SSD, 32GB RAM',
                'price'=>random_int(149999, 249999),
                'description'=>'Lorem ipsum '. $i .' dolor sit amet, consectetur adipisicing elit. Deserunt, illum?',
                'image' => 'assets/products_photos/appliance.png'
            ])->categories()->attach(7);
        }

    }
}
