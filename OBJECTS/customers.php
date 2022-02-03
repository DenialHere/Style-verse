<?php
#Revision history:
#DEVELOPER          DATE            COMMENTS         
#Danial Gosse       2021-04-26      Created customers class
#  
require_once 'connection.php';
require_once 'collection.php';
require_once 'customer.php';

class customers extends collection
{
    function __construct() {
        global $connection;
        $sqlQuery = "CALL select_all_customers;";
        $PDOStatment = $connection->prepare($sqlQuery);
        $PDOStatment->execute();
        
        while ($row = $PDOStatment->fetch()){
            $customer = new customer($row["customer_uuid"],
                    $row["first_name"], 
                    $row["last_name"], 
                    $row["address"], 
                    $row["city"],
                    $row["province"],
                    $row["postal_code"], 
                    $row["username"], 
                    $row["password"], 
                    $row["create_date"], 
                    $row["last_update_date"]);
            $this->add($row["customer_uuid"], $customer);

        }
    }
}
