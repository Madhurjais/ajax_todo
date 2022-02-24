<?php 
session_start();

function display_todo(){
   if(isset($_SESSION['incomplete'])){
       foreach($_SESSION['incomplete'] as $key => $val){
           echo "<li><input type = 'checkbox' name = 'check'></li>
           <label>".$val."</label>
        <button class='' id ='edit' data-edit=".$key."  name='editBtn'>Edit</button>
        <button class='' id='delete' data-delete=".$key."  name='detBtn'>delete</button>
        <input type='hidden' name='todoid' value=".$key." ></li>" ;

        
       }
   }
else{
    echo " " ;
}}
function displayComplete() {
    if (isset($_SESSION['complete'])) {
        foreach ($_SESSION['complete'] as $keys => $values) {
            echo "<li><input type = 'checkbox' name = 'check' checked></li>
           <label>".$values."</label>
        <button class='' id ='edit' data-edit=".$keys."  name='editBtn'>Edit</button>
        <button class='' id='delete' data-delete=".$keys."  name='detBtn'>delete</button>
        <input type='hidden' name='todoid' value=".$keys." ></li>" ;
        }
    }
else echo "";
}

if(isset($_POST['input'])){
    
        if (isset($_SESSION['incomplete'])){
            array_push($_SESSION['incomplete'], $_POST['input']);
        }
        else{
            $_SESSION['incomplete'] = array($_POST['input']);
        }
        
        echo json_encode($_SESSION['incomplete']);
       }
if(isset($_POST['editBtn'])){
    // $val = $_POST['editBtn'];
    // foreach($_SESSION['incomplete'] as $key => $val){
    //     if()
    // }
    echo json_encode($_SESSION['incomplete']);

}
if(isset($_POST['new_val'])){
    if(isset($_SESSION['incomplete'])){
        foreach($_SESSION['incomplete'] as $key => $val){
            if($key == $_POST['update_id']){
                $_SESSION['incomplete'][$key] = $_POST['new_val'];
            }
        }
        echo json_encode($_SESSION['incomplete']);
    }
}
if(isset($_POST['del_Btn'])){
    if(isset($_SESSION['incomplete'])){
        array_splice($_SESSION['incomplete'],$_POST['del_Btn'],1);
        echo json_encode($_SESSION['incomplete']);
    }
}
if(isset($_POST['checked'])){
        $_SESSION['temp'] = $_SESSION['incomplete'][$_POST['checked']] ; 
        array_splice($_SESSION['incomplete'],$_POST['checked'],1);
        if(isset($_SESSION['complete'])){
        array_push($_SESSION['complete'],$_SESSION['temp']);
        
    }
    else{
        $_SESSION['complete'] = array($_SESSION['temp']);
    }
    $myArr=array();
    $myArr['incomplete'] = $_SESSION['incomplete'];
    $myArr['complete'] = $_SESSION['complete'];
    echo json_encode($myArr);


}
if(isset($_POST['unchecked'])){
    $_SESSION['temp'] = $_SESSION['complete'][$_POST['unchecked']] ; 
    array_splice($_SESSION['complete'],$_POST['unchecked'],1);
    if(isset($_SESSION['incomplete'])){
    array_push($_SESSION['incomplete'],$_SESSION['temp']);
    
}
else{
    $_SESSION['incomplete'] = array($_SESSION['temp']);
}
$myArr=array();
$myArr['incomplete'] = $_SESSION['incomplete'];
$myArr['complete'] = $_SESSION['complete'];
echo json_encode($myArr);
}
?>