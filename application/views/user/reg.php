<h2>注册</h2>

<?php echo validation_errors(); ?>

<?php echo form_open('user/reg') ?>

  <label for="email" class="required">Email</label> 
  <input type="input" name="email"><br>

  <label for="password" class="required">密码</label> 
  <input type="password" name="password"><br>

  <label for="username" class="required">用户名</label> 
  <input type="input" name="username"><br>
  
  <input type="submit" name="submit" value="注册"> 

</form>
