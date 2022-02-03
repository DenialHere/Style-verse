<?php
#Revision history:
#DEVELOPER          DATE            COMMENTS         
#Danial Gosse       2021-02-14      Created generate HTML & end HTML functions 
#                                   + created footer
#Danial Gosse       2021-02-14      Created the generate AD function for 
#                                   functionality testing will be refined later
#Danial Gosse       2021-02-15      Minor css changes + updated logo from
#                                   placeholder.
#                                   
#Danial Gosse       2021-02-28      Fixed generate ad function + added buy 
#                                   function.
#      
#Danial Gosse       2021-03-03      Created new custom ads to replace 
#                                   placeholders + fixed constant in ads. +
#                                   fixed nav bar logo link
#                                   
#Danial Gosse       2021-03-03      Updated buy function to store data into an
#                                   array + fixed validation + created buy
#                                   function
#Danial Gosse       2021-03-09      Added error handling + added more comments
#
#Danial Gosse       2021-03-10      Added constants for validation values +
#                                   fixed buy function error where an additonal
#                                   empty cell would be added + fixed some 
#                                   malformed html
#                                                                      
#Danial Gosse       2021-04-10      Added constants for ad pictures + changed
#                                   picture file types to lowercase. Fixed buy
#                                   validation to check all fields at once
#                                   instead of one at a time. Added the login
#                                   function.  
#                                   
#Danial Gosse       2021-01-21      Created login function + edited navbar to
#                                   accommodate the login/logout + defined
#                                   constants for customer objects.
#                                   
#Danial Gosse       2021-01-23      Made the login function more modular + 
#                                   seperated html and php parts of login 
#                                   function
#
#Danial Gosse       2021-05-02      Changed all file extensions to uppercase
#
#


session_start();

//Defining folder constants
define("FOLDER_IMAGES", "IMAGES/");
define("FOLDER_ERROR", "ERROR_LOG/");
define("ORDER_FOLDER", "ORDERS/");
define("FOLDER_OBJECTS", "OBJECTS/");
define("FOLDER_JAVASCRIPT", "./JS/");

//Defing javascript files
define("SEARCHJS", "search.js");
define("OBJECT_CUSTOMERS", FOLDER_OBJECTS . "customers.php");


//Defining constants for objects
define("OBJECT_CUSTOMER", FOLDER_OBJECTS . "customer.php");
define("OBJECT_PRODUCT", FOLDER_OBJECTS . "product.php");
define("OBJECT_PRODUCTS", FOLDER_OBJECTS . "products.php");
define("OBJECT_COLLECTION", FOLDER_OBJECTS . "collection.php");
define("OBJECT_PURCHASE", FOLDER_OBJECTS . "purchase.php");

//Defining logo name
define("LOGO", "Style_verse_logo.PNG");

//Defining empty order picture name
define("EMPTY_PICTURE", "empty.JPG");
##BUY PAGE
//defining purchase text file
define("PURCHASES_FILE", "purchases.txt");
//Defining the submit button for the buy page
define("SUMBIT", "buy");
//Defining the product code for the buy page
define("PRODUCT_CODE", "productCode");
//Defining the users first name for the buy page
define("FIRST_NAME", "fName");
//Defining the users last name for the buy page
define("LAST_NAME", "lName");
//Defining the users city for the buy page
define("CITY", "city");
//Defining the users comment for the buy page
define("COMMENT", "comment");
//Defining the price for the buy page
define("PRICE", "price");
//Defining the quantity for the buy page
define("QUANTITY", "quantity");
//Defining the tax rate for the buy page
define("TAX_RATE", 1.152);

//Defining USERNAME max length
define("USERNAME_MAX_LENGTH", 12);

//Defining first and last name max length
define("NAME_MAX_LENGTH", 20);

//Defining city  max length
define("CITY_MAX_LENGTH", 8);

//Defining comment  max length
define("COMMENT_MAX_LENGTH", 200);

//Defining price max value
define("PRICE_MAX_VALUE", 10000);

//Defining QUANTITY max value
define("QUANTITY_MAX_VALUE", 100);

//Defining ADDRESS max length
define("LOCALITY_MAX_LENGTH", 25);

//Defining POSTAL CODE max length
define("POSTAL_CODE_MAX_LENGTH", 7);

//Defining PASSWORD CODE max length
define("PASSWORD_MAX_LENGTH", 255);

//Defining product cost price max value
define("PRODUCT_COST_MAX_VALUE", 100000);

//Defining product price max value
define("PRODUCT_PRICE_MAX_VALUE", 10000);

