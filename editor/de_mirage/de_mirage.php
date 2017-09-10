<?php

// Tables for this example.php see file: 'test.sql'

session_start();
require_once("mte/mte.php");
$tabledit = new MySQLtabledit();



		#####################
		# required settings #
		#####################


# database settings:
$tabledit->database = 'c2ranksea';
$tabledit->host = '192.168.16.12';
$tabledit->user = 'c2ranksea';
$tabledit->pass = 'geqAB54A@';


# table of the database you want to edit:
$tabledit->table = 'nades_de_mirage';


# the primary key of the table (must be AUTO_INCREMENT):
$tabledit->primary_key = 'id';


# the fields you want to see in "list view"
# Always add the primary key (`employeeNumber)`: 
$tabledit->fields_in_list_view = array('id','title','help','line_x1','line_y1','line_x2','line_y2','mode','side','youtube');



		#####################
		# optional settings #
		#####################


# Head of the page (<h1>head_1<h1>):
$tabledit->head_1 = "de_Mirage Spots | <a href='/editor/de_mirage/upload/index.html'>Screenshots upload!</a>";


# language (en=English, de=German, fr=French, nl=Dutch):
$tabledit->language = 'en';


# numbers of rows/records in "list view": 
$tabledit->num_rows_list_view = 50;


# required fields in edit or add record: 
$tabledit->fields_required = array('id','title','help','line_x1','line_y1','line_x2','line_y2','mode','side');


# Fields you want to edit (remove this to edit all the fields).
#$tabledit->fields_to_edit = array('lastName','email','job');


# help texts: 
$tabledit->help_text = array(
	'id' => "Spot id",
	'title' => 'Description of spot',
	'help' => '1(throw),2(run&throw),3(jump&throw),4(run&jump&throw),5(catwalk&throw),6(catwalk&jump&throw),7(crouch&throw)',
	'line_x1' => 'x position of spot point on line',
	'line_y1' => 'y position of spot point on line',
	'line_x2' => 'x position of target point on line',
	'line_y2' => 'y position of target point on line',
	'middle_positions' => 'for bounce of nade (by wall,skybox etc...), usage x,y x1,y2 x2,y2 ... (example 456,125)',
	'mode' => '1(smoke), 2(fire), 3(flash)',
	'side' => '1(T Side), 2(CT Side)',
	'type' => 'blank',
);


# visible name of the fields: 
$tabledit->show_text = array(
	'employeeNumber' => 'Number',
	'active' => 'Active',
	'firstName' => 'First name',
	'lastName' => 'Last name',
	'email' => 'Email',
	'job' => 'Job'
);


# visible name of the fields in list view: 
$tabledit->show_text_listview = array(
	'employeeNumber' => 'Number',
	'active' => 'Active',
	'firstName' => 'First name',
	'lastName' => 'Last name',
	'email' => 'Email',
	'job' => 'Job'
);


# Make selectlist on inputfield based on another table
# in this example: `employees`.`job` is based on `jobs`.`jobname`: 
$tabledit->lookup_table = array(
	'job' => array(
		'query' => "SELECT `id`, `jobname` FROM `jobs`;",
		'option_value' => 'id',
		'option_text' => 'jobname'
	)
);


$tabledit->width_editor = '100%';
$tabledit->width_input_fields = '500px';
$tabledit->width_text_fields = '498px';
$tabledit->height_text_fields = '200px';


# warning no .htaccess ('on' or 'off'): 
$tabledit->no_htaccess_warning = 'off';



		####################################
		# connect, show editor, disconnect #
		####################################


$tabledit->database_connect();

echo "<!DOCTYPE html>
<html lang='en'>
<head>

	<meta charset='utf-8'>

	<title>MySQL table edit</title>
	</head>
	<body>
";

$tabledit->do_it();

echo "
	</body>
	</html>"
;

$tabledit->database_disconnect();
?>
