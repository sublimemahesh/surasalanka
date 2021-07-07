<!DOCTYPE html>
<?php
include '../class/include.php';

$CUSTOMER = new Customer(NULL);

if ($CUSTOMER->logOut()) {
    header('Location: ../index.php');
}
?>
 
