$(document).ready(function(){
	var block = $('.block'),
	    accesoire = block.filter('#accessoire'),
            velo = block.filter('#velo');
	block.hide();
	block.filter(':first').show();
	$.datepicker.setDefaults( $.datepicker.regional[ "fr" ] );
	if(velo.size() > 0 && velo.is(':visible')) {
		$('#creerVeloDate').datepicker();
		$( "#modifierVeloRevisionDe" ).datepicker({
			defaultDate: "+1w",
		        changeMonth: true,
		        numberOfMonths: 1,
		        onClose: function( selectedDate ) {
				$( "#modifierVeloRevisionA" ).datepicker( "option", "minDate", selectedDate );
			}
		});
		$( "#modifierVeloRevisionA" ).datepicker({
			defaultDate: "+1w",
			changeMonth: true,
			numberOfMonths: 1,
			onClose: function( selectedDate ) {
				$( "#modifierVeloRevisionDe" ).datepicker( "option", "maxDate", selectedDate );
			}
		});
	}
	$('.buttons-bar a').click(function(e){
		e.preventDefault();
		block.hide();
		$($(this).attr('href')).show();

		if(accesoire.size() > 0 && accesoire.is(':visible')) {
			listerAccessoire();
		}
	});
});

/**   Velo   **/
$('#chargerVeloAmodifier').click(function(){ $('#champs-modifs').removeClass('hidden'); });
$('#modifierVelo').click(function(){ $('#champs-modifs').addClass('hidden'); });



/**   Accessoire   **/
$( "#ajouterAccessoire" ).click(function() {
	var nom = $("#accessoireNom").val();
	var desc = $("#accessoireDesc").val();
 	 $.getJSON('/velo/php/ControleurAccessoire.php',{"fonction":"cree","nom":nom,"desc":desc}, function(data){
	});
	listerAccessoire();
	$("#accessoireNom").val("");
	$("#accessoireDesc").val("");
});

$( "#supprimerAccessoire" ).click(function() {
	var id = $("#delete-pieces").val();
 	 $.getJSON('/velo/php/ControleurAccessoire.php',{"fonction":"supprimer","id":id}, function(data){
	});
	listerAccessoire();
});

$( "#chargerAccessoire" ).click(function() {
    var id = $("#modify-pieces").val();
    $.getJSON('/velo/php/ControleurAccessoire.php',{"fonction":"lire","id":id}, function(data)
	{
	    $("#champsModifier").removeClass("hidden");
	    $("#accessoireNomModifier").val(data.nom);
	    $("#accessoireDescModifier").val(data.description);
	});

});

$( "#modifierAccessoire" ).click(function() {
    var id = $("#modify-pieces").val();
    var nom = $("#accessoireNomModifier").val();
    var desc = $("#accessoireDescModifier").val();
	$.getJSON('/velo/php/ControleurAccessoire.php',{"fonction":"modifier","nom":nom,"desc":desc,"id":id}, function(data){});
	listerAccessoire();  	
	$("#champsModifier").addClass("hidden");
 	
});


function listerAccessoire(){
	$.getJSON('/velo/php/ControleurAccessoire.php',{fonction:"lireTous"}, function(data){
		$('#delete-pieces').empty();
		$('#modify-pieces').empty();
		$.each(data, function(i, item) {
			$('<option></option>')
			.text(item.nom).attr('value',item.id)
			.appendTo($('#delete-pieces, #modify-pieces'));
		});
	});
}
