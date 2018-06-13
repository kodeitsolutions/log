$(document).ready(function(){
    setTimeout(function() {
      $('.alert').fadeOut('fast');
    }, 5000); 
    
    $('[data-toggle="tooltip"]').tooltip();
    
    $(".time_element").timepicki();

    $.datepicker.regional['es'] = {
    	monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
        dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sá'],
        weekHeader: 'Sm',
        dateFormat: 'dd/mm/yy',
        firstDay: 1,
        isRTL: false,
        showMonthAfterYear: false,
        yearSuffix: ''
    };
    $.datepicker.setDefaults($.datepicker.regional['es']);

    $("#date").datepicker();
    $("#date_from").datepicker();
    $("#date_to").datepicker();

    $('#date_from').click( function(e) {
    	$(this).select();
  	});

  	$('#date_to').click( function(e) {
    	$(this).select();
  	});

    $('#categorie_id').change(category);
});

function formatTime(time){
	var shift_time = time.substring(0,5);

	if(shift_time.substring(0,2) < 12) {
		shift_time += ' AM';
	}
	else {
		shift_time = ((shift_time.substring(0,2) - 12) < 10) ? shift_time = '0'+(shift_time.substring(0,2) - 12) + shift_time.substring(2,5) + ' PM' : shift_time = (shift_time.substring(0,2) - 12) + shift_time.substring(2,5) + ' PM';
	}
	return shift_time;
}

function upperCase(name) {
	name = name.slice(0,1).toUpperCase() + name.slice(1).toLowerCase();	    
    return name;
};

function modalDelete(module,id){
	var moduleUC = upperCase(module);

	if (module !== "notificacion" ){
		$.get('/'+module+'/get'+moduleUC+'/' + id, function(response){
			if(module !== "shift"){
	        	$('label[id="name"]').text(response.name);
			}
			else{
				$('label[id="description"]').text(response.description);
			}
	    })
	}	
    $('form[id="delete"]').attr('action',module+'/' + id);
}

function modalDeleteEntry(id,tr)
{	
	$('h4[id="info').text('Eliminar registro N° ' + tr); 	
  	$('form[id="delete"]').attr('action','/entry/' + id);
}


function modalEdit(module,id)
{
	var moduleUC = upperCase(module);

	$.get('/'+module+'/get'+moduleUC+'/' + id, function(response){
      	if(module === "category"){
      		$('input[id="name"]').val(response.name);
      		$('textarea[id="description"]').text(response.description);

	        if (response.person == 1){
	        	$('input[id="person"]').prop('checked', true);
	        }
	        else{
	            $('input[id="person"]').prop('checked', false);
	        }
	        if (response.material == 1){
	        	$('input[id="material"]').prop('checked', true);
	        }
	        else{
	            $('input[id="material"]').prop('checked', false);
	        }
	        if (response.vehicle == 1){
	            $('input[id="vehicle"]').prop('checked', true);
	        }
	        else{
	            $('input[id="vehicle"]').prop('checked', false);
	        }
	        if (response.combined == 1){
	        	$('input[id="combined"]').prop('checked', true);
	        }
	        else{
	            $('input[id="combined"]').prop('checked', false);
	        }      
      	}
      	if(module === "material" || module === "unit"){
      		$('input[id="code"]').val(response.code);
        	$('input[id="name"]').val(response.name);
      	}
      	if(module === "notification"){
      		var conditions = jQuery.parseJSON(response.conditions);
	  		$('input[id="recipient"]').val(conditions.recipient);
			$.each(conditions.moment, function(key, value) {
			    $('input[id="'+ value +'"]').prop('checked',true);
			})
			$.each(conditions.operation, function(key, value) {
			    $('input[id="operation/'+ value +'"]').prop('checked', true);
			})
			$.each(conditions.category, function(key, value) {
			    $('input[id="category/'+ value +'"]').prop('checked',true);
			})
  			$.each(conditions.company, function(key, value) {
			    $('input[id="company/'+ value +'"]').prop('checked',true);
			})
			$.each(conditions.material, function(key, value) {
			    $('input[id="material/'+ value +'"]').prop('checked',true);
			})
			$('#status').val(response.status)
      	}
      	if(module === "operation"){
      		$('input[id="name"]').val(response.name)
      	}
      	if(module === "shift"){      		
      		$('input[id="description"]').val(response.description) 
          	$('input[id="start"]').val(formatTime(response.start))
          	$('input[id="end"]').val(formatTime(response.end))
      	}
      	if(module === "user"){
      		$('input[id="name"]').val(response.name)
  			$('input[id="username"]').val(response.username)
  			$('input[id="email"]').val(response.email)
  			$('input[id="telephone"]').val(response.telephone)

  			if (response.isAdmin == 1){
  				$('input[id="isAdmin"]').prop('checked', true)
  			}
  			else{
  				$('input[id="isAdmin"]').prop('checked', false)
  			}
      	}
      	if(module === "worker"){
      		$('input[id="name"]').val(response.name);
	        $('input[id="worker_id"]').val(response.worker_id);
	        $('#companie_id').val(response.companie_id);
	        $('input[id="department"]').val(response.department);
	        $('input[id="position"]').val(response.position);
	        $('#status').val(response.status);
      	}     	    
    })
    $('form[id="edit"]').attr('action',module+'/' + id);      	
}

