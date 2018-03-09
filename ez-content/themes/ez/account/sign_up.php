	<div id="main" class="container">
    <div class="row">

		<?php if (! ($this->config->item("sign_up_enabled"))): ?>
			<div class="col-md-12">
				<h3><?php echo lang('sign_up_heading'); ?></h3>

				<div class="alert">
					<strong><?php echo lang('sign_up_notice'); ?> </strong> <?php echo lang('sign_up_registration_disabled'); ?>
				</div>
			</div>
		<?php endif;?>

		<?php if ($this->config->item("sign_up_enabled")): ?>
			<div class="col-md-6 col-md-offset-3">

				<?php echo form_open(uri_string(), 'class="form-horizontal"'); ?>
				<?php echo form_fieldset(); ?>
				<h3 class="text-center"><?php echo lang('sign_up_heading'); ?></h3>

				<div class="well">

					<div class="form-group <?php echo (form_error('sign_up_username') || isset($sign_up_username_error)) ? 'error' : ''; ?>">
						<label class="control-label col-md-3" for="sign_up_username"><?php echo lang('sign_up_username'); ?></label>

						<div class="col-md-9">
							<?php echo form_input(array('class' => 'form-control','name' => 'sign_up_username', 'id' => 'sign_up_username', 'value' => set_value('sign_up_username'), 'maxlength' => '24')); ?>
							<?php if (form_error('sign_up_username') || isset($sign_up_username_error)) : ?>
								<span class="help-inline">
								<?php echo form_error('sign_up_username'); ?>
								<?php if (isset($sign_up_username_error)) : ?>
									<span class="field_error"><?php echo $sign_up_username_error; ?></span>
								<?php endif; ?>
								</span>
							<?php endif; ?>
						</div>
					</div>

					<div class="form-group <?php echo (form_error('sign_up_password')) ? 'error' : ''; ?>">
						<label class="control-label col-md-3" for="sign_up_password"><?php echo lang('sign_up_password'); ?></label>

						<div class="col-md-9">
							<?php echo form_password(array('class' => 'form-control','name' => 'sign_up_password', 'id' => 'sign_up_password', 'value' => set_value('sign_up_password'))); ?>
							<?php if (form_error('sign_up_password')) : ?>
								<span class="help-inline">
								<?php echo form_error('sign_up_password'); ?>
								</span>
							<?php endif; ?>
						</div>
					</div>

					<div class="form-group <?php echo (form_error('sign_up_email') || isset($sign_up_email_error)) ? 'error' : ''; ?>">
						<label class="control-label col-md-3" for="sign_up_email"><?php echo lang('sign_up_email'); ?></label>

						<div class="col-md-9">
							<?php echo form_input(array('class' => 'form-control','name' => 'sign_up_email', 'id' => 'sign_up_email', 'value' => set_value('sign_up_email'), 'maxlength' => '160')); ?>
							<?php if (form_error('sign_up_email') || isset($sign_up_email_error)) : ?>
								<span class="help-inline">
								<?php echo form_error('sign_up_email'); ?>
								<?php if (isset($sign_up_email_error)) : ?>
									<span class="field_error"><?php echo $sign_up_email_error; ?></span>
								<?php endif; ?>
								</span>
							<?php endif; ?>
						</div>
					</div>

					<?php if (isset($recaptcha)) :
						echo $recaptcha;
						if (isset($sign_up_recaptcha_error)) : ?>
							<span class="field_error"><?php echo $sign_up_recaptcha_error; ?></span>
						<?php endif; ?>
					<?php endif; ?>

					<div>
						<?php echo form_button(array('type' => 'submit', 'class' => 'btn btn-large btn-success pull-right', 'content' => '<i class="icon-pencil"></i> '.lang('sign_up_create_my_account'))); ?>
					</div>
					<br/>

					<p><?php echo lang('sign_up_already_have_account'); ?> <?php echo anchor('account/sign_in', lang('sign_up_sign_in_now')); ?></p>
				</div>

				<?php echo form_fieldset_close(); ?>
				<?php echo form_close(); ?>

			</div>
		<?php endif;?>
    </div>
</div>