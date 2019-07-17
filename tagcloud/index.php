<?php 
//This file acts as the controller in MVC 
//open DB connection

include_once('models/opendb.php');

//load models

include_once('models/tagcloud.model.php');

//create tag cloud

$tagcloud = new tagcloud_model($mysqli);

$data['tag_list'] = $tagcloud->get_tag_list();
$data['tag_cloud'] = $tagcloud->get_tag_cloud();

//load view

include('views/tagcloud.view.php');

//close db
include_once('closedb.php');

?>