<?php
#Revision history:
#DEVELOPER          DATE            COMMENTS         
#Danial Gosse       2021-02-14      Created constants for folders + generated 
#                                   HTML + tested ad functionality.
#Danial Gosse       2021-02-15      Created main container for index + removed
#                                   ad testing.
#Danial Gosse       2021-03-10      Updated generate html function to support
#                                   new argument
#Danial Gosse       2021-04-21      Added requirements for customer objects
#
#
#Danial Gosse       2021-05-02      Added a download to my cheat sheet
#                        
      //Defining constants of folder/file locations
      define("FOLDER_PHP", "PHP/");
      define("FOLDER_CSS", "CSS/");


      define("FILE_PHP_FUNCTIONS", FOLDER_PHP . "PHP-functions.php");
      require_once FILE_PHP_FUNCTIONS;
      
      //Generating starting HTML
      generateHtml("Index", "style.css", "");
//      $cust = new customer("Danny", "Dagoat", "87162", "Montreal", "Qubek", "h3n 2c5", "Dania00", "gooose");
//      $cust->save();
//        $cust2 = new customer();
//        $cust2->load("Dania00");
//        echo $cust2->getPassword();

      
?>

    <div class="container grid just-cent">
        <img class="fashion"  src="images/kanye_fashion.jpg" alt="Fashion model"/>
        <div class="inner">
            <h1>"Modern clothing for the modern person"</h1>
            <p class="center">-Forbes</p>
                <form class="center">
                    <a href="home.php"><input class="btn-fnd-out bold" type="button" value="Find out what makes us unique"></a>
                </form>
            <a href="CheatSheet.txt" download> Download cheat sheet </a> 
        </div>
    </div>

<?php

      //Generating ending HTML
      endHtml();
?>
