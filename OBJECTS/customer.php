<?php
#Revision history:
#DEVELOPER          DATE            COMMENTS         
#Danial Gosse       2021-04-21      Created customer class + save, load, & login
#                                   functions. 
#                                   


require_once 'connection.php';
require_once 'purchases.php';
require_once 'purchase.php';

class customer
{
   private $customer_uuid = "";
   private $first_name = "";
   private $last_name = "";
   private $address = "";
   private $city = "";
   private $province = "";
   private $postal_code = "";
   private $username = "";
   private $password = "";
   private $create_date = "";
   private $last_update_date = "";
   
   
   //Constuctor:
   function __construct($first_name = "", $last_name = "", $address = "", $city = "", $province = "", $postal_code = "", $username = "", $password = "") 
   {
       //Passing parameters to their setters for verification and setting them
       //to this object
       if ($first_name != ""){
       $this->setFirstName($first_name);
       $this->setLastName($last_name);
       $this->setAddress($address);
       $this->setCity($city);
       $this->setProvince($province);
       $this->setPostalCode($postal_code);
       $this->setUserName($username);
       $this->setPassword($password);
       }
       

    }
    function filter($customer_uuid, $create_date = "")
    {
        global $connection;
        $sqlQuery = "CALL filter_purchase(:customer_uuid, :create_date);";
        $PDOStatment = $connection->prepare($sqlQuery);
        $PDOStatment->bindparam(":customer_uuid", $customer_uuid);
        $PDOStatment->bindparam(":create_date", $create_date);
        $PDOStatment->execute();
        
        while($row = $PDOStatment->fetch()){
          $purchases = new purchases($row["product_code"], $row["first_name"], $row["last_name"], $row["city"], $row["comments"], $row["product_price"],
                 $row["purchase_quantity"], $row["subtotal"], $row["tax_amount"], $row["grand_total"] );
            echo '<br / >';
        }
        return $purchases;
    }
    
    function save()
    {
        global $connection;
        
        if ($this->customer_uuid == ""){
            
        $sqlQuery = "CALL insert_customer(:first_name, :last_name, :address, :city, :province, :postal_code, :username, :password);";
        $PDOStatment = $connection->prepare($sqlQuery);
        
        $PDOStatment->bindparam(":first_name", $this->first_name);
        $PDOStatment->bindparam(":last_name", $this->last_name);
        $PDOStatment->bindparam(":address", $this->address);
        $PDOStatment->bindparam(":city", $this->city);
        $PDOStatment->bindparam(":province", $this->province);
        $PDOStatment->bindparam(":postal_code", $this->postal_code);
        $PDOStatment->bindparam(":username", $this->username);
        $PDOStatment->bindparam(":password", $this->password);
        $PDOStatment->execute();
        return true;  
        }
        else {
        $sqlQuery = "CALL update_customer(:customer_uuid, :first_name, :last_name, :address, :city, :province, :postal_code, :username, :password);";
        $PDOStatment = $connection->prepare($sqlQuery);
        $PDOStatment->bindparam(":customer_uuid", $this->customer_uuid);
        $PDOStatment->bindparam(":first_name", $this->first_name);
        $PDOStatment->bindparam(":last_name", $this->last_name);
        $PDOStatment->bindparam(":address", $this->address);
        $PDOStatment->bindparam(":city", $this->city);
        $PDOStatment->bindparam(":province", $this->province);
        $PDOStatment->bindparam(":postal_code", $this->postal_code);
        $PDOStatment->bindparam(":username", $this->username);
        $PDOStatment->bindparam(":password", $this->password);
        $PDOStatment->execute();
        }
    }
    
     function load($username)
     {
        global $connection;
        
        $sqlQuery = "CALL select_one_customer(:username);";
        $PDOStatment = $connection->prepare($sqlQuery);
        $PDOStatment->bindparam(":username", $username);
        $PDOStatment->execute();
        
        if ($row = $PDOStatment->fetch()){
            $this->customer_uuid = $row["customer_uuid"];
            $this->first_name = $row["first_name"];
            $this->last_name = $row["last_name"];
            $this->address = $row["address"];
            $this->city = $row["city"];
            $this->province = $row["province"];
            $this->postal_code = $row["postal_code"];     
            $this->username = $row["username"];
            $this->password = $row["password"];
            $this->create_date = $row["create_date"];
            $this->last_update_date = $row["last_update_date"];
            return true;
        }
        
        } 
     
