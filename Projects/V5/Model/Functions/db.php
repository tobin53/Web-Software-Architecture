<?php
/**
 * Author: Brandon Tobin
 * Date: Spring 2016
 *
 * Helper Function for opening DB connections
 *
*/


function openDBConnection()
{
    $DBH = new PDO ("mysql:host=localhost;dbname=Grad_Prog_V5;charset=utf8", 'Grad_Application', '173620901');
    $DBH->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $DBH->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    return $DBH;
}