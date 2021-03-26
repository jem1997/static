<?php

/**
 * User Login Form
 *
 * @package bbPress
 * @subpackage Theme
 */

// Exit if accessed directly
defined( 'ABSPATH' ) || exit;

?>
<!--
<form method="post" action="<?php bbp_wp_login_action( array( 'context' => 'login_post' ) ); ?>" class="bbp-login-form">
	<fieldset class="bbp-form">
		<legend><?php esc_html_e( 'Log In', 'bbpress' ); ?></legend>

		<div class="bbp-username">
			<label for="user_login"><?php esc_html_e( 'Username', 'bbpress' ); ?>: </label>
			<input type="text" name="log" value="<?php bbp_sanitize_val( 'user_login', 'text' ); ?>" size="20" maxlength="100" id="user_login" autocomplete="off" />
		</div>

		<div class="bbp-password">
			<label for="user_pass"><?php esc_html_e( 'Password', 'bbpress' ); ?>: </label>
			<input type="password" name="pwd" value="<?php bbp_sanitize_val( 'user_pass', 'password' ); ?>" size="20" id="user_pass" autocomplete="off" />
		</div>

		<div class="bbp-remember-me">
			<input type="checkbox" name="rememberme" value="forever" <?php checked( bbp_get_sanitize_val( 'rememberme', 'checkbox' ) ); ?> id="rememberme" />
			<label for="rememberme"><?php esc_html_e( 'Keep me signed in', 'bbpress' ); ?></label>
		</div>

		<?php do_action( 'login_form' ); ?>

		<div class="bbp-submit-wrapper">

			<button type="submit" name="user-submit" id="user-submit" class="button submit user-submit"><?php esc_html_e( 'Log In', 'bbpress' ); ?></button>

			<?php bbp_user_login_fields(); ?>

		</div>
	</fieldset>
</form>
-->

<style>
	aaa{
	text-decoration: underline;
    color: #45B6F7;
	}	  
</style>
<div align= "center" class="article-contente">
	    
			<?php
		  $current_user =  wp_get_current_user();
    if($current_user->ID){
        ob_start();
        wp_editor( '', 'editor-answer', forum_editor_settings(array('textarea_name'=>'answer')) );
        $editor_contents = ob_get_clean();
        $answer_html = '<form id="as-form" class="as-form" action="" method="post" enctype="multipart/form-data">
                    <h3 class="as-form-title">我来回复</h3>
                    '.$editor_contents.'
                    <input type="hidden" name="id" value="'.$question->ID.'">
                    <div class="as-submit clearfix">
                        <div class="pull-right"><input class="btn-submit" type="submit" value="提 交"></div>
                    </div>
                </form>';
    }else{
        $answer_html = '<div class="as-login-notice">请 <a href="javascript:;" style=" text-decoration: underline; color: #45B6F7;" class="user-reg" data-sign="0">登录</a> 或 <a href="javascript:;"      style=" text-decoration: underline; color: #45B6F7;"   class="user-reg" data-sign="1">注册</a> 后回复</div>';
    }
    
    $html .= $answer_html.'</div></div>';
    echo $html;
		?>
		</div>

