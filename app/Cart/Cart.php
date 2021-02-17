<?php
namespace App\Cart;

use App\Models\Product;

class Cart
{

    // Create One Row In Cart

    private static function create($productid,$sku,$variant=null,$quantity=null)
    {
        //Check If Cart Is found In Your Cookie
          if(isset($_COOKIE["Cart"])){ $cookie_data = stripslashes($_COOKIE['Cart']);$cart_data = json_decode($cookie_data, true);}else{ $cart_data = array();}
          //Check If quantity Is Null  set quantity =1
            $q=isset($quantity)?$quantity:1;
            //Create Array Cart
            $item_array = array(
             'id'          => $sku,
             'productid'   => $productid,
             'sku'         => $sku,
             'variant'     => $variant,
             'quantity'    => $q,
            );
            // Set Data In Cart
            $cart_data[] = $item_array;
            $item_data = json_encode($cart_data,JSON_UNESCAPED_UNICODE);
            // Set Cookie In 30 Days
            setcookie('Cart', $item_data, time() + (86400 * 30),'/');
    }

    // Update One Row In Cart

    private static function update($sku,$quantity=null)
    {
      //Get Cookie Cart
     $cookie_data = stripslashes($_COOKIE['Cart']);
     $cart_data = json_decode($cookie_data, true);
     //Search By Id In Cart If quantity= null , plus 1
     $id_list = array_column($cart_data, 'id');
     $cartid=$sku;
     if(in_array($cartid, $id_list))
     {
        foreach($cart_data as $keys => $values)
        {
           if($cart_data[$keys]["id"] == $cartid && !isset($quantity))
           {
            $cart_data[$keys]["quantity"] = $cart_data[$keys]["quantity"] +1;
           }
           if($cart_data[$keys]["id"] == $cartid && isset($quantity))
           {
            $cart_data[$keys]["quantity"] =$quantity;
           }
        }
     }
        // Set Data In Cart
        $item_data = json_encode($cart_data,JSON_UNESCAPED_UNICODE);
        setcookie('Cart', $item_data, time() + (86400 * 30),'/');
    }

    // Delete One Row In Cart

    public static function destroy($sku)
    {
        //Get Cookie Cart
       $cookie_data = stripslashes($_COOKIE['Cart']);
       $cart_data = json_decode($cookie_data, true);
       foreach($cart_data as $keys => $values)
       {
        if($cart_data[$keys]['id'] == $sku)
        {
         unset($cart_data[$keys]);
         $item_data = json_encode($cart_data,JSON_UNESCAPED_UNICODE);
         setcookie("Cart", $item_data, time() + (86400 * 30),'/');
        }
       }
    }

    // Delete All In Cart

    public static function clear()
    {
       setcookie("Cart", "", time() - 3600,'/');
    }

    // Count All In Cart

    public function count()
    {
       if(isset($_COOKIE['Cart']))
       {
         return count($this->content());
       }
       return 0;
    }

    // Create Or Update In Cart

    public static function CreateORUpdate($productid,$sku,$variant=null,$quantity=null)
    {

       if(isset($_COOKIE["Cart"]))
       {
          $cookie_data = stripslashes($_COOKIE['Cart']);
          $cart_data = json_decode($cookie_data, true);
          $id_list = array_column($cart_data, 'id');
          $cartid=$sku;
       } else{
          $cart_data = array();
       }
       if(isset($_COOKIE['Cart']) && in_array($cartid,$id_list))
                  {return  self::update($sku,$quantity);}
              else{return  self::create($productid,$sku,$variant=null,$quantity);}
    }

    // Get Total Price In Cart

    public function total()
    {
       $total=0;
       foreach ($this->content() as $key => $value) {
          $total+=$value['total_price'];
       }
       return $total;
    }

    // Get All Content In Cart

    public function content()
    {
      $cart=array();
      if(isset($_COOKIE['Cart']))
      {
          $i=0;
          foreach (json_decode($_COOKIE['Cart']) as $key => $value) {
            if ($value->productid && $value->variant==null) {
                $product=Product::find($value->productid);
            }
            $cart[$i]['id']=$value->id;
            $cart[$i]['productid']=$product->id;
            $cart[$i]['quantity']=$value->quantity;
            $cart[$i]['name']=$product->name;
            $cart[$i]['image_path']=$product->image_path;
            $cart[$i]['price']=$product->priceafteroffer;
            $cart[$i]['total_price']=$value->quantity*$product->priceafteroffer;
            $cart[$i]['variant']=$value->variant;
            $cart[$i]['sku']=$product->sku;
            $i++;
          }
          return $cart;
      }
       return $cart;
    }

}
