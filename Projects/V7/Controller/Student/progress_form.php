<?php
/**
 * Author: Brandon Tobin
 * Date: Spring 2016
 *
 * Progress Forms Controller
 *
 */

// Set the include path for the model and view
set_include_path("../../Model/Student/" .PATH_SEPARATOR . "../../View/Student/");

// Require the model file once
require_once 'progress_form.php';

// Get the id out of the url
$id = $_GET['id'];
$fid = $_GET['form'];

// Create a new form object
$form = new Student_Form($id, $fid);

// Require the form view for display
require "progress_form_view.php";

?>
