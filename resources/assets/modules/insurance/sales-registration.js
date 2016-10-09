/* ========================================================================
 *  Initialize Pages
 * ======================================================================== */
	$(initialPages);

/* ========================================================================
 *  Major function
 * ======================================================================== */
 
	/* ==== function to init this page === */
	function initialPages($) {
		$('.select2').select2();
		form();
		birthDateHandler();
	}
	
	function birthDateHandler() {
		var selector = "#birth_date";
		$(selector).daterangepicker({
			singleDatePicker : true,
			calender_style : "picker_2",
			showDropdowns: true,
			startDate : moment().format('MM/DD/YYYY'),
			maxDate :  moment().format('MM/DD/YYYY'),
		});
	}
	
	function form() {
		$('#wizard').smartWizard({
			labelFinish:'Save',
			hideButtonsOnDisabled: true,
			onShowStep: function () {
				scrollTop();
			},
			onFinish: function () {
				alert('tapus na');
				$('#wizard').smartWizard('setError',{stepnum:1,iserror:true});
				$('#wizard').smartWizard('showMessage','Please correct the errors in the steps and continue');
			}
		});

		function onFinishCallback() {
			$('#wizard').smartWizard('showMessage', 'Finish Clicked');
		}
		
		function setError(stepnumber){
			$('#wizard').smartWizard('setError',{stepnum:1, iserror:true});
		}
	}