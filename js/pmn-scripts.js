/*
 * Javascript for Administration Screens
 *
 * @package WordPress
 * @subpackage Plan My Novel Plugin
 * @author Jamel Cato
 * @since 1.0.0
 */

jQuery(document).ready(function($) {

	var lastTab = localStorage.getItem('lastTab');
	var lastLi = localStorage.getItem('lastLi');
	if(lastTab) {
		$(".tabs-menu li").removeClass("current");
		$(lastLi).addClass("current");
		$(".tab-content").not(lastTab).css("display", "none");
		$(lastTab).show(5);
	} else {
		$('#general-li').addClass("current");
	}
	/*--------------------------------------------------------------------------------------------------------------------*/
	if($('body').hasClass('post-type-pmn_character')) {
		var the_title = '';
		jQuery('*[data-iterator]').each(function(index) {
			the_title = jQuery(this).find('[id*=pmn_fld_character_title]').val();
			if(the_title) {
				jQuery(this).find('.cmb-group-title').text(the_title);
			} else {
				jQuery(this).find('.cmb-group-title').text('Unnamed Character ' + index);
			}
		});
	}
	/*--------------------------------------------------------------------------------------------------------------------*/
	if($('body').hasClass('post-type-pmn_character')) {
		jQuery('.protag-flag > input[type=checkbox]').each(function() {
			if(jQuery(this).is(':checked')) {
				jQuery(this).closest('.postbox').find('.cmb-group-title').css({
					"background-color": "#0073aa",
					"color": "white"
				})
			}
		});
	}
	/*--------------------------------------------------------------------------------------------------------------------*/
	if($('body').hasClass('post-type-pmn_outline')) {
		var the_title = '';
		jQuery('*[data-iterator]').each(function(index) {
			the_title = jQuery(this).find('[id*=pmn_fld_scene_title]').val();
			if(the_title) {
				jQuery(this).find('.cmb-group-title').text(the_title);
			} else {
				jQuery(this).find('.cmb-group-title').text('Scene ' + index);
			}
		});
	}
	/*--------------------------------------------------------------------------------------------------------------------*/
	if($('body').hasClass('post-type-pmn_outline')) {
		var actOne = php_data.act_one_string;
		var actTwo = php_data.act_two_string;
		var actThree = php_data.act_three_string;		
		jQuery('.act-flag > select').each(function() {
			switch(jQuery(this).val()) {
				case 'act_one':
					jQuery(this).closest('.postbox').find('.cmb-group-title').append(' <span class="act-tag">'+ actOne +'</span>');
					break;
				case 'act_two':
					jQuery(this).closest('.postbox').find('.cmb-group-title').append(' <span class="act-tag">'+ actTwo +'</span>');
					break;
				case 'act_three':
					jQuery(this).closest('.postbox').find('.cmb-group-title').append(' <span class="act-tag">'+ actThree +'</span>');
					break;
				default:
			}
		});
	}
	/*--------------------------------------------------------------------------------------------------------------------*/
	$(".post-type-pmn_outline .sortable, .post-type-pmn_character .sortable").sortable();
	/*--------------------------------------------------------------------------------------------------------------------*/
	$('#pmn-format-types').find('input:first').addClass('pmn-ebook');
	if($('.pmn-ebook').is(':checked')) {
		$('#pmn-file-types').show();
	} else {
		$('#pmn-file-types').hide();
	}
	/*--------------------------------------------------------------------------------------------------------------------*/
	$('#pmn-authorship').find('input:first').addClass('pmn-singleauthor');
	$('#pmn-authorship').find('input').not(':first').addClass('pmn-multiauthor');
	if($('.pmn-multiauthor').is(':checked')) {
		$('#pmn-coauthor').show();
	} else {
		$('#pmn-coauthor').hide();
	}
	/*--------------------------------------------------------------------------------------------------------------------*/
	$('#pmn-launch-methods').find('input:first').hide();
	/*--------------------------------------------------------------------------------------------------------------------*/
	/* On page load */
	var sum_start = 0;
	$('.tab-budget .cmb2-text-money').each(function() {
		 var noCommas = $( this ).val().replace(/,/g, '');
		 $( this ).val( noCommas );	
		 sum_start += Number($(this).val());
	});
	$('.pmn-the-total').text("$" + commaSeparateNumber(sum_start.toFixed(2)));
	
	/* Recalculate on change */
	$('.tab-budget .cmb2-text-money').on('blur change', function() {
		var sum = 0;
		$('.tab-budget .cmb2-text-money').each(function() {
			var noCommas = $( this ).val().replace(/,/g, '');
			$( this ).val( noCommas );			
			sum += Number($(this).val());
		});
		$('.pmn-the-total').text("$" + commaSeparateNumber(sum.toFixed(2)));
	});
	/*--------------------------------------------------------------------------------------------------------------------*/
	$(".tabs-menu a").on('click', function(e) {
		e.preventDefault();
		$(this).parent().siblings().removeClass("current");
		$(this).parent().addClass("current");
		localStorage.setItem('lastTab', $(this).attr('href'));
		localStorage.setItem('lastLi', "#" + $(this).closest('li').attr('id'));
		var tab = $(this).attr("href");
		$(".tab-content").not(tab).css("display", "none");
		$(tab).fadeIn();
	});
	/*--------------------------------------------------------------------------------------------------------------------*/
	$('#full-print').on('click', function(e) {
		e.preventDefault();
		$( '.pmn-credit').remove();		
		var grand_total = $('#pmn-rpt-gt').html();
		var rpt_credit = php_data.pmn_rpt_credit;
		$('#pmn-print-container .pmn-print-section').last().append( '<div class="pmn-credit">'+ rpt_credit +'</div>' );
		$('#pmn-gt').html( grand_total );
		$('#pmn-print-container').print({
			iframe: false,
		});
	});
	/*--------------------------------------------------------------------------------------------------------------------*/
	$('#character-print').on('click', function(e) {
		e.preventDefault();
		$( '.pmn-credit').remove();
		var rpt_credit = php_data.pmn_rpt_credit;		
		$('#pmn-print-characters .pmn-print-section').last().append( '<div class="pmn-credit">'+ rpt_credit +'</div>' );	
		$('#pmn-print-characters').print({
			iframe: false,
		});
	});
	/*--------------------------------------------------------------------------------------------------------------------*/
	$('#outline-print').on('click', function(e) {
		e.preventDefault();
		$( '.pmn-credit').remove();		
		var rpt_credit = php_data.pmn_rpt_credit;
		$('#pmn-print-outline .pmn-print-section').last().append( '<div class="pmn-credit">'+ rpt_credit +'</div>' );
		$('#pmn-print-outline').print({
			iframe: false,
		});
	});
	/*--------------------------------------------------------------------------------------------------------------------*/
	$('#summary-print').on('click', function(e) {
		e.preventDefault();
		$( '.pmn-credit').remove();
		var rpt_credit = php_data.pmn_rpt_credit;
		$('#pmn-print-summary .pmn-print-section').last().append( '<div class="pmn-credit">'+ rpt_credit +'</div>' );
		$('#pmn-print-summary').print({
			iframe: false,
		});
	});
	/*--------------------------------------------------------------------------------------------------------------------*/
	$('.pmn-delete-file').on('click', function(e) {
		if(!confirm("Are you sure?")) {
			e.preventDefault();
		}
	});
	/*--------------------------------------------------------------------------------------------------------------------*/
	$('#pmn-show-backup-note').on('click', function(e) {
		e.preventDefault();
		$('#pmn-backup-note').slideToggle();
	});
	/*--------------------------------------------------------------------------------------------------------------------*/
	$('.tab-marketing .dashicons-arrow-up').hide();
	$('.pmn-accordion').find('.accordion-toggle').click(function() {
		/* Handle display of arrows */
		if($(this).next().is(':visible')) {
			$('.dashicons-arrow-up').hide();
			$('.dashicons-arrow-down').show();
		} else {
			$('.dashicons-arrow-up').not($(this).next()).hide();
			$(this).find('.dashicons-arrow-up:first').show();
			$('.dashicons-arrow-down').show();
			$(this).find('.dashicons-arrow-down:first').hide();
		}
		/* Handle display of content */
		$(this).next().slideToggle('fast');
		$(".accordion-content").not($(this).next()).slideUp('fast');
	});
	/*--------------------------------------------------------------------------------------------------------------------*/
	// Note: This works together with a rule above that fires on page load	
	$('.pmn-ebook').on('change', function() {
		if(this.checked) {
			$('#pmn-file-types:hidden').slideDown();
		} else {
			$('#pmn-file-types:visible').slideUp();
		}
	});
	/*--------------------------------------------------------------------------------------------------------------------*/
	// Note: This works together with a rule above that fires on page load	
	$('.pmn-multiauthor').on('change', function() {
		if(this.checked) {
			$('#pmn-coauthor:hidden').slideDown();
		} else {
			$('#pmn-coauthor:visible').slideUp();
		}
	});
	/*--------------------------------------------------------------------------------------------------------------------*/
	// Note: This works together with a rule above that fires on page load	
	$('.pmn-singleauthor').on('change', function() {
		if(this.checked) {
			$('#pmn-coauthor').slideUp();
		} else {
			$('#pmn-coauthor').slideDown();
		}
	});
	/*--------------------------------------------------------------------------------------------------------------------*/
	function downloadInnerHtml(filename) {
		var pmn_content = $('#pmn-print-container').text();
		var link = document.createElement('a');
		link.setAttribute('download', filename);
		link.setAttribute('href', 'data:' + 'text/plain' + ';charset=utf-8,' + encodeURIComponent(pmn_content));
		link.click();
	}
	var fileName = php_data.filename_full;
	$('#full-dl').on('click', function() {
		$('#pmn-print-container').html(function() {
			return this.innerHTML.replace(/<tr>/g, '\n').replace(/<h2>/g, '\n').replace(/<\/p>/g, '\n').replace(/\t/g, '');
		});
		$('#pmn-print-container thead').remove();
		downloadInnerHtml(fileName);
		return false;
	});
	/*--------------------------------------------------------------------------------------------------------------------*/
	function exportTableToCSV($table, filename) {
		var $rows = $table.find('tr:has(td)'),
			tmpColDelim = String.fromCharCode(11),
			tmpRowDelim = String.fromCharCode(0),
			colDelim = '","',
			rowDelim = '"\r\n"',
			csv = '"' + $rows.map(function(i, row) {
				var $row = $(row),
					$cols = $row.find('td');
				return $cols.map(function(j, col) {
					var $col = $(col),
						text = $col.text();
					return text.replace(/"/g, '""');
				}).get().join(tmpColDelim);
			}).get().join(tmpRowDelim).split(tmpRowDelim).join(rowDelim).split(tmpColDelim).join(colDelim) + '"',
			// Data URI
			csvData = 'data:application/csv;charset=utf-8,' + encodeURIComponent(csv);
		$(this).attr({
			'download': filename,
			'href': csvData,
			'target': '_blank'
		});
	}
	var budgetName = php_data.filename_budget;
	// This must be a hyperlink
	$("#export-budget").on('click', function(event) {
		exportTableToCSV.apply(this, [$('.pmn-print-budget table'), budgetName]);
	});
	/*--------------------------------------------------------------------------------------------------------------------*/
	 function commaSeparateNumber(val){
		while (/(\d+)(\d{3})/.test(val.toString())){
		  val = val.toString().replace(/(\d+)(\d{3})/, '$1'+','+'$2');
		}
		return val;
	  }
		
	//----------
}); //end doc ready