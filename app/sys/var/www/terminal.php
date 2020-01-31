<?php if(Session::exists('auth')): ?>

<div id="wrapper">
    
    <?php include 'templates/nav.php' ?>   
  
    <div id="terminal"><?php echo('Please wait... type "/help" for commands.'); ?></div>
  
    <form name="message">
        <b><?php echo(Session::get('channel')); ?>@<?php echo(Session::get('nickname')); ?> ></b> <input name="input" type="text" id="input" size="1024" />
    </form>
</div>

<script type="text/javascript">
$(document).ready(function(){

    $("#input").focus();

    $("#input").inputhistory();

    //If user wants to end session
    $("#exit").click(function(){
        var exit = confirm("Are you sure you want to disconnect from session?");
        if(exit==true){window.location = 'server.php?action=logout'}      
    });


    //If user submits the form
    $("form").submit(function(e){   

        e.preventDefault();

        var client = $("#input").val();

        // Secret exit...
        if(client == '/quit' || client == '/part') {
           window.location = 'server.php?action=logout';
           return false;
        }

        $.post("server.php?action=input", {input: client});  

        $("#input").prop("value", "");

        return false;
    });


    //Load the file containing the terminal log
    function loadLog(){     
        var oldscrollHeight = $("#terminal").prop("scrollHeight") - 20; //Scroll height before the request
        $.ajax({
            type: "GET",
            url: "server.php?action=request",
            cache: false,
            success: function(data){     

                $("#terminal").html(data); //Insert chat log into the #terminal div   
                
                //Auto-scroll           
                var newscrollHeight = $("#terminal").prop("scrollHeight") - 20; //Scroll height after the request
                if(newscrollHeight > oldscrollHeight){
                    $("#terminal").animate({ scrollTop: newscrollHeight }, 'normal'); //Autoscroll to bottom of div
                }               
            },
        });
    }

   setInterval(loadLog, 2500); //Reload file every 2500 ms or x ms if you wish to change


}); 
</script>

<?php else:  header("Location: index.php?id=login"); ?>

<?php endif; ?>
