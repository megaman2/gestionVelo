$(document).ready(function(){
	var block = $('.block'),
	    accesoire = block.filter('#accessoire'),
            velo = block.filter('#velo');
	block.hide();
	block.filter(':first').show();
	$.datepicker.setDefaults( $.datepicker.regional[ "fr" ] );
	if(velo.size() > 0 && velo.is(':visible')) {
		listerVelo();
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
		listerAccessoireVelo();
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

$( "#supprimerVelo" ).click(function() {
	var id = $("#veloAsupprimer").val();
 	 $.getJSON('/velo/php/ControleurVelo.php',{"fonction":"supprimer","id":id}, function(data){
	});
	listerVelo();
});


$( "#ajouterVelo" ).click(function() {
	var type = $("#creerVeloType").val();
	var model = $("#creerVeloModel").val();
	var desc = $("#creerVeloDescription").val();
	var date = $("#creerVeloDate").val();
 	 $.getJSON('/velo/php/ControleurVelo.php',{"fonction":"creer","type":type,"model":model,"desc":desc,"date":date}, function(data){
	});
	listerAccessoire();
	$("#creerVeloType").val("");
	$("#creerVeloModel").val("");
	$("#creerVeloDescription").val("");
	$("#creerVeloDate").val("");
});


$( "#chargerVeloAmodifier" ).click(function() {
    var id = $("#veloAmodifier").val();
    $.getJSON('/velo/php/ControleurVelo.php',{"fonction":"lire","id":id}, function(data)
    {
	$("#modifierVeloType").val(data.type);
	$("#modifierVeloModel").val(data.model);
	$("#modifierVeloDescription").val(data.description);
	$("#modifierVeloDate").val(data.dateAchat);
	$("#modifierVeloDateR").val(data.dateRevision);
	$("#modifierVeloRevisionDe").val(data.debutReparation);
	$("#modifierVeloRevisionA").val(data.finReparation);
	$("#champs-modifs").removeClass("hidden");
    });
});

$('#modifierVelo').click(function(){
  	var id = $("#veloAmodifier").val();
   	var type = $("#modifierVeloType").val();
	var model = $("#modifierVeloModel").val();
	var desc = $("#modifierVeloDescription").val();
	var date = $("#modifierVeloDate").val();
	var dateR = $("#modifierVeloDateR").val();
	var revisionD = $("#modifierVeloRevisionDe").val();
	var revisionF = $("#modifierVeloRevisionA").val();

	$.getJSON('/velo/php/ControleurVelo.php',{"fonction":"modifier",
						  "type":type,
						  "model":model,
						  "date":date,
						  "desc":desc,
						  "dateReparation":dateR,
						  "id":id,
						  "revisionD":revisionD,
						  "revisionF":revisionF}, function(data){});
	listerVelo();
	
   	$("#modifierVeloType").val("");
	$("#modifierVeloModel").val("");
	$("#modifierVeloDescription").val("");
	$("#modifierVeloDate").val("");
	$("#modifierVeloDateR").val("");
	$("#modifierVeloRevisionDe").val("");
	$("#modifierVeloRevisionA").val("");

	$('#champs-modifs').addClass('hidden'); 
});


function listerVelo(){
	$.getJSON('/velo/php/ControleurVelo.php',{"fonction":"lireTous"}, function(data){
		$('#veloAsupprimer').empty();
		$('#veloAmodifier').empty();
		$.each(data, function(i, item) {
			$('<option></option>')
			.text(item.type).attr('value',item.id)
			.appendTo($('#veloAsupprimer, #veloAmodifier'));
		});
	});
}


function listerAccessoireVelo(){
	$.getJSON('/velo/php/ControleurAccessoire.php',{fonction:"lireTous"}, function(data){
		$.each(data, function(i, item) {
			$('<th data-accessoire-id='+item.id+'></th>')
			.text(item.nom)
			.appendTo($('#accessoire_list'));
		});
		var indice = $('#accessoire_list').find('th').length-1,
                    htmlVelo = '';
		$.getJSON('/velo/php/ControleurVelo.php',{fonction:"lireTous"}, function(data){
			$.each(data, function(i, item) {
                                htmlVelo += '<tr><td data-velo-id='+item.id+'>'+item.type + '<br />' + item.model +'</td>';
				var i;
                                for (i = 0; i < indice; i++) {
					var j =  $('#accessoire_list').parentsUntil('table').find('th').eq(i+1).attr('data-accessoire-id');
					htmlVelo += '<td><input type="checkbox" data-accessoire="'+j+'" data-velo="'+item.id+'" /></td>';
				}
				htmlVelo += '</tr>';
			});
			$('#accessoire_list').parentsUntil('table').next().append(htmlVelo);
		remplireTableau();
		});
	});
} 

$( "#modifierRelationVeloAccessoire" ).click(function validerTableau(){
        $('#accessoire_list').parentsUntil('table').next().find(':checkbox').each(function(){
                var idvelo = $(this).attr('data-velo');
                var idaccessoire = $(this).attr('data-accessoire');
		//console.log(idvelo+' '+idaccessoire);
                if($("[data-velo="+idvelo+"][data-accessoire="+idaccessoire+"]").prop('checked')){
                $.getJSON('/velo/php/ControleurVelo_Accessoire.php',
                        {
                                fonction:"ajouter",
                                idVelo:idvelo,
                                idAccessoire:idaccessoire
                        }, function(data){});
		//console.log(idvelo+' '+idaccessoire);
                }else{
                        $.getJSON('/velo/php/ControleurVelo_Accessoire.php',
                        {
                                fonction:"supprimer",
                                idVelo:idvelo,
                                idAccessoire:idaccessoire
                        }, function(data){});
                }

        });
});


function remplireTableau(){
	$('#accessoire_list').parentsUntil('table').next().find(':checkbox').each(function(){
		var idvelo = $(this).attr('data-velo');
		var idaccessoire = $(this).attr('data-accessoire');
		$.getJSON('/velo/php/ControleurVelo_Accessoire.php',
		{fonction:"estValidee",
		 idVelo:idvelo,
	 	 idAccessoire:idaccessoire}, 
	 	function(data){
			if(data["COUNT(*)"]==1){
				$("[data-velo="+idvelo+"][data-accessoire="+idaccessoire+"]").prop('checked', true);
			}
	 	});
	});
}
	


/**   Accessoire   **/
$( "#ajouterAccessoire" ).click(function() {
	var nom = $("#accessoireNom").val();
	var desc = $("#accessoireDesc").val();
 	 $.getJSON('/velo/php/ControleurAccessoire.php',{"fonction":"creer","nom":nom,"desc":desc}, function(data){
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


/**   Tour   **/



$( "#ajouterTour" ).click(function() {
	var dateDepart = $("#tourDateDepart").val();
	var dateArrivee = $("#tourDateArrivee").val();
	var prix = $("#tourPrix").val();
	var type = $("#tourType").val();
	var parcours = $("#tourParcours").val();
	console.log(parcours);
	var maxx = $("#tourMax").val();
 	 $.getJSON('/velo/php/ControleurTour.php',{"fonction":"creer",
						   "dateDepart":dateDepart,
						   "dateArrivee":dateArrivee,
						   "prix":prix,
						   "type":type,
						   "parcours":parcours,
						   "max":maxx}, function(data){
	});
	$("#tourDateDepart").val("");
	$("#tourDateArrivee").val("");
	$("#tourPrix").val("");
	$("#tourMax").val(7);
});



/*
$( "#supprimerVelo" ).click(function() {
	var id = $("#veloAsupprimer").val();
 	 $.getJSON('/velo/php/ControleurVelo.php',{"fonction":"supprimer","id":id}, function(data){
	});
	listerVelo();
});


$( "#chargerVeloAmodifier" ).click(function() {
    var id = $("#veloAmodifier").val();
    $.getJSON('/velo/php/ControleurVelo.php',{"fonction":"lire","id":id}, function(data)
    {
	$("#modifierVeloType").val(data.type);
	$("#modifierVeloModel").val(data.model);
	$("#modifierVeloDescription").val(data.description);
	$("#modifierVeloDate").val(data.dateAchat);
	$("#modifierVeloDateR").val(data.dateRevision);
	$("#modifierVeloRevisionDe").val(data.debutReparation);
	$("#modifierVeloRevisionA").val(data.finReparation);
	$("#champs-modifs").removeClass("hidden");
    });
});

$('#modifierVelo').click(function(){
  	var id = $("#veloAmodifier").val();
   	var type = $("#modifierVeloType").val();
	var model = $("#modifierVeloModel").val();
	var desc = $("#modifierVeloDescription").val();
	var date = $("#modifierVeloDate").val();
	var dateR = $("#modifierVeloDateR").val();
	var revisionD = $("#modifierVeloRevisionDe").val();
	var revisionF = $("#modifierVeloRevisionA").val();

	$.getJSON('/velo/php/ControleurVelo.php',{"fonction":"modifier",
						  "type":type,
						  "model":model,
						  "date":date,
						  "desc":desc,
						  "dateReparation":dateR,
						  "id":id,
						  "revisionD":revisionD,
						  "revisionF":revisionF}, function(data){});
	listerVelo();
	
   	$("#modifierVeloType").val("");
	$("#modifierVeloModel").val("");
	$("#modifierVeloDescription").val("");
	$("#modifierVeloDate").val("");
	$("#modifierVeloDateR").val("");
	$("#modifierVeloRevisionDe").val("");
	$("#modifierVeloRevisionA").val("");

	$('#champs-modifs').addClass('hidden'); 
});


function listerVelo(){
	$.getJSON('/velo/php/ControleurVelo.php',{"fonction":"lireTous"}, function(data){
		$('#veloAsupprimer').empty();
		$('#veloAmodifier').empty();
		$.each(data, function(i, item) {
			$('<option></option>')
			.text(item.type).attr('value',item.id)
			.appendTo($('#veloAsupprimer, #veloAmodifier'));
		});
	});
}


function listerAccessoireVelo(){
	$.getJSON('/velo/php/ControleurAccessoire.php',{fonction:"lireTous"}, function(data){
		$.each(data, function(i, item) {
			$('<th data-accessoire-id='+item.id+'></th>')
			.text(item.nom)
			.appendTo($('#accessoire_list'));
		});
		var indice = $('#accessoire_list').find('th').length-1,
                    htmlVelo = '';
		$.getJSON('/velo/php/ControleurVelo.php',{fonction:"lireTous"}, function(data){
			$.each(data, function(i, item) {
                                htmlVelo += '<tr><td data-velo-id='+item.id+'>'+item.type + '<br />' + item.model +'</td>';
				var i;
                                for (i = 0; i < indice; i++) {
					var j =  $('#accessoire_list').parentsUntil('table').find('th').eq(i+1).attr('data-accessoire-id');
					htmlVelo += '<td><input type="checkbox" data-accessoire="'+j+'" data-velo="'+item.id+'" /></td>';
				}
				htmlVelo += '</tr>';
			});
			$('#accessoire_list').parentsUntil('table').next().append(htmlVelo);
		remplireTableau();
		});
	});
} 


function remplireTableau(){
	$('#accessoire_list').parentsUntil('table').next().find(':checkbox').each(function(){
		var idvelo = $(this).attr('data-velo');
		var idaccessoire = $(this).attr('data-accessoire');
		$.getJSON('/velo/php/ControleurVelo_Accessoire.php',
		{fonction:"estValidee",
		 idVelo:idvelo,
	 	 idAccessoire:idaccessoire}, 
	 	function(data){
			if(data["COUNT(*)"]==1){
				$("[data-velo="+idvelo+"][data-accessoire="+idaccessoire+"]").prop('checked', true);
			}
	 	});
	});
}
	

*/

