<?php echo form_open('user/login', array('id' => 'u-login_form')) ?>

  <span class="logo-darwinassociation"></span><span class="logo-plantsearch"></span>
  
  <div id="u-valid_error">
<?php echo validation_errors(); ?>
  </div>

  <label for="email" class="u-email">
    <span>Email</span>
    <input type="input" name="email" id="email" placeholder="someone@example.com">
  </label><br>

  <label for="password" class="u-password">
    <span>密码</span>
    <input type="password" name="password" id="password" placeholder="密码">
  </label><br>

  <input id="u-login_submit" type="submit" name="submit" value="登录">

  <label class="u-long_login" for="long_login">
    <input name="long_login" id="long_login" type="checkbox" value="1">记住我
  </label><br>
  
  <span class="u-login_hint">无法登录？ <a href="">找回密码</a></span><br>
  <span class="u-login_hint">没有DA账号？ <a href="/user/reg">马上注册</a></span>

</form>
