<?php
session_start();
 
// get the product id
$id = isset($_GET['id']) ? $_GET['id'] : 1;
$quantity = isset($_GET['quantity']) ? $_GET['quantity'] : "";
 
// make quantity a minimum of 1
$quantity=$quantity<=0 ? 1 : $quantity;
 
// // remove the item from the array
// unset($_SESSION['list'][$id]);
 
// // add the item with updated quantity
// $_SESSION['list'][$id]=array(
//     'quantity'=>$quantity
// );

$_SESSION['list'][$id]['quantity'] = $quantity;
 
// redirect to product list and tell the user it was added to cart
header('Location: panier.php?action=quantity_updated&id=' . $id);
?>