function category(){
    var  selection  = $('#categorie_id option:selected').val();   
       
    $.get('/category/getCategory/' + selection, function(response){        
    	if(response.person == 1){            
        	$('#material').hide();
        	$("#person").show();         
      	}

      	if(response.material == 1){
	        $("#person").hide();
	        $('#material').show();            
      	}

      	if(response.vehicle == 1){           
        	$("#vehicle").show();
      	}  

      	if(response.combined == 1){
	        $("#person").show();
	        $('#material').show();
	        $("#vehicle").show();
      	}         
    });
}

function modalInfo(id, tr){
	$('h4[id="info').text('Datos del registro N° ' + tr);	

	$.get('/entry/getEntry/' + id, function(response){    
		
		$.get('/category/getCategory/' + response.categorie_id, function(category){
			if(category.person == 1 || category.combined == 1){
				$('dd[id="person_name').text(response.person_name);
	          	$('dd[id="person_id').text(response.person_id);
	          	$('dd[id="person_occupation').text(response.person_occupation);
	          	$('dd[id="person_company').text(response.person_company);
	          	$('dd[id="person_observations').text(response.person_observations);
	        }

	        if(category.material == 1 || category.combined == 1){
	        	$('dd[id="material_type').text(response.material_type);
	          	var material_id = response.material_id;
	          	$.get('/material/getMaterial/' + material_id, function(material){
	          		$('dd[id="material').text(material.code + ' - ' + material.name);
	          	})
	          	$('dd[id="material_quantity').text(response.material_quantity);
	          	var unit_id = response.unit_id;
	          	$.get('/unit/getUnit/' + unit_id, function(unit){
	          		$('dd[id="unit').text(unit.code + ' - ' + unit.name);
	          	})
	          	$('dd[id="material_observations').text(response.material_observations);
	        }

	        if(category.vehicle == 1 || category.combined == 1) { 
	        	$('dd[id="vehicle').text(response.vehicle);
	          	$('dd[id="vehicle_plate').text(response.vehicle_plate);
	          	$('dd[id="driver_name').text(response.driver_name);
	          	$('dd[id="driver_id').text(response.driver_id);
	          	$('dd[id="vehicle_observations').text(response.vehicle_observations);
	        }  

	        if(category.person === 1){            
	        	$('#material').hide();
	            $("#person").show();         
	        }

	        if(category.material === 1){
	            $("#person").hide();
	            $('#material').show();
	        }

	        if(category.vehicle === 1) {           
	        	$("#vehicle").show();
	        }  

	        if(category.combined === 1){
	            $("#person").show();
	            $('#material').show();
	            $("#vehicle").show();
	        }

	        if (response.vehicle === null) {            	
            	$("#vehicle").hide();
            }	            
		})	          	
    })
}

function notifications() {
	$("#operation_all").click(function () {
	    if($('input[id="operation"]').is(':checked') && $('input[id="operation"]:checked').length === $('input[id="operation"]').length) {
			$('input[id="operation"]').prop('checked',false);
			$("#operation_all").text('Todos');
		}
		else {
			$('input[id="operation"]').prop('checked',true);
			$("#operation_all").text('Quitar');
		}			    
	});

	$("#category_all").click(function () {
		if($('input[id="category"]').is(':checked') && $('input[id="category"]:checked').length === $('input[id="category"]').length){
			$('input[id="category"]').prop('checked',false);
			$("#category_all").text('Todos');
			$('input[id="material"]').attr('disabled',true);
			$("#material_all").attr('disabled',true);
			$('input[id="material"]').prop('checked', false);
		}
		else {
			$('input[id="category"]').prop('checked',true);
			$("#category_all").text('Quitar');
			$('input[id="material"]').attr('disabled',false);
			$("#material_all").attr('disabled',false);
		}					    
	});

	$("#company_all").click(function () {
	    if($('input[id="company"]').is(':checked') && $('input[id="company"]:checked').length === $('input[id="company"]').length){
			$('input[id="company"]').prop('checked',false);
			$("#company_all").text('Todos');
		}
		else {
			$('input[id="company"]').prop('checked',true);
			$("#company_all").text('Quitar');
		}
	});

	$("#material_all").click(function () {
	    if($('input[id="material"]').is(':checked') && $('input[id="material"]:checked').length === $('input[id="material"]').length){
			$('input[id="material"]').prop('checked',false);
			$("#material_all").text('Todos');
		}
		else {
			$('input[id="material"]').prop('checked',true);
			$("#material_all").text('Quitar');
		}
	});

	$('input[id="category"][value=1]').click(function () {
		if($('input[id="category"]').val() == 1 && $('input[id="category"][value=1]').is(':checked')){
			$('input[id="material"]').attr('disabled',true);
			$("#material_all").attr('disabled',true);
		}
		else {
			$('input[id="material"]').attr('disabled',false);
			$("#material_all").attr('disabled',false);
		}
	});
	$('input[id="category"][value=2]').click(function () {
		if($('input[id="category"][value=2]').is(':checked') || $('input[id="category"][value=3]').is(':checked')){
			$('input[id="material"]').attr('disabled',false);
			$("#material_all").attr('disabled',false);
			
		}
		else {
			$('input[id="material"]').attr('disabled',true);
			$("#material_all").attr('disabled',true);
			$('input[id="material"]').prop('checked', false);
		}		
	});
	$('input[id="category"][value=3]').click(function () {
		if($('input[id="category"][value=3]').is(':checked') || $('input[id="category"][value=2]').is(':checked')){
			$('input[id="material"]').attr('disabled',false);
			$("#material_all").attr('disabled',false);
			
		}
		else {
			$('input[id="material"]').attr('disabled',true);
			$("#material_all").attr('disabled',true);
			$('input[id="material"]').prop('checked', false);
		}		
	});
}

