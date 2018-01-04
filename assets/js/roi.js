$(document).ready(function(){
	recalculate();
	$('input[type="range"]').rangeslider({
	    polyfill : false,
	    onInit : function() {
	        this.output = $( '<div class="range-output" />' ).insertAfter( this.$range ).html( this.$element.val() );
	    },
	    onSlide : function( position, value ) {
	        this.output.html( value );
	        recalculate();
	    }
	});
});

function recalculate(){
	var locations = $('#locations').val();
	var localaudits = $('#localaudits').val();
	var corporateaudits = $('#corporateaudits').val();
	var hours = $('#hours').val();
	var salary = $('#salary').val();
	var hoursc = $('#hoursc').val();
	var totalaudits = parseInt(localaudits)+parseInt(corporateaudits);
	var totalaudithours = parseInt(hours)+parseInt(hoursc);
	var averageaudittime = Math.round(((localaudits*hours) + (corporateaudits*hoursc))/totalaudits);

	$('#slocations').html(locations);
	$('#stotalaudits').html(totalaudits);
	$('#shours').html(averageaudittime);
	$('#spay').html(salary);
	$('#shourssaved').html(numberWithCommas(Math.round(locations*totalaudits*averageaudittime)));
	$('#savemoney span, #smoneysaved').html(numberWithCommas((Math.round(.25*locations*totalaudits*averageaudittime*salary))));
	$('#savehours span').html(numberWithCommas(Math.round(.25*locations*totalaudits*averageaudittime)));
	
	var dynamiclink = "https://rizepoint.com/rizepoint-roi-one-sheet?locations="+locations+"&localaudits="+localaudits+"&corporateaudits="+corporateaudits+"&hoursperlocalaudit="+hours+"&hourspercorporateaudit="+hoursc+"&salary="+salary;
		
	$(".learn-btn").attr("href", dynamiclink);

}

function numberWithCommas(x) {
    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}