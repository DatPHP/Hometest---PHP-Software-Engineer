<?php 
//include('Items.php');

class Orders extends Items
{
     public $item_list = array(); // list of item in Order
     public $item_amount; // amount of item 
     // Fee 
     public $dimension_coefficient; // weight coefficient
     public $weight_coefficient;    // dimension coefficient
     public $free_by_product_type;   //fee by product type

     public function set_dimension_coefficient ()
     {
         $this->dimension_coefficient = readline('Input dimension_coefficient: ');
     }
 
     public function set_weight_coefficient ()
     {
         $this->weight_coefficient = readline('Input weight_coefficient: ');
     }

     public function set_free_by_product_type ()
     {
         $this->free_by_product_type = readline('Input free_by_product_type if have: ');
     }

     function __construct() {

        $this->set_dimension_coefficient();
        $this->set_weight_coefficient();
        $this->set_free_by_product_type ();

      }


     public function pushItem()
     {
       $item = new Items();
       $item->set();
       $this->item_list[] = $item;

     }

      public function set()
      {
         // parent::nhap();
          $this->item_amount = readline("Input Amount of Item of this Order: ");
          for ($i=0;$i< $this->item_amount;$i++)
          {
              $item = new Items();
              $item->set();
              $this->item_list[] = $item;
          }

      }

     

      public function removeItem()
      {
          echo "Input product id that you want to delete: \n";
          $keywork = readline("");
          foreach ($this->item_list as $key => $items)
          {
            if($items->product_id == $keywork)
            {
                unset($this->item_list[$key]);
            }
          }
      }


      public function get()
      {
          //parent::xuat();
          $weight_coefficient = $this->weight_coefficient;
          $dimension_coefficient = $this->dimension_coefficient;
          $free_by_product_type = (isset($this->free_by_product_type))?$this->free_by_product_type : 0;

          echo "----------Order List include : ---------------\n";
          foreach ($this->item_list as $items)
          {
              $items->get();
              $items->itemprice($weight_coefficient,$dimension_coefficient,$free_by_product_type);
               echo "Fee by weight:  ".$items->feebyweight($weight_coefficient)."\n";
               echo "fee by dimension:  ".$items->feebydimension($dimension_coefficient)."\n";
               echo "shipping fee:  ".$items->shippingfee($weight_coefficient,$dimension_coefficient,$free_by_product_type)."\n";
               echo "item price :  ".$items->itemprice($weight_coefficient,$dimension_coefficient,$free_by_product_type)."\n";
               echo "-------------------------\n";
          }
      }

      /*
      ● We need to calculate a gross price for an order (contains many items) follow
        gross price = item price 1 + item price 2 + ...
        */
    public function grossprice()
    {
        $gross_price = 0;
        $weight_coefficient = $this->weight_coefficient;
        $dimension_coefficient = $this->dimension_coefficient;
        $free_by_product_type = $this->free_by_product_type;
        foreach ($this->item_list as $items)
        {
            $gross_price += $items->itemprice($weight_coefficient,$dimension_coefficient,$free_by_product_type);
        }

        echo "Gross price: ".$gross_price."\n";
    } 


}

/*
test 
$order = new Orders();
$order->set();
$order->get();
$order->grossprice();
*/ 