#Register page
//Defining constants
define("FIRST_NAME_REGISTER", "fName");
define("LAST_NAME_REGISTER", "lName");
define("ADDRESS_REGISTER", "address");
define("CITY_REGISTER", "city");
define("PROVINCE_REGISTER", "province");
define("POSTALCODE_REGISTER", "postal");
define("USERNAME_REGISTER", "username");
define("PASSWORD_REGISTER", "password");
define("PASSWORD_REGISTER_VERIFY", "passwordVerify");
define("REGISTER_BUTTON", "register");



##ADS
//Defining which ad will be highlighted
define("SPECIAL_AD", 5);
define("ORDER_COMPLETE", FALSE);
//Defining constants for ad pictures
define("AD_01", "ad_01.PNG");
define("AD_02", "ad_02.PNG");
define("AD_03", "ad_03.PNG");
define("AD_04", "ad_04.PNG");
define("AD_05", "ad_05.PNG");



##Error handling
error_reporting(0);
set_error_handler("manageError");
set_exception_handler("manageException");

//Debug constant: when set to true it will display errors to the user
//when false it will log it to a text file
define("DEBUG", true);

##LOGIN
define("LOGGED_IN", False);

##Load objects
require_once OBJECT_CUSTOMER;
require_once OBJECT_PRODUCT;
require_once OBJECT_PRODUCTS;
require_once OBJECT_COLLECTION;
require_once OBJECT_PURCHASE;
require_once OBJECT_CUSTOMERS;

//Forcing HTTPS
if (!isset($_SERVER["HTTPS"]) || $_SERVER["HTTPS"] != "on"){
    header('Location: https://' . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]);
    exit();
}

function manageError($errorNumber, $errorString, $errorFile, $errorLine, $errorContext){
    
    //When debugging program this will display the error to the user
    //*Should be turned off when not debugging
    if (DEBUG == TRUE){
        echo 'Error number: ' . $errorNumber . 
             '<br/>Error String: ' . $errorString .
             '<br/>Error File: ' . $errorFile .
             '<br/>Error line: '  . $errorLine .
             '<br/>Error context: ' . $errorContext;
    }
    else {
    //Public message
    echo '<div class="center bold mar-top"> An error as occured, sorry  about that :(</div>';

    #Developer message:
    
    //Getting date & browser information
    $date = date("Y-m-d H:i:s.u");
    $browser = $_SERVER["HTTP_USER_AGENT"];

    //Creating an array with all the information we need about the error
    $error = array(
                    0 => "Error number: " . $errorNumber,
                    1 => "Error sting: " . $errorString,
                    2 => "Error file: " . $errorFile,
                    3 => "Error Line: " . $errorLine,
                    4 => "Error context: " . $errorContext,
                    5 => "Date: " . $date,
                    6 => "Browser: " . $browser,
                    7 => "========================");
    
    //Converting the error array to a json 
    $json_order = json_encode($error);
    
    //Opening/creating error text file
    $myFile = fopen(FOLDER_ERROR . "errors.txt", "a") or die("The file couldnt be opened");
    
    //Saving array into a text file
        for ($i = 0; $i < count($error); $i++)
        {
             fwrite($myFile, $error[$i] . "\r\n");
        }
             fclose($myFile);
    }
    
    //Terminate once done     
    die();

   
}
function manageException($exception){
    if (DEBUG == false){
        echo 'Exception Caught: ' . $exception->getMessage() . 
             '<br/>Error File: ' . $exception->getFile() .
             '<br/>Error Line: ' . $exception->getLine();
    }
    else {
    //Public message
    echo '<div class="center bold mar-top"> An error as occured, sorry  about that :(</div>';

    #Developer message:
    
    //Getting date & browser information
    $date = date("Y-m-d H:i:s.u");
    $browser = $_SERVER["HTTP_USER_AGENT"];

    //Creating an array with all the information we need about the exception
    $exception = array(
                    0 => "Exception Caught: " . $exception->getMessage(),
                    1 => "Error File: " . $exception->getFile(),
                    2 => "Error Line: " . $exception->getLine(),
                    3 => "Date: " . $date,
                    4 => "Browser: " . $browser,
                    5 => "========================");
    
    //Converting the exception array to a json 
    $json_order = json_encode($exception);
    
    //Opening/creating error text file
    $myFile = fopen(FOLDER_ERROR ."errors.txt", "a") or die("The file couldnt be opened");
    
    //Saving array into a text file
        for ($i = 0; $i < count($exception); $i++)
        {
             fwrite($myFile, $exception[$i] . "\r\n");
        }
             fclose($myFile);
    }
    
    //Terminate once done     
    die();
}





