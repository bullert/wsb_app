$(document).ready(function(){

	InitMaterialize();
});

function InitMaterialize()
{
	var datepickerOptions = {
		cancel: 'Anuluj',
		clear: 'Wyczyść',
		months: [
			'Styczeń',
			'Luty',
			'Marzec',
			'Kwiecień',
			'Maj',
			'Czerwiec',
			'Lipiec',
			'Sierpień',
			'Wrzesień',
			'Październik',
			'Listopad',
			'Grudzień'
		],
		monthsShort: [
			'Sty',
			'Lut',
			'Mar',
			'Kwi',
			'Maj',
			'Cze',
			'Lip',
			'Sie',
			'Wrz',
			'Paź',
			'Lis',
			'Gru'
		],
		weekdays: [
			'Poniedziałek',
			'Wtorek',
			'Środa',
			'Czwartek',
			'Piątek',
			'Sobota',
			'Niedziela'
		],
		weekdaysShort: [
			'Nie',
			'Pon',
			'Wto',
			'Śro',
			'Czw',
			'Pią',
			'Sob'
		],
		weekdaysAbbrev:	['N','P','W','Ś','C','P','S']
	}
	
	$('.sidenav').sidenav();
	$('.dropdown-trigger').dropdown();
	$('select').formSelect();
	$('.datepicker').datepicker({i18n: datepickerOptions, container: document.body});
}