    function delete($customer_uuid)
    {
        global $connection;
        $sqlQuery = "CALL delete_customer(:customer_uuid);";
        $PDOStatment = $connection->prepare($sqlQuery);
        
        $PDOStatment->bindparam(":customer_uuid", $customer_uuid);
        $PDOStatment->execute();
        
    }    
        
    function login($username, $password)
    {
       global $connection;
        
        $sqlQuery = "CALL get_password(:username);";
        $PDOStatment = $connection->prepare($sqlQuery);
        $PDOStatment->bindparam(":username", $username);
        $PDOStatment->execute();   
        
         if ($row = $PDOStatment->fetch()){   
            $this->username = $username;
            $this->password = $row["password"];
        }
         if (password_verify($password, $this->password)){
                return true;
            }
    }
    
    function display(){
        echo 'username: ' . $this->username . ' Password: ' .  ' UUID: ' . $this->customer_uuid . $this->password . ' First name:' . $this->first_name . ' Last name: ' . $this->last_name
               .' adddress: ' . $this->address . ' City: ' . $this->city . ' Province: ' . $this->province . 'Create date:' .$this->create_date;
    }
    
    
   //Getters:
   public function getUuid(){
        return $this->customer_uuid; 
    }
    public function getFirstName(){
        return $this->first_name; 
    }
    public function getLastName(){
        return $this->last_name; 
    }
    public function getAddress(){
        return $this->address; 
    }
    public function getCity(){
        return $this->city; 
    }
    public function getProvince(){
        return $this->province; 
    }
    public function getPostalCode(){
        return $this->postal_code; 
    }
    public function getUsername(){
        return $this->username; 
    }
    public function getPassword(){
        return $this->password; 
    }
    public function getCreateDate(){
        return $this->create_date; 
    }
    public function getLastUpdateDate(){
        return $this->last_update_date; 
    }

    //Setters:
    //We dont have to validate the setters for uuids because sql generates them
    //for us
    //Error messages are sent on the page itself
    public function setUuid($customer_uuid)
    {
          $this->customer_uuid = $customer_uuid;  
    }
    public function setFirstName($first_name)
    {
        if (mb_strlen($first_name) > 0 && mb_strlen($first_name) <= NAME_MAX_LENGTH)
        {
          $this->first_name = $first_name;  
        }
        
    }
    public function setLastName($last_name)
    {
        if (mb_strlen($last_name) > 0 && mb_strlen($last_name) <= NAME_MAX_LENGTH)
        {
          $this->last_name = $last_name;  
        }
    }
    public function setAddress($address)
    {
        if (mb_strlen($address) > 0 && mb_strlen($address) <= LOCALITY_MAX_LENGTH)
        {
          $this->address = $address;  
        }
    }
    public function setCity($city)
    {
        if (mb_strlen($city) > 0 && mb_strlen($city) <= LOCALITY_MAX_LENGTH)
        {
          $this->city = $city;  
        }
    }
    public function setProvince($province)
    {
        if (mb_strlen($province) > 0 && mb_strlen($province) <= LOCALITY_MAX_LENGTH)
        {
          $this->province = $province;  
        }
    }
    public function setPostalCode($postal_code)
    {
        if (mb_strlen($postal_code) == POSTAL_CODE_MAX_LENGTH)
        {
          $this->postal_code = $postal_code;  
        }
    }
    public function setUserName($username)
    {
        if (mb_strlen($username) > 0 && mb_strlen($username) <= USERNAME_MAX_LENGTH)
        {
          $this->username = $username;  
        }
    }
   public function setPassword($password)
    {
        if (mb_strlen($password) > 0 && mb_strlen($password) <= PASSWORD_MAX_LENGTH)
        {
          //getting the password and encrypting it
          $encrypted = password_hash($password, PASSWORD_DEFAULT);
          $this->password = $encrypted;  
        }
    }
    
    
}
