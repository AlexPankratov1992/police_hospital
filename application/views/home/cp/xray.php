<?php
echo anchor('xray/', '<span class="glyphicon glyphicon-user"></span> <br/>X-rays', array("class" => "btn btn-success btn-lg", "role" => "button", "title" => "List of All Xrays"));
echo anchor('xray/new_xray', '<span class="glyphicon glyphicon-user"></span> <br/>Register New X-ray', array("class" => "btn btn-success btn-lg", "role" => "button", "title" => "Register New Xray to Database"));
echo anchor('patient/inactive', '<span class="glyphicon glyphicon-user"></span> <br/>Inactive Patients', array("class" => "btn btn-danger btn-lg", "role" => "button", "title" => "Deleted/Inactive Patients List"));
