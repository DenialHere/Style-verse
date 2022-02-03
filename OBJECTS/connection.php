<?php
#Danial Gosse       2021-04-26      Created the connection with root
#Danial Gosse       2021-05-01      Changed root to custom user

$connection = new PDO("mysql:host=localhost;dbname=database-1912983", "root", "lasalle");

$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

