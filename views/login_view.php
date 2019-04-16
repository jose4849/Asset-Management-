<html>
<head>
<style>
body{ font-family:arial;}
table{ width:30%; background: #EEEEEE; margin:0px auto;margin-top:170px;}
.login-form .input-group-addon {
   
    border: medium none;
    border-radius: 0;
    color: #8b9199;
    font-size: 16px;
    font-weight: normal;
    line-height: 1;
    padding: 6px 12px;
    text-align: center;
}
td{ text-align:center;height:40px;}
input{ width:80%; height:30px;}
.input-group-addon:last-child {
    border-left: 0 none;
}
.input-group .form-control:last-child, .input-group-addon:last-child, .input-group-btn:last-child > .btn, .input-group-btn:last-child > .dropdown-toggle, .input-group-btn:first-child > .btn:not(:first-child) {
    border-bottom-left-radius: 0;
    border-top-left-radius: 0;
}
.input-group-addon:first-child {
    border-right: 0 none;
}
.btn-block {
    display: block;
    padding-left: 0;
    padding-right: 0;
    width: 80%;
}
.btn-lg {
    border-radius: 6px;
    font-size: 18px;
    line-height: 1.33;
    padding: 10px 16px;
}
.btn-primary {
    background-color: #007aff;
    border-color: #007aff;
    color: #ffffff;
}
.btn {
    -moz-user-select: none;
    border: 1px solid transparent;
    border-radius: 4px;
    cursor: pointer;
    display: inline-block;
    font-size: 14px;
    font-weight: 300;
    line-height: 1.42857;
    margin-bottom: 0;
    padding: 6px 12px;
    text-align: center;
    transition: all 0.15s ease 0s;
    vertical-align: middle;
    white-space: nowrap;
}
</style>
</head>
<body>
<table border="0">
<?php
                $attributes = array('class' => 'login-form');
                echo form_open('verifylogin',$attributes);
        ?>
<tr>
<td><br>
<a class="logo" href="<?php echo base_url(); ?>"><img src="http://liongroupasset.com/logo2.png" style=" height: 61px; "></a>
<h1 style="text-transform :uppercase;">Lion Group</h1></td>
</tr>

<tr>
<td><input type="text" class="form-control" name="username" placeholder="Username" autofocus></td>
</tr>

<tr>
<td><input type="password" class="form-control" autocomplete="on" name="password" placeholder="Password"><br>
<div style="width: 100%; border: 0px solid red; font-size: 15px; margin-top: 5px; margin-bottom: 5px;"><input type="checkbox" style="width:10px;height:10px;" value="remember-me"> Remember me&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<span class="pull-right"> <a href="#"> Forgot Password?</a></span>
</div>
</td>
</tr>
<tr>
<td><button class="btn btn-primary btn-lg btn-block" type="submit">Login</button></td>
</tr>
<tr>
<td>&nbsp;</td>
</tr>
</table>
</form>
</body>
</html>