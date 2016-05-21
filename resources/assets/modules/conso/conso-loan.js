/* ========================================================================
 *  Initialize Pages
 * ======================================================================== */
	var table;
	$(initialPages);
/* ========================================================================
 *  Major function
 * ======================================================================== */
 
	/* ==== function to init this page === */
	function initialPages($) {
		$('.select2').select2();
		datePicker('#date_range');
		onChangeLoanTypeHandler();
		dateRangeHandler();
	}
	
	function datePicker(selector) {
		/* === default date in input === */
		$(selector).val( moment().subtract(1, 'M').format('MM/DD/YYYY')+' - '+moment().format('MM/DD/YYYY') );
		$(selector).daterangepicker({
			maxDate : moment(), 
			calender_style : "picker_3",
			ranges: {
			   '1 Day': [moment().subtract(1, 'd'), moment()],
			   'last 7 Days': [moment().subtract(1, 'w'), moment()],
			   'last 30 Days': [moment().subtract(1, 'M'), moment()],
			   'last 3 Months': [moment().subtract(3, 'M'), moment()],
			   'last 6 Months': [moment().subtract(6, 'M'), moment()],
			   'last 1 Year': [moment().subtract(1, 'y'), moment()],
			},
		});
	}
	
	function onChangeLoanTypeHandler() {
		$('#loan_type').change(function() {
			$(this).attr('disabled', true);
			getLoanTypeName();
		});
	}
	
	function dateRangeHandler() {
		var clickFlag = false;
		$('.daterangepicker').click(function() {
			clickFlag = true;
			$('.ranges').hide();
		});
		
		$('#date_range').click(function() {
			if (clickFlag) {
				$('.daterangepicker').css("display","none");
			}
		})
	}
	
	function getLoanTypeName() {
		var headerTitleSelector    = $('#header-title');
		var consoLoanTableSelector = $('#conso-loan-table');
		var loanTypeSelector	   = $('#loan_type');
		if(loanTypeSelector.val() != '')  {
			consoLoanTableSelector.show(); 
			ajaxCsrfToken();
			$.ajax({
				url: url+'/conso/loan/get-params',
				data: {loan_product_id : loanTypeSelector.val()},
				dataType: 'json',
				success: function(result) {
					headerTitleSelector.empty().html('Consolidated '+result.product_name);
					dataTables(result.product_name, result.entity_code);
					table.ajax.reload();						
				}
			});
		}
	}
	
	function dataTables(productName, CompanyName) {
		var headerTitle = CompanyName;
		
		var printCustomMessage;
		printCustomMessage = '<h3>Consolidated '+productName+'</h3>';
		printCustomMessage += '<h4>From &nbsp'+$('[name=daterangepicker_start]').val()+'</h4>';
		printCustomMessage += '<h4>To &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp'+$('[name=daterangepicker_end]').val()+'</h4>';
		
		var pdfCustomMessage;
		pdfCustomMessage = 'Consolidated '+productName+'\n';
		pdfCustomMessage += 'From '+$('[name=daterangepicker_start]').val()+'\n';
		pdfCustomMessage += 'To   '+$('[name=daterangepicker_end]').val();
		
		var customFileName;
		var fromDate = moment($('[name=daterangepicker_start]').val()).format('YYYYMMDD');
		var toDate   = moment($('[name=daterangepicker_end]').val()).format('YYYYMMDD');
		customFileName = productName+'_'+fromDate+'-'+toDate;
		
		table = $('#conso-loan-table').DataTable({
			 dom: 'Bfrtip',
			buttons: [
				'copy', 
				{
					extend   : 'csv',
					filename : customFileName,
					footer   : true,
				},
				{
					extend   : 'excel',
					filename : customFileName,
					footer   : true,
				},
				{
					extend   : 'pdf',
					message  : pdfCustomMessage,
					filename : customFileName,
					title    : headerTitle,
					footer   : true,
				},
				{
					extend  : 'print',
					message : printCustomMessage,
					title   : headerTitle,
					footer  : true,
				}, 
			],
			
			paging  : false,
			bFilter : true,
			columns : [
				{"searchable" : true},
				{"searchable" : false},
				{"searchable" : false},
				{"searchable" : false},
			],
			oLanguage : {
				"sSearch": "Member "
			},
			responsive: true,
			processing: true,
			serverSide: true,
			bRetrieve : true,
			ajax: {
				url: url+'/conso/loan/paginate-conso',
				data : function (d) {
					d.loan_product_id = $('#loan_type').val();
					d.from_date       = $('[name=daterangepicker_start]').val();
					d.to_date         = $('[name=daterangepicker_end]').val();
				},
				complete : function (result) {
					$('.number-format').number(true, 2);
				}
			},
			fnRowCallback: function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {
				$('td:eq(1)', nRow).addClass('number-format');
				$('td:eq(2)', nRow).addClass('number-format');
				$('td:eq(3)', nRow).addClass('number-format');
			},
			fnFooterCallback: function(nRow, aaData, iStart, iEnd, aiDisplay) {
				var api = this.api();
				var size = 0;
				var totalRelease   = 0;
				var totalCollected = 0;
				var remainBalance  = 0;
				aaData.forEach(function(data) {
					totalRelease   += data[1];
					totalCollected += data[2];
					remainBalance  += data[3];
				});
				$(api.column(1).footer()).html('PHP '+$.number(totalRelease, 2 ));
				$(api.column(2).footer()).html('PHP '+$.number(totalCollected, 2));
				$(api.column(3).footer()).html('PHP '+$.number(remainBalance, 2));
			}
		});
	}