function _elp_help() {
	window.open("http://www.gopiplus.com/work/2014/03/28/wordpress-plugin-email-posts-to-subscribers/");
}

function _elp_cancel(action) {
	window.location = "admin.php?page=elp-options&tab=" + action;
}

function _elp_security_delete(id) {
	if(confirm(elp_options_script.elp_security_delete))
	{
		document.frm_elp_display.action="admin.php?page=elp-options&tab=security&ac=del&did="+id;
		document.frm_elp_display.submit();
	}
}

function _elp_submit_cron() {
	if(document.elp_form.elp_cron_mailcount.value == "") {
		alert(elp_options_script.elp_crondetails_number1)
		document.elp_form.elp_cron_mailcount.focus();
		return false;
	}
	else if(isNaN(document.elp_form.elp_cron_mailcount.value)) {
		alert(elp_options_script.elp_crondetails_number2)
		document.elp_form.elp_cron_mailcount.focus();
		return false;
	}
}

function _elp_submit_recaptcha() {
	if( document.elp_form.elp_captcha_widget.value=="YES" && document.elp_form.elp_captcha_sitekey.value=="" ) {
		alert(elp_options_script.elp_recaptcha_sitekey_add);
		document.elp_form.elp_captcha_sitekey.focus();
		return false;
	}
	else if( document.elp_form.elp_captcha_widget.value=="YES" && document.elp_form.elp_captcha_secret.value=="" ) {
		alert(elp_options_script.elp_recaptcha_secretkey_add);
		document.elp_form.elp_captcha_secret.focus();
		return false;
	}
	else if( document.elp_form.elp_captcha_widget.value=="YES" && document.elp_form.elp_captcha_sitekey.value.length<20 ) {
		alert(elp_options_script.elp_recaptcha_sitekey_add);
		document.elp_form.elp_captcha_sitekey.focus();
		return false;
	}
	else if( document.elp_form.elp_captcha_widget.value=="YES" && document.elp_form.elp_captcha_secret.value.length<20 ) {
		alert(elp_options_script.elp_recaptcha_secretkey_add);
		document.elp_form.elp_captcha_secret.focus();
		return false;
	}
}
