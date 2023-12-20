//declaraciones
var base_url=document.getElementById('base_url').value;
var subtotal=$("#subtotal").val()==null?0:parseFloat($("#subtotal").val());
var impuesto=$("#impuesto").val()==null?0:parseFloat($("#impuesto").val());
var descuento=$("#descuento").val()==null?0:parseFloat( $("#descuento").val());
var totalpagar=0;
if($("#aplica_descuento")!=null)
{
    if($("#aplica_descuento").is(":checked"))
    {
        totalpagar=subtotal+impuesto-descuento;
        $("#descuento").val(descuento);
    }
    else
    {
        totalpagar=subtotal+impuesto;
        $("#descuento").val(0);
    }    
}
if($("#totalpagar")!=null)
{
    $("#totalpagar").val(totalpagar)
}
//console.log(base_url);
//eventos
//facturacion
$("#recibido").on('input',function()
{
    var recibido=this.value==""?0: this.value;
    Cambio(recibido,totalpagar);
    //console.log(this.value);
});
$("#aplica_descuento").change(function(){
    if(this.checked)
    {
        totalpagar=subtotal+impuesto-descuento;
        $("#descuento").val(descuento);
    }
    else{
        totalpagar=subtotal+impuesto;
        $("#descuento").val(0);
    }
    var recibido=$("#recibido").val()==""?0:$("#recibido").val();
    Cambio(recibido,totalpagar);
    $("#totalpagar").val(totalpagar);    
});
///
$("#categoriaCita").change(function(){    
    $.ajax({        
        url: base_url + "/servicios/serviciosCategoria/"+$(this).val(),        
        type: "GET",        
        dataType: "json",        
        data:{},        
        success: function (result) 
        {   
            cargar($("#servicio"),result,"Seleccione un servicio");           
        }
    });
});
$("#departamento").change(function(){    
    $.ajax({        
        url: base_url + "/municipios/"+$(this).val(),        
        type: "GET",        
        dataType: "json",        
        data:{},        
        success: function (result) {
            cargar($("#municipio"),result,"Seleccione un municipio");            
        }
    });              
});
//funciones
function cargar(select,array,entrada)
{
    select.empty();         
    var option = document.createElement('option');            
    option.value = "";            
    option.text = entrada;            
    select.append(option);
    array.forEach(element => {
        option = document.createElement('option');
        option.value = element.id;
        option.text = element.nombre;                
        select.append(option); 
    });              
}
function validar(mensaje)
{
    if(confirm(mensaje))
    {
        return true;
    }
    else
    {
        return false;
    }            
}
//facturacion
function Cambio(recibido,total_pagar)
{
    var cambio=recibido-total_pagar;
    if(cambio<0)
    {
        $("#cambio").css('color','red');
        $("#cambio").val(cambio*-1);
    }
    else
    {
        $("#cambio").css('color','black');
        $("#cambio").val(cambio);
    }
}
