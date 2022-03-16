<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    public $items = null;
    public $totalQty = 0;
    public $totalPrice = 0;

    public function __construct($oldCart){
        if($oldCart){
            $this->items = $oldCart->items;
            $this->totalQty = $oldCart->totalQty;
            $this->totalPrice = $oldCart->totalPrice;
        }
    }

    public function addcart($item, $id){
        $giohang = ['qty'=>0, 'price' => $item->Giasp, 'ten_san_pham' => $item];
        if($this->items){
            if(array_key_exists($id, $this->items)){
                $giohang = $this->items[$id];
            }
        }
        $giohang['qty']++;
        if ($item->GiaKM == 0){
           $giohang['price'] = $item->Giasp * $giohang['qty'];
        }else{
           $giohang['price'] = $item->GiaKM * $giohang['qty'];
        }
        $this->items[$id] = $giohang;
        $this->totalQty++;
        if ($item->GiaKM==0) {
           $this->totalPrice += $item->Giasp;
        }
        $this->totalPrice += $item->GiaKM;
    }
    public function deleteCart($id){
        $this->totalQty -= $this->items[$id]['qty'];
        $this->totalPrice -= $this->items[$id]['price'];
        unset($this->items[$id]);
    }
     public function saveCart($id ,$qty){
        $this->totalQty -= $this->items[$id]['qty'];
        $this->totalPrice -= $this->items[$id]['price'];
        $this->items[$id]['qty'] = $qty; 
      if ($this->items[$id]['ten_san_pham']->GiaKM == 0) {
         $this->items[$id]['price'] = $qty * $this->items[$id]['ten_san_pham']->Giasp;
      }else{
        $this->items[$id]['price'] = $qty * $this->items[$id]['ten_san_pham']->GiaKM;}
        $this->totalQty += $this->items[$id]['qty'];
        $this->totalPrice += $this->items[$id]['price'];
    }
}
