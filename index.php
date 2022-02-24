<?php 
session_start();
// session_destroy();
 include_once('function.php');  
?>
<html>
    <head>
        <title>TODO List</title>
        <link href="style.css" type="text/css" rel="stylesheet">
    </head>
    <body>
        <div class="container">
            <h2>TODO LIST</h2>
            <h3>Add Item</h3>
            <p class = "para">
                <input id="new-task" type="text" name = "input">
                <button id = 'addbtn'>add</button>
                <!-- <button id = 'updatebtn'>update</button> -->
            </p>
    
            <h3>Todo</h3>
            <ul id="incomplete-tasks">
            <?php display_todo(); ?>

                <!-- <li><input type="checkbox"><label>Pay Bills</label><input type="text"><button class="edit">Edit</button><button class="delete">Delete</button></li>
                <li><input type="checkbox"><label>Go Shopping</label><input type="text" value="Go Shopping"><button class="edit">Edit</button><button class="delete">Delete</button></li> -->
            </ul>
    
            <h3>Completed</h3>
            <ul id="completed-tasks">
            <?php displayComplete() ;?>
            </ul>
        </div>
    
    </body>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="script.js"></script>
</html>