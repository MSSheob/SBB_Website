function _elp_addnotification() {
	if(document.form_addnotification.elp_note_emailgroup.value=="") {
		alert(elp_notification_script.elp_notification_group);
		document.form_addnotification.elp_note_emailgroup.focus();
		return false;
	}
	else if(document.form_addnotification.elp_note_status.value=="") {
		alert(elp_notification_script.elp_notification_status);
		document.form_addnotification.elp_note_status.focus();
		return false;
	}
	else if(document.form_addnotification.elp_note_mailsubject.value=="") {
		alert(elp_notification_script.elp_notification_subject);
		document.form_addnotification.elp_note_mailsubject.focus();
		return false;
	}
}

function _elp_delete(id) {
	if(confirm(elp_notification_script.elp_notification_delete)){
		document.frm_elp_display.action="admin.php?page=elp-postnotification&ac=del&did="+id;
		document.frm_elp_display.submit();
	}
}

function _elp_redirect() {
	window.location = "admin.php?page=elp-postnotification";
}

function _elp_help() {
	window.open("http://www.gopiplus.com/work/2014/05/02/email-subscribers-wordpress-plugin/");
}

function _elp_delete_queue(guid) {
	if(confirm(elp_notification_script.elp_notification_delete)){
		document.frm_elp_display.action="admin.php?page=elp-postnotification&ac=queue&submitted=del&guid="+guid;
		document.frm_elp_display.submit();
	}
}

function _elp_release_queue(pid, guid) {
	if(confirm(elp_notification_script.elp_notification_release)){
		document.frm_elp_display.action="admin.php?page=elp-postnotification&ac=queue&submitted=rel&pid="+pid+"&guid="+guid;
		document.frm_elp_display.submit();
	}
}

function _elp_checkall(FormName, FieldName, CheckValue) {
	if(!document.forms[FormName])
		return;
	var objCheckBoxes = document.forms[FormName].elements[FieldName];
	if(!objCheckBoxes)
		return;
	var countCheckBoxes = objCheckBoxes.length;
	if(!countCheckBoxes)
		objCheckBoxes.checked = CheckValue;
	else
		// set the check value for all check boxes
		for(var i = 0; i < countCheckBoxes; i++)
			objCheckBoxes[i].checked = CheckValue;
}

function _elp_bulkaction() {
	if(confirm(elp_notification_script.elp_notification_deleteall)) {
		document.getElementById("frm_elp_bulkaction").value = 'delete';
		document.frm_elp_display.submit();
	}
	else {
		return false;
	}
}
