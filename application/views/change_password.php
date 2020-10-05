<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
</head>
<body>
    <h1 align="center">Change Password</h1>
    <div class="container">
     <?php
      echo $this->session->flashdata('message');
       
       
      ?>   
    <form action="<?php echo base_url()?>/change_password/change_pass" method="POST">
        <div class="form-group">
            <label for="">Current Password</label>
            <input type="text" name="current_pass" placeholder="current password" class="form-control">
            <?php echo form_error('current_pass')?>
        </div>
        <div class="form-group">
            <label for="">New Password</label>
            <input type="text"  name="new_pass" placeholder="New password" class="form-control">
            <?php echo form_error('new_pass')?>
        </div>
        <div class="form-group">
            <label for="">Confirm Password</label>
            <input type="text"  name="confirm_pass" placeholder="Confirm password" class="form-control">
            <?php echo form_error('confirm_pass')?>
        </div>
        <div class="form-group">
            
            <input type="submit" value="submit" class="form-control btn btn-primary">
            
        </div>
    </form>
</div>
</body>
</html>