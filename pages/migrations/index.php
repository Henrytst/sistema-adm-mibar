<?php
require_once("create_schema.php");
require_once("create_Cliente_table.php");

$objMigration = new Migration();
$objMigration->slqCreateSchema();
$objCreateTable = new CreateTable();
$objCreateTable->CreateTable();

header('location: ../coqueteis.php');