function generateHtml($title, $css, $opc){
    //This function will be called at the start of a page to generate the starting html and header
    
    //sending network headers to prevent caching
    header("Expires: Thu, 01 Dec 1994 08:00:00 GMT");
    header("Cache-Control: no-cache");
    header("Pragma: no-cache"); 
    //Sending network header to make sure the page displays utf-8
    header('content-type: text/html; charset=utf-8');
    
    #LOGOUT
    //Checking to see if the logout button is pushed
    if ((isset(($_POST['logout']))))
    {
        //If the user logs out delete all session variables
        session_unset();
        session_destroy(); 
    }
    
    #LOGIN
    //By default the invalid user/password message will be hidden
    $loginError = "hide";
    //Checking to see if the login button is pushed
    if ((isset(($_POST['login']))))
    {
        //Passing through the title of the current page, username and password entered
        //If their is an error the function will generate an empty string
        //Which will overide the default hide css and show an error message
        $loginError = login($title, $_POST['username'], $_POST['password']);
    }
    ?>

    <!DOCTYPE html>
    <html>
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <script language="javascript" type="text/javascript" src="<?php echo FOLDER_JAVASCRIPT . SEARCHJS; ?>"> </script>
            <!-- passing through the CSS folder and file location  -->
            <link rel="stylesheet" href="<?php echo FOLDER_CSS . $css; ?>"> 
            <!-- Passing through the title from the generate HTML function  -->
            <title><?php echo $title; ?></title>
        </head>
        <body>
            <nav class="nav-container">
                <ul class="li-none grid just-cent bold">
                    <a  href="index.php"> <img class="logo <?php echo $opc; ?>"  src="<?php echo FOLDER_IMAGES . LOGO; ?>" alt="Company logo"/> </a>
                    <li class="item"><a href="home.php">Home</a></li>
                    <?php
                    //If customer_uuid session variable is not set that means
                    //nobody is logged in
                    if (!isset($_SESSION["customer_uuid"])){
                        //Generate the login form and hide the rest of the site,
                        //Pass through the title of the page the user is currently
                        //on so that we can reload to the same page they are on
                        ?>
                        <!-- Login form -->
                        <form class="item2 just-cent grid login-grid" method="POST">
                            <label>Username:</label>
                            <input class="mar-btm5" type="text" name="username">
                            <label>Password:</label>
                            <input type="password" name="password">
                            <a id="register" href="register.php">Register now</a>
                            <input class="btn-login mar-btm5" type="submit" value="Login" name="login">
                            <!-- To hide/show login error message by default its hidden  -->
                            <label class="<?php echo $loginError; ?> red invalid">Invalid username or password!!!</label>
                        </form>
                        <?php
                    }
                    //if the session variable isnt empty show the full website
                    else {
                    ?>
                    <li><a href="buy.php">Buy</a></li>
                    <li><a href="orders.php">Orders</a></li>
                    <li><a href="account.php">Account</a></li>
                    <li>
                        <!-- Logout form  -->
                        <form action="index.php" method="post">
                            <!-- Showing the users first & last name  -->
                            <label><?php echo $_SESSION["first_name"] . ' ' . $_SESSION["last_name"]?></label>
                            <input class="btn-login bold mar-btm" type="submit" value="logout" name="logout">
                        </form>
                    </li>
                    <?php
                    }
                    ?>
                </ul>
            </nav>         
    <?php
}
function login($title, $username, $password){
        //creating a new customer object
        $customer = new customer(); 
        //passing the username and password to the login function
        if($customer->login($_POST['username'], $_POST['password']))
        {
            //if the login function returns true it means the username and password
            //are correct, then we use the customer object that we created and
            //load info from the db into the object
            $customer->load($customer->getUsername());
            //setting a session variable to equal to the customers uuid &
            //first and last name
            $_SESSION["customer_uuid"] = $customer->getUuid();
            $_SESSION["username"] = $username;
            $_SESSION["first_name"] = $customer->getFirstName();
            $_SESSION["last_name"] = $customer->getLastName();
            //reloading page when login is sucessful
            //reloading to the page the user was currently on
            header("location:$title.php");
        }
        else {
            //if login fails return an empty string which will display an error
            //message
            return "";
        }    
    }

