<?php

switch ((isset($_GET['p']) ? $_GET['p'] : '')) {
    case 'staff':
        include 'pages/staff.php';
        break;

    case 'activity':
        include 'pages/activities.php';
        break;
    
    case 'inventory':
        include 'pages/inventory.php';
        break;

    case 'track_order':
        include 'pages/track_order.php';
        break;

    case 'order':
        include 'pages/order.php';
        break;

    case 'order'; 
        include 'pages/order.php';
        break;

    case 'product':
        include 'pages/product.php';
        break;
    
    default:
        include 'home.php';
        break;
}