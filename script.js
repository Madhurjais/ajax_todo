$(document).ready(function(){
    $(".para").on('click',"#addbtn",function(){
        $.ajax({
            'method':"POST",
            'url':'function.php',
            'data':{'input': $('#new-task').val()},
            datatype : "JSON" 
        }).done(function(data){
            parse_data = $.parseJSON(data);
            display_todo(parse_data);
        })
    })
});
$(document).ready(function(){
    $("#incomplete-tasks").on('click',"#edit",function(){
        var index = $(this).data('edit');
        $.ajax({
            'method':"POST",
            'url':'function.php',
            'data':{'editBtn': $(this).data('edit')},
            datatype : "JSON" 
        }).done(function(data){
            parse_data = $.parseJSON(data);
            // var text = '';
            text = '<input id="new-task" type="text">\
            <button id="updatebtn" data-pid='+index+'>Update</button>' ;

            $(".para").html(text);
            $("#new-task").val(parse_data[index]);
            $("#addbtn").hide();
            $("#updatebtn").show();
            display_todo(parse_data);
        })
    })
})
$(document).ready(function(){
    $(".para").on('click','#updatebtn',function(){
        $("#addbtn").show();
        $("#updatebtn").hide(); 
        $.ajax({
            'method':"POST",
            'url' : "function.php",
            'data': {'update_id':$(this).data('pid'), "new_val":$('#new-task').val()},
            datatype : "JSON" 

        }).done(function(data){
            console.log(data);
            parse_data = $.parseJSON(data);
            display_todo(parse_data);
        })
    });
     
})
$(document).ready(function(){
    $("#incomplete-tasks").on('click',"#delete",function(){
        var index = $(this).data('delete');
        $.ajax({
            'method':"POST",
            'url':'function.php',
            'data':{'del_Btn': $(this).data('delete')},
            datatype : "JSON" 
        }).done(function(data){
            parse_data = $.parseJSON(data);
            display_todo(parse_data);
        })
});
});
$(document).ready(function(){
    $('#incomplete-tasks').on('change','#check',function(){
        $.ajax({
            'url':'function.php',
            'method':'POST',
            'data':{'checked':$(this).data('checkid'),'con':$("#content").val()},
            datatype:'JSON'
        }).done(function(data){
            console.log(data);
            d=$.parseJSON(data);
            display_todo(d['incomplete']);
            displaycomplete(d['complete']);
        })
    })
})
$(document).ready(function(){
     $('#completed-tasks').on('change','#complete_check',function(){
         $.ajax({
            'url':'function.php',
            'method':'POST',
            'data':{
                'unchecked': $(this).data('uncheckid')
            },
            datatype : "JSON" ,
         }).done(function(data){
            d=$.parseJSON(data);
            display_todo(d['incomplete']);
            displaycomplete(d['complete']);
         })
     })

     
})
function display_todo(data){
    var temp = "";
    for(var i = 0 ; i < data.length ; i++){
        temp += "<li><input type = 'checkbox' data-checkid = "+i+" name = 'check' id = 'check'>\
        <label id = 'content'>"+data[i]+"</label>\
        <button class='' id ='edit' data-edit="+i+" name='editBtn'>Edit</button>\
        <button class='' id='delete' data-delete="+i+" name='delBtn'>delete</button>\
        <input type='hidden' name='todoid' value="+i+" ></li>"
    }
    $('#incomplete-tasks').html(temp);

}
function displaycomplete(data){
var temp = "";
for(var i =0 ; i < data.length ; i++){
    temp += "<li><input type = 'checkbox' data-uncheckid = "+i+" checked name = 'check' id = 'complete_check'>\
    <label>"+data[i]+"</label><input type='text'><button class='edit' id='edit1' data-i="+i+" name='editBtn'>Edit</button>\
    <button data-index1="+i+" class='delete' id='delete1' name='deleteBtn'>Delete</button></li>\
    <input type='text' hidden name='myVal' value='"+i+"' >" 
}
$('#completed-tasks').html(temp);
}