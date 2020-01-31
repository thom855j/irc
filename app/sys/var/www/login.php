<?php if(!Session::exists('auth')): ?>

<div id="wrapper">
    
    <?php include 'templates/nav.php' ?>  
    <p><?php echo getVisitorIP(), " connected to ", $_SERVER['SERVER_ADDR'], " on port ", $_SERVER['SERVER_PORT']; ?></p>
    <div id="terminal">
        <br>
        <p> Welcome to <?php echo $_SERVER['SERVER_NAME']; ?>.</p>
        <p>It is <?php echo date('H:i', time()), " on ", date('l, F d, Y'); ?>.</p>
        <?php if( Cookie::get('session_visit') ): ?>
        <p>Last visit: <?php echo Cookie::get('session_visit'); ?></p>
        <?php endif; ?>
        <br>
        <p>All connections are monitored and recorded.</p>
        <p>Any malicious and/or unauthorized activity is strictly forbidden.</p>
        <p>Disconnect IMMEDIATELY if you are not an authorized user!</p>
        <br>
    </div>
  
    <form name="message">
        <b>></b> <input name="input" type="text" id="input" size="1024" />
    </form>
</div>

<script type="text/javascript">
$(document).ready(function(){

    $("#input").focus();

    $("#input").inputhistory();

  
    //If user submits the form
    $("form").submit(function(e){

        e.preventDefault();

        var client = $("#input").val();
        var oldscrollHeight = $("#terminal").prop("scrollHeight") - 20; //Scroll height before the 

        $.ajax({
            type: "POST",
            url: "server.php?action=login",
            cache: false,
            data: {input: client},
            success: function(data){      

                if(data == 'ok') {

                    window.location = 'index.php?id=terminal';

                } else if (data == 'error') {

                    window.location = 'index.php?id=login';

                } else {

                    $("#terminal").append(data); //Insert chat log into the #terminal div  

                        //Auto-scroll           
                    var newscrollHeight = $("#terminal").prop("scrollHeight") - 20; //Scroll height after the request
                    if(newscrollHeight > oldscrollHeight){
                        $("#terminal").animate({ scrollTop: newscrollHeight }, 'normal'); //Autoscroll to bottom of div
                    } 
                }   
                              
            },
        });

         $("#input").prop("value", "");

        return false;

    });


}); 
</script>

<?php else:  header("Location: index.php?id=terminal"); ?>

<?php endif; ?>