<?php

if (!isset($_SESSION)) {
    session_start();
} 
if (!Customer::authenticate()) {
    redirect('../login.php'); 
}