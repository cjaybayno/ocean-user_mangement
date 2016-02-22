/* ========================================================================
 *  Autoload Function
 * ======================================================================== */
	clearInputs();

/* ========================================================================
 *  List of Helper Function and Variable
 * ======================================================================== */
 
/* === loading bar function === */ 		
function loadingBar(selector, text) {
	text = typeof text !== 'undefined' ? text : 'Loading....';
	$(selector).empty().html('\
		<div class="progress active">\
			<div class="progress-bar progress-bar-success progress-bar-striped" role="progressbar" style="width: 100%"></div>\
		</div>'
	);	
	$('.generic-modal-title').empty().html(text);
	$('.load-bar-notif').empty().html(text);
}

/* === close loading bar function === */ 	
function loadingBarClose(selector) {
	$('.generic-modal-title, '+selector).empty();
}

/* === loding modal function === */
function loadingModal(operate, text, selector) {
	var modalSelector = $('#generic-modal');
	var selector 	  = typeof selector !== 'undefined' ? selector : '#generic-modal-alert';
	var text 		  = typeof text !== 'undefined' ? text : '';
	
	if (operate == 'show') {
		modalSelector.modal(operate);
		loadingBar(selector, text);
	} else if (operate == 'close'){
		modalSelector.modal('hide');
	} else {
		alert('LoadingModal function: undefined first parameter. ');
	}
}

/* === Clear all inputs of a page === */ 	
function clearInputs() {
	$('.clear-btn').click(function(){
		$('input:visible:enabled:not([readonly]), textarea:visible:enabled:not([readonly])').each(function() {
			$(this).val('');
		});
		return false;
	});
}

/* === Delete Button Handler === */
function clickConfirmBtnDeleteBtnHandler(id, selector, controller) {
	loadingBar('#delete-'+selector+'-result-'+id, 'Deletion in proccess...');
	$('#delete-'+selector+'-close-'+id).hide();
	$('#delete-'+selector+'-confirm-'+id).hide();
	
	$.ajax({url: url+"/"+controller+"/delete/"+id,
		dataType: "json",
		success: function(result) {
			$('#delete-'+selector+'-result-'+id).html('\
				<div class="alert alert-success">\
					<i><center>'+result.message+'</center></i>\
				</div>');
			$('#delete-'+selector+'-confirm-'+id).hide();
			$('#delete-'+selector+'-close-after-'+id).show();
		}
	});
}

/* === Click close Button after success deletion === */
function clickCloseBtnAfterDeleteHandler(controller) {
	location.reload();
}

/* === ajax CSRF-Token === */
function ajaxCsrfToken() {
	$.ajaxSetup({
	   headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
	});
}

/* === add two Zero === */
function addTwoZero(num) {
	return num.toFixed(2);
}

/* === add comma every 3 digit === */
function digits(num){ 
    return num.replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,"); 
}

/* === Date Format === */
function dateFormatter($timestamp) {
	var d      = new Date($timestamp);
	var days   = ["Sun","Mon","Tue","Wed","Thu","Fri","Sat"];
	var months = ["Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec"];
	return days[d.getDay()]+' '+d.getDate()+' '+months[d.getMonth()]+', '+d.getFullYear();
}

/* === remove error highlights === */
function removeInputErrors() {
	$('.form-group').removeClass('has-error');
	$('.error').empty();
}

/* === show error highlights === */
function errorLabel(message) {
	return '<label class="control-label">\
				<i class="fa fa-times-circle-o"></i> '+message+'</label>'
}

/* === show success message === */
function notifier(alertNotif, selector, message) {
	$(selector).empty().html(''+
		'<div class="col-xs-12">'+
			'<div class="alert alert-'+alertNotif+'">'+
				'<i><center>'+message+'</center></i>'+
			'</div>'+
		'</div><br><br>');
}

/* === add Edit button in === */
function editBtn(url) {
	$('#edit-btn').empty().html(
		'<a href="'+url+'">\
			<button class="btn btn-block btn-sm btn-info pull-right">\
				<i class="fa fa-edit"></i> Edit\
			</button>\
		</a>'
	);
}

/* === add Edit button === */
function addBtn(url) {
	$('#add-btn').empty().html(
		'<a href="'+url+'">\
			<button type="button" class="btn btn-block btn-sm btn-primary"><i class="fa fa-plus-circle"></i> New user</button>\
		</a>'
	);
}