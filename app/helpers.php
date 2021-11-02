<?php
 function presentPrice($price){
    return '$' .  number_format($price/100, 2, '.', '');
}

function setActiveCategory($category, $output = 'active'){
    return request()->category === $category ? $output : '';
}

function productImage($path){
     return $path  && file_exists('storage/'.$path) ? asset('storage/'.$path): asset('assets/photos/macbook-pro.png');
}
function getStockLevel($quantity){
    if($quantity > setting('site.stock_threshold')){
        $stockLevel = '<div class="badge badge-success">In stock:</div>';
    }elseif($quantity <= setting('site.stock_threshold')&& $quantity > 0){
        $stockLevel = '<div class="badge badge-warning">Low stock</div>';
    }
    else{
        $stockLevel = '<div class="badge badge-danger">Not available in stock</div>';
    }
    return $stockLevel;
}
