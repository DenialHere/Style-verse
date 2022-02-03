<?php
#Revision history:
#DEVELOPER          DATE            COMMENTS         
#Danial Gosse       2021-03-04      Created the page + created system to display
#                                   all orders saved in text file
#Danial Gosse       2021-03-09      Added additonal comments
#Danial Gosse       2021-03-10      Added print & color functionality + fixed
#                                   malformed html
#Danial Gosse       2021-04-10      Fixed issue with $ not displaying on tax
#                                   column
#Danial Gosse       2021-04-26      Started reworking the order page
#
#Danial Gosse       2021-04-30      Finalized the order page
#
#Danial Gosse       2021-05-01      Commented code + added placeholder for date
#                                   + display login form if user is not logged in
#
      //Defining constants of folder/file locations
      define("FOLDER_PHP", "PHP/");
      define("FOLDER_CSS", "CSS/");

      define("FILE_PHP_FUNCTIONS", FOLDER_PHP . "PHP-functions.php");
      require_once FILE_PHP_FUNCTIONS;
      
      //Initializing variable that will be used to change opacity
      $opcacity = "";
      //If the command parameter is equal to print set opactity variable
      if (isset($_GET["command"]) && ($_GET["command"]) == 'print'){ 
            $opcacity = "opc";
            
         }
         
      //Generating starting HTML, opactity will be sent if print is chosen
      generateHtml("Orders", 'style.css', $opcacity);
      
//If the user is logged in display search form
if (isset(($_SESSION["customer_uuid"]))){
   ?> 
    <div class="center border mar-btm">
        <h2 class="center">Search for purchases:</h2>
        <h3 class="center">Search for purchases made on or before:</h3>   
        <input class="center" type="text"  id="SearchYear" name="SearchYear" placeholder="2021-05-01">
        <!--Saving the users username in a hidden input-->
        <input type="hidden" id="username" name="username" value="<?php echo $_SESSION["username"];?>">
        <br>
        <button class="btn-fnd-out bold center" onclick="searchDate();"> Search </button>
    </div> 
    <!--Container to hold the results-->
    <div class="center" id="searchResults">
                
    </div>
    <?php
    
}
//If the user isn't logged in display a login form
else {
    ?>
        <h1 class="center">Please login to see your orders</h1>
    <?php  
    generateLogin();
}
  
    if(isset($_POST["delete"]))
    {
    //Creating a new purchase object
    $purchase = new purchase();
    //Passing in the purchase_uuid from searchdate and deleting it
    $purchase->delete($_POST["purchaseUuid"]);
    }

//Closing the html
endHtml();