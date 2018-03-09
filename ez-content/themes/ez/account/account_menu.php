<style type="text/css">
  .form-actions {
    margin-top: 15px;
  }
</style>
<ul class="nav nav-pills nav-stacked">
  <li class="<?php echo is_profile() ? 'active' : null; ?>"><?php echo anchor('account/profile', ez_line('profile')); ?></li>
  
  <li class="<?php echo is_account_settings() ? 'active' : null; ?>"><?php echo anchor('account/settings', ez_line('account_settings')); ?></li>
  
  <?php if ($account->password) : ?>
    <li class="<?php echo is_account_password() ? 'active' : null; ?>"><?php echo anchor('account/password', ez_line('password')); ?></li>
  <?php endif; ?>

    <li class="<?php echo ($current == 'sign_out') ? 'active' : null; ?>"><?php echo anchor('account/sign_out', ez_line('logout')); ?></li>
</ul>