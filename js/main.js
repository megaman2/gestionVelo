$(document).ready(function(){
	var block = $('.block'),
	    accesoire = $('#accessoire');
	block.hide();
	block.filter(':first').show();
	$('.buttons-bar a').click(function(e){
		e.preventDefault();
		block.hide();
		$($(this).attr('href')).show();

		if(accesoire.size() > 0 && accesoire.is(':visible')) {
			listerAccessoire();
		}
	});
});


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
	$("#champsModifier").addClass("hidden");
 	listerAccessoire();  

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
