<?php
/* 
 author: Nguyen Van Dat 
 date: 19.10.2021 
 toptic: Home Test 
*/

require_once ('Items.php');
require_once ('Orders.php');

/*

INPUT: 

● There is a shipping service. It helps Vietnamese buy products on Amazon website.
After a client provides items urls on Amazon, we will have: ​ Amazon price, product
weight, width, height, depth

OUTPUT: 

● We need to calculate a gross price for an order (contains many items) follow
formulas:
● gross price = item price 1 + item price 2 + ...
● item price = amazon price + shipping fee
● shipping fee = max (fee by weight, fee by dimensions)
● fee by weight = product weight x weight coefficient
● fee by dimension = width x height x depth x dimension coefficient

*/ 

 function menu ()
{
   $order = new Orders();
   echo "OK! Let go to shooping?\n";
   echo "What do you want to buy?\n";
   echo "1./ Add a item into order        1\n";
   echo "2./ Add items to order with quantity          2\n";
   $choose = readline("You choose ? :");
   echo $choose;
   echo "\n";
   switch ($choose)
   {
       case 1:
           {
            $order->pushItem();
            $order->get();
            $order->grossprice();
            break;

           }

       case 2:
       {
            $order->set();
            $order->get();
            $order->grossprice();
            echo "Do you want to remove a item from order?    yes or no ? \n";
            $choose = readline("");
            if($choose == 'yes')
            {
                $order->removeItem();
                $order->get();
                $order->grossprice();
            }
            else 
            {
                $order->get();
                $order->grossprice();
            }

            break;
       }

       Default:
       {
            echo "Do you add a Items into Order?\n";
            $order->pushItem();
            $order->get();
            $order->grossprice();
       }
   }
}
menu ();
