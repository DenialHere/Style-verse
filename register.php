<?php
#Revision history:
#DEVELOPER          DATE            COMMENTS         
#Danial Gosse       2021-04-23      Created the page
#
#                                   
#

      //Defining constants of folder/file locations
      define("FOLDER_PHP", "PHP/");
      define("FOLDER_CSS", "CSS/");

      define("FILE_PHP_FUNCTIONS", FOLDER_PHP . "PHP-functions.php");
      require_once FILE_PHP_FUNCTIONS;

      //Generating starting HTML
      generateHtml("Register", "style.css", "");
      //Once the registration is complete this value will be equal to true
      //and it will display a confirmation message + login form
      $registerComplete = false;
if (!isset($_SESSION["customer_uuid"])){

      if (isset(($_POST[REGISTER_BUTTON]))){
      //Declaring all variables and protecting them from html injection
            $firstName = htmlspecialchars (trim($_POST[FIRST_NAME_REGISTER]));
            $lastName = htmlspecialchars (trim($_POST[LAST_NAME_REGISTER]));
            $address = htmlspecialchars (trim($_POST[ADDRESS_REGISTER]));
            $city = htmlspecialchars (trim($_POST[CITY_REGISTER]));
            $province = htmlspecialchars (trim($_POST[PROVINCE_REGISTER]));
            $postalCode = htmlspecialchars (trim($_POST[POSTALCODE_REGISTER]));
            $username = htmlspecialchars (trim($_POST[USERNAME_REGISTER]));
            $password = htmlspecialchars (trim($_POST[PASSWORD_REGISTER]));
            $passwordVerify = htmlspecialchars (trim($_POST[PASSWORD_REGISTER_VERIFY]));
            //Setting error messages to empty
            $errorUserName = null;
            $errorPassword = null;
            $errorPasswordVerify = null;
            $errorFn = null;
            $errorLn = null;
            $errorAddress = null;
            $errorCity = null;
            $errorProvince = null;
            $errorPostal = null;


            
            //Performing validation
            //Username:
            if (mb_strlen($username) <= 0 || mb_strlen($username) > USERNAME_MAX_LENGTH){
                //Saving error message to be displayed later
                $errorUserName = "Your username cannot be empty and cannot be longer than 12 characters.";    
            }
            //Checking to see if the username already exists
            //Creating a new customer to test the username
            $customer = new customer();
            //Attempting to load the username
            $customer->setUserName($username);
            //if the username can be loaded throw an error message
            if ($customer->load($username)){
                //Saving error message to be displayed later
                $errorUserName = "This username is already taken.";
            }
            //Password
            if (mb_strlen($password) <= 0 || mb_strlen($password) > PASSWORD_MAX_LENGTH){
                //Saving error message to be displayed later
                $errorPassword = "Your password cannot be empty and cannot be longer than 255 characters.";
            }
            //Password verify
            if ($passwordVerify != $password || mb_strlen($passwordVerify) <= 0){
                //Saving error message to be displayed later
                $errorPasswordVerify = "Your password's must match and cannot be empty.";
            }
            //First name
            if (mb_strlen($firstName) <= 0 || mb_strlen($firstName) > NAME_MAX_LENGTH){
                //Saving error message to be displayed later
                $errorFn = "Your first name cannot be empty and cannot be longer than 20 characters.";
            }
            //Last name
            if (mb_strlen($lastName) <= 0 || mb_strlen($lastName) > NAME_MAX_LENGTH){
                //Saving error message to be displayed later
                $errorLn = "Your last name cannot be empty and cannot be longer than 20 characters.";
            }
            //Address
            if (mb_strlen($address) <= 0 || mb_strlen($address) > LOCALITY_MAX_LENGTH){
                //Saving error message to be displayed later
                $errorAddress = "Your address cannot be empty and cannot be longer than 25 characters.";
            }
            //City
            if (mb_strlen($city) <= 0 || mb_strlen($city) > LOCALITY_MAX_LENGTH){
                //Saving error message to be displayed later
                $errorCity = "Your city cannot be empty and cannot be longer than 25 characters.";
            }
            //Province
            if (mb_strlen($province) <= 0 || mb_strlen($province) > LOCALITY_MAX_LENGTH){
                //Saving error message to be displayed later
                $errorProvince = "Your province cannot be empty and cannot be longer than 25 characters.";
            }
            //Postal code
            if (mb_strlen($postalCode) != POSTAL_CODE_MAX_LENGTH){
                //Saving error message to be displayed later
                $errorPostal = "Your postal code must be 7 characters, (M7L 9L0) please include a space in the middle";
            }
            //If all the error messages are null then valadation has passed sucessfully
            if ($errorUserName == null && $errorPassword == null && $errorPasswordVerify == null && $errorFn == null 
                && $errorLn == null && $errorAddress == null && $errorCity == null && $errorProvince == null && $errorPostal == null)
                {
                 // if all validation passes create customer object
                $customer = new customer($firstName, $lastName, $address, $city, $province, $postalCode, $username, $password);
                //saving customer to the database
                $customer->save();
                $registerComplete = true;
                }
      }




?>
  
        <!-- Once the registration is complete display confirmation message  -->       
        <h1 class="center <?php if(isset($registerComplete) && $registerComplete == false) echo 'hide mar-btm'; ?>"> Registration successful.</h1>
        <h2 class="center <?php if(isset($registerComplete) && $registerComplete == false) echo 'hide mar-btm'; ?>"> Login above</h2>

        
    <form class="grid container-buy just-cent <?php if(isset($registerComplete) && $registerComplete == true) echo 'hide'; ?>"  method="post">
        <!-- Username  -->
        <label>Username: <span class="red">*</span></label>
        <input class="center" type="text" name="username" value="<?php if (isset($username)){ echo $username;} ?>" placeholder="John2021">
        <span class="red mar-btm">
            <?php
            //Display error if one exists
            if (isset($errorUserName)){
               echo $errorUserName; 
            }
            ?>
        </span>
        <!-- Password  -->
        <label>Password: <span class="red">*</span></label>
        <input class="center" type="password" name="password" value="<?php if (isset($password)){ echo $password;} ?>">
        <span class="red mar-btm">
            <?php
            //Display error if one exists
            if (isset($errorPassword)){
               echo $errorPassword; 
            }
            ?>
        </span>
        <!-- Password Verify  -->
        <label>Repeat password: <span class="red">*</span></label>
        <input class="center" type="password" name="passwordVerify" value="<?php if (isset($passwordVerify)){ echo $passwordVerify;} ?>">
        <span class="red mar-btm">
            <?php
            //Display error if one exists
            if (isset($errorPasswordVerify)){
               echo $errorPasswordVerify; 
            }
            ?>
        </span>
       <!-- First name  -->
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
        <!-- Last name  -->
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
        <!-- Address  -->
        <label>Address: <span class="red">*</span></label>
        <input class="center" type="text" name="address" value="<?php if (isset($address)){ echo $address;} ?>" placeholder="1200 Green ave">
        <span class="red mar-btm">
            <?php
            //Display error if one exists
            if (isset($errorAddress)){
               echo $errorAddress; 
            }
            ?>
        </span>
        <!-- City  -->
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
        <!-- Province  -->
        <label>Province: <span class="red">*</span></label>
        <input class="center" type="text" name="province" value="<?php if (isset($province)){ echo $province;} ?>" placeholder="Quebec">
        <span class="red mar-btm">
            <?php
            //Display error if one exists
            if (isset($errorProvince)){
               echo $errorProvince; 
            }
            ?>
        </span>
        <!-- Postal Code  -->
        <label>Postal code: <span class="red">*</span></label>
        <input class="center" type="text" name="postal" value="<?php if (isset($postalCode)){ echo $postalCode;} ?>" placeholder="H3N 4P8">
        <span class="red mar-btm">
            <?php
            //Display error if one exists
            if (isset($errorPostal)){
               echo $errorPostal; 
            }
            ?>
        </span>
        

        
        <input class="btn-fnd-out bold" type="submit" value="Register" name="register"/>

    </form>

<?php
}
else {
    ?>
        <h1 class="center mar-btm">Are you lost?</h1>
        <h2 class="center mar-btm">You're already logged in no need to register again.</h2>
    <?php
}     

//Ending html
      endHtml();
