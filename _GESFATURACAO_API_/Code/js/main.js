/*************************************RELOAD DATATABLE*************************************/
$.fn.dataTableExt.oApi.fnReloadAjax = function(oSettings, sNewSource, fnCallback, bStandingRedraw) {
	if (sNewSource !== undefined && sNewSource !== null) {
		oSettings.sAjaxSource = sNewSource;
	}
	// Server-side processing should just call fnDraw
	if (oSettings.oFeatures.bServerSide) {
		this.fnDraw();
		return;
	}
	this.oApi._fnProcessingDisplay(oSettings, true);
	var that = this;
	var iStart = oSettings._iDisplayStart;
	var aData = [];
	this.oApi._fnServerParams(oSettings, aData);
	oSettings.fnServerData.call(oSettings.oInstance, oSettings.sAjaxSource, aData, function(json) {
		/* Clear the old information from the table */
		that.oApi._fnClearTable(oSettings);
		/* Got the data - add it to the table */
		var aData = (oSettings.sAjaxDataProp !== "") ? that.oApi._fnGetObjectDataFn( oSettings.sAjaxDataProp )(json) : json;
		for (var i = 0; i < aData.length; i++) {
			that.oApi._fnAddData(oSettings, aData[i]);
		}
		oSettings.aiDisplay = oSettings.aiDisplayMaster.slice();
		that.fnDraw();
		if (bStandingRedraw === true) {
			oSettings._iDisplayStart = iStart;
			that.oApi._fnCalculateEnd(oSettings);
			that.fnDraw(false);
		}
		that.oApi._fnProcessingDisplay(oSettings, false);
		/* Callback user function - for event handlers etc */
		if ( typeof fnCallback == 'function' && fnCallback !== null) {
			fnCallback(oSettings);
		}
	}, oSettings);
};
$(function() {
	$(".form-validate").validate({

		errorPlacement : function(error, element) {
			error.insertAfter(element);
		}
	});

});

$('input[type="checkbox"]').iCheck({
	checkboxClass : 'icheckbox_minimal-grey',
	increaseArea : '20%' // optional
});

$('input[type="radio"]').iCheck({
	radioClass : 'iradio_minimal-grey',
	increaseArea : '20%' // optional
});

function getRandomInt(min, max) {
	return Math.floor(Math.random() * (max - min + 1)) + min;
}

function isNumberKey(evt, obj) {

	var charCode = (evt.which) ? evt.which : evt.keyCode
	var value = obj.value;
	var dotcontains = value.indexOf(".") != -1;
	if (dotcontains)
		if (charCode == 46)
			return false;
	if (charCode == 46)
		return true;
	if (charCode > 31 && (charCode < 48 || charCode > 57))
		return false;
	return true;
}
  (function($){
	$(document).ready(function(){
		$('li.dropdown-submenu > .dropdown-menu').hover(function() {
		
			$(this).parent().siblings().removeClass('open');
			$(this).parent().toggleClass('open');
		});
	});
})(jQuery);
