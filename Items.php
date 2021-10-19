<?php
 class Items{

    /*
    After a client provides items urls on Amazon, we will have: ​
     Amazon price,
     product
     weight, width, height, depth

    */ 

   //Declare object properties
    public $product_id;
    public $amazon_price;
    
    // dimension of Item 
    public $width;
    public $height;
    public $depth;

   // Weight of Item 
    public $weight;

    public function set()
    {
        $this->product_id = readline('Input product id: ');
        $this->amazon_price = readline('Input amazone price : ');
        $this->width = readline('Input width : ');
        $this->height = readline('Input height :: ');
        $this->depth = readline('Input depth : ');
        $this->weight = readline('Input weight : ');
    }

    public function get ()
    {
        echo "Product_id: ".$this->product_id."\n";
        echo "Amazon price:  ".$this->amazon_price."\n";
        echo "Width:  ".$this->width."\n";
        echo "Height:  ".$this->height."\n";
        echo "Depth:  ".$this->depth."\n";
        echo "Weight:  ".$this->weight."\n";

      
    }

     //fee by weight = product weight x weight coefficient
     Public function feebyweight($weight_coefficient)
     {
         $fee_weight = $this->weight * $weight_coefficient;
         return $fee_weight;
     }
 
     //fee by dimension = width x height x depth x dimension coefficient
     Public function feebydimension($dimension_coefficient)
     {
         $fee_by_dimension = $this->width * $this->height * $this->depth *$dimension_coefficient ;
         return $fee_by_dimension;
     }

    //shipping fee = max (fee by weight, fee by dimensions)
    Public function shippingfee($weight_coefficient,$dimension_coefficient,$free_by_product_type)
    {
        $fee_by_dimension = $this->feebydimension($dimension_coefficient);
        $fee_weight = $this->feebyweight($weight_coefficient);
        if($free_by_product_type)
        {
            return max($fee_by_dimension,$fee_weight,$free_by_product_type);
        }
        else
        {
            return max($fee_by_dimension,$fee_weight);
        }
     
    }

    //item price = amazon price + shipping fee
    Public function itemprice($weight_coefficient,$dimension_coefficient,$free_by_product_type)
    {
        $fee_weight = $this->weight * $weight_coefficient;
        $fee_by_dimension = $this->width * $this->height * $this->depth *$dimension_coefficient ;
        if(isset($free_by_product_type))
        {
            $shipping_fee = max($fee_by_dimension,$fee_weight,$free_by_product_type);
        }
        else 
        {
            $shipping_fee = max($fee_by_dimension,$fee_weight);
        }
        $item_price = $this->amazon_price + $shipping_fee;
        
        return $item_price;
    }

 }