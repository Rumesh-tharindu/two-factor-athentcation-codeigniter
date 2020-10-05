<html>
<head>
    <title>Complete User Registration and Login System in Codeigniter</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <br />
        <h3 align="center">Complete User Registration and Login System in Codeigniter</h3>
        <br />
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
         Login
       </button>
       <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">LOGIN</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <div class="panel panel-default">
            <div class="panel-heading">Login</div>
            <div class="panel-body">
                <div id="msg"></div>
                <form method="post" action="<?php echo base_url(); ?>login/validation" id="loginForm">
                    <div class="form-group">
                        <label>Enter Email Address</label>
                        <input type="text" name="user_name" id="user_name" class="form-control" value="<?php echo set_value('user_email'); ?>" />
                        
                    </div>
                    <div class="form-group">
                        <label>Enter Password</label>
                        <input type="password" name="user_password" id="user_password" class="form-control" value="<?php echo set_value('user_password'); ?>" />
                       
                    </div>
                    <div class="form-group">
                        <input type="submit" name="login" value="Login" class="btn btn-info" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="<?php echo base_url(); ?>register">Register</a>
                    </div>
                </form>
            </div>
        </div>
      </div>
      
    </div>
  </div>
</div>


       
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

    <script>
    $('document').ready(function(){
       $("#loginForm").on('submit',function(e){
           e.preventDefault();
           let form =$(this)

           $.ajax({
               url:form.attr('action'),
               type:form.attr('method'),
               data:form.serialize(),
               dataType:'json',
               success:function(response){
                   
                   console.log(response)
                  if(response.success==true){
                      window.location.href=response.redirect_url
                  }
                  else if(response.success==false){
                      
                      $('#msg').addClass('has-error')
                      $('#msg').html('your email or password is incorrect')
                  }
                  if(response.messages instanceof Object){
                     $.each(response.messages,function(index,value){
                           let id=$('#'+index)
                           console.log(value)
                           id
                           .closest('.form-group')
                           .removeClass('has-error')
                           .removeClass('has-success')
                           .addClass(value.length > 0 ? 'has-error' : 'has-success')
                           .after(value);
                     })
                  }
               }
           })
         
       })
    })
    </script>
</body>
</html>
