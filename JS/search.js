//Revision history:
//DEVELOPER          DATE            COMMENTS         
//Danial Gosse       2021-04-27      Created the page 
//    

function handleError(error)
{
 alert("An error occured in the js code" + error);   
}

function searchDate()
{

    try
    {
        
        //XHR VARIABLE
        var xhr = new XMLHttpRequest();
        
        xhr.onreadystatechange = function()
        { 
            if (xhr.readyState == 4 && xhr.status == 200)
            {
                document.getElementById('searchResults').innerHTML = xhr.responseText;
            }
        } 
        //say what page you want to open
        xhr.open("POST", "searchDate.php");
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        //Getting the username and year
        var searchedYear = document.getElementById("SearchYear").value;
        var username = document.getElementById("username").value;
        //send the values of year and the logged in users username
        xhr.send("year=" + searchedYear + "&username=" + username);
    }
    catch(error)
    {
        handle(error);
    }
}


