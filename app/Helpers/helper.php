<?php


function cartArray(){
    $cartCallection = Cart::getContent();
    return $cartCallection->toArray();
}
?>