function generateLogin(){
      //This hides the login error in the login form that displays after
      //you register
      $loginErrorRegister = "hide";
      
    //Checking to see if the login button is pushed
    if ((isset(($_POST['loginRegister']))))
    {
        //Passing through the title of the current page, username and password entered
        //If their is an error the function will generate an empty string
        //Which will overide the default hide css and show an error message
        $loginErrorRegister = login("index", $_POST['username'], $_POST['password']);
    }
    
    ?>
    <form class="grid just-cent" method="POST">
        <label class="mar-top mar-btm5">Username:</label>
            <input class="mar-btm center" type="text" name="username">
            <label class="mar-btm5">Password:</label>
            <input class="center mar-btm5" type="password" name="password">
            <input class="btn-fnd-out bold mar-btm5" type="submit" value="Login" name="loginRegister">
            <!-- To hide/show login error message by default its hidden  -->
        </form>
            <p class="center mar-btm <?php echo $loginErrorRegister; ?> red invalid">Invalid username or password!!!</p>
    <?php
}
    
    
function endHtml(){
    //This function will be called at the end of the page to close the html and house the footer
    
    //Getting current year to pass in the footer
    $year = date("Y");
    ?>
            <!-- Passing the current year to the footer -->
            <footer class="center blk-back wht-txt">
                Copyright &#169; <?php echo $year; ?> Danial Gosse 1912983
            </footer>
    </body>
</html>
   <?php 
}

