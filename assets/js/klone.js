$(function(){

// //Detecting Browser
// var isOpera = !!window.opera || navigator.userAgent.indexOf(' OPR/') >= 0;
//     // Opera 8.0+ (UA detection to detect Blink/v8-powered Opera)
// var isFirefox = typeof InstallTrigger !== 'undefined';   // Firefox 1.0+
// var isSafari = Object.prototype.toString.call(window.HTMLElement).indexOf('Constructor') > 0;
//     // At least Safari 3+: "[object HTMLElementConstructor]"
// var isChrome = !!window.chrome && !isOpera;              // Chrome 1+
// var isIE = /*@cc_on!@*/false || !!document.documentMode; // At least IE6

$(".date").datepicker({
	showOtherMonths: true,
	selectOtherMonths: true,
	dateFormat: "dd/mm/yy"
});	

$( ".datefrom" ).datepicker({
	dateFormat: "dd/mm/yy",
	onClose: function( selectedDate ) {
        $( ".dateto" ).datepicker( "option", "minDate", selectedDate );
	}
});

$( ".dateto" ).datepicker({
	dateFormat: "dd/mm/yy",
	onClose: function( selectedDate ) {
		$( ".datefrom" ).datepicker( "option", "maxDate", selectedDate );
	}
});

});