function generateAd($num){
    //Creating an array to store ad image locations
    $ads = array(
             1 => FOLDER_IMAGES . AD_01,
             2 => FOLDER_IMAGES . AD_02,
             3 => FOLDER_IMAGES . AD_03,
             4 => FOLDER_IMAGES . AD_04,
             5 => FOLDER_IMAGES . AD_05);
    
    ?>
    <div class="center"> 
        <!-- Checking if the ad displayed is the special ad -->
        <a href="https://www.kanyewest.com/"><img class="
        <?php if ($num == SPECIAL_AD ){
            //If the ad is the special ad change the class
            echo 'special-ad"';
        }
        else {
            echo 'ad"';
        }
        ?>
        
        src="<?php 
        echo $ads[$num]; ?> " alt="ad"/>  </a>
    </div>
    
    <?php        
    
}
function buy(){
    
    //Validation:
    
    if (isset(($_POST[SUMBIT]))){
            //Declaring all variables and protecting them from html injection
            $productCode = htmlspecialchars (trim($_POST[PRODUCT_CODE]));
            $firstName = htmlspecialchars (trim($_POST[FIRST_NAME]));
            $lastName = htmlspecialchars (trim($_POST[LAST_NAME]));
            $city = htmlspecialchars (trim($_POST[CITY]));
            $comment = htmlspecialchars (trim($_POST[COMMENT]));
            $price = htmlspecialchars (trim($_POST[PRICE]));
            $quantity = htmlspecialchars (trim($_POST[QUANTITY]));
            $orderComplete = false;
            //Setting error messages to empty
            $errorPc = null;
            $errorFn = null;
            $errorLn = null;
            $errorCity = null;
            $errorComment = null;
            $errorPrice = null;
            $errorQuantity = null;
            
            //Performing validation
            if (substr(strtolower($productCode), 0 , 1) != "p" || mb_strlen($productCode) > PRODUCT_CODE_MAX_LENGTH ||  mb_strlen($productCode) <= 0 ){
                //Saving error message to be displayed later
                $errorPc = "The product code cannot be empty, cannot be longer than 12 characters, and must always begin with the letter P. ";
                echo substr("$productCode", 0, 1);
            }
            if (mb_strlen($firstName) > NAME_MAX_LENGTH ||  mb_strlen($firstName) <= 0){
                //Saving error message to be displayed later
                $errorFn = "First name cannot be empty, and cannot be longer than 20 characters. ";
            }
            if (mb_strlen($lastName) > NAME_MAX_LENGTH ||  mb_strlen($lastName) <= 0){
                //Saving error message to be displayed later
                $errorLn = "Last name cannot be empty, and cannot be longer than 20 characters. ";
            }
            if (mb_strlen($city) > CITY_MAX_LENGTH ||  mb_strlen($city) <= 0){
                //Saving error message to be displayed later
                $errorCity = "The city cannot be empty, and cannot be longer than 8 characters. ";
            }
            if (mb_strlen($comment) > COMMENT_MAX_LENGTH){
                //Saving error message to be displayed later
                $errorComment = "The maximum length of comments is 200 characters. ";
            }
            if (!is_numeric($price) || $price < 0 || $price > PRICE_MAX_VALUE){
                //Saving error message to be displayed later
                $errorPrice = "The price must be numeric, not negative, and less than 10,000.";
            }
            if (!is_numeric($quantity) || is_float($quantity) || $quantity <= 0 || $quantity > QUANTITY_MAX_VALUE){
                //Saving error message to be displayed later
                $errorQuantity = "The quantity must be greater than 0, less than 100 and not be a decimal.";
            }
            //If all the error messages are null then valadation has passed sucessfully
            if ($errorPc == null && $errorFn == null && $errorLn == null && $errorCity == null && $errorComment == null && $errorPrice == null && $errorQuantity == null) {
                //If all validation passes:
                $orderComplete = true;
                //Do calculations
                $subtotal = round($price * $quantity, 2);
                $taxes = round((($price * $quantity) * TAX_RATE) - $subtotal, 2);
                $total = round(($price * $quantity) * TAX_RATE, 2);
                //Save all data into an array
                $order = array(
                    0 => $productCode,
                    1 => $firstName,
                    2 => $lastName,
                    3 => $city,
                    4 => $comment,
                    5 => $price,
                    6 => $quantity,
                    7 => $subtotal,
                    8 => $taxes,
                    9 => $total);
                //Pass data to order complete function
                orderComplete($total, $order);
            }
            

        }
        ?>

    <!-- Buy form  -->
    <form class="grid container-buy just-cent<?php if(isset($orderComplete) && $orderComplete == true) echo 'hide'; ?>"  method="post">

        <label>Product code: <span class="red">*</span></label>
        <input class="center" type="text" name="productCode" value="<?php if (isset($productCode)){ echo $productCode;} ?>" placeholder="P45MOUSE">
        <span class="red mar-btm">
            <?php
            //Display error if one exists
            if (isset($errorPc)){
               echo $errorPc; 
            }
            ?>
        </span>

        <label>First Name: <span class="red">*</span></label>
        <input class="center" type="text" name="fName" value="<?php if (isset($firstName)){ echo $firstName;} ?>" placeholder="John">
        <span class="red mar-btm">
            <?php
            //Display error if one exists
            if (isset($errorFn)){
               echo $errorFn; 
            }
            ?>
        </span>

        <label>Last Name: <span class="red">*</span></label>
        <input class="center" type="text" name="lName" value="<?php if (isset($lastName)){ echo $lastName;} ?>" placeholder="Green">
        <span class="red mar-btm">
            <?php
            //Display error if one exists
            if (isset($errorLn)){
               echo $errorLn; 
            }
            ?>
        </span>

        <label>City: <span class="red">*</span></label>
        <input class="center" type="text" name="city" value="<?php if (isset($city)){ echo $city;} ?>" placeholder="Montreal">
        <span class="red mar-btm">
            <?php
            //Display error if one exists
            if (isset($errorCity)){
               echo $errorCity; 
            }
            ?>
        </span>

        <label>Comments:</label>
        <input class="center" type="text" name="comment" value="<?php if (isset($comment)){ echo $comment;} ?>" placeholder="10% discount">
        <span class="red mar-btm">
            <?php
            //Display error if one exists
            if (isset($errorComment)){
               echo $errorComment; 
            }
            ?>
        </span>

        <label>Price: <span class="red">*</span></label>
        <input class="center" type="text" name="price" value="<?php if (isset($price)){ echo $price;} ?>" placeholder="19.99">
         <span class="red mar-btm">
            <?php
            //Display error if one exists
            if (isset($errorPrice)){
               echo $errorPrice; 
            }
            ?>
        </span>

        <label>Quantity: <span class="red">*</span></label>
        <input class="center" type="text" name="quantity" value="<?php if (isset($quantity)){ echo $quantity;} ?>" placeholder="10">
        <span class="red mar-btm">
            <?php
            //Display error if one exists
            if (isset($errorQuantity)){
               echo $errorQuantity; 
            }
            ?>
        </span>
        <input class="btn-fnd-out bold" type="submit" value="Submit" name="buy"/>

    </form>
 <?php   
}

function orderComplete($total, $order){
    //Converting array to json
    $json_order = json_encode($order);
    //Opening purchase text file
    $myFile = fopen(ORDER_FOLDER . PURCHASES_FILE, "a") or die("The file couldnt be opened");
    //Saving array into text file
        for ($i = 0; $i < count($order); $i++)
        {
              fwrite($myFile, $order[$i] . "\r\n");  
        }
             fclose($myFile);
    ?>
    <!-- Displaying order total -->
    <div class="container center"> 
        <h1>Order successful thank you!</h1>
        <h2>Your total is: <span class="red bold"><?php echo $total;?>$</span></h2>
    </div>
    <?php  
}
