<?php
namespace App\Repositories;
use Mike42\Escpos\Printer;
class PlantillasRepository
{
    private function GetFaltante($item)
    {
        $tampr=strlen($item->producto->nombre);            
        $tam=0;
        if($tampr<=11)
        {
            $tam=11-$tampr;                
        }            
        return $tam;
    }
    private function TextAlign($item,Printer $printer)
    {        
        $tam=$this->GetFaltante($item);        
        switch(strlen("$".number_format($item->valor_unitario)))
        {
            case 6:                
                {
                    $printer->text(str_repeat(" ",6+$tam)."$".number_format($item->valor_unitario));                    
                    break;                
                }
            case 7:
                {
                    $printer->text(str_repeat(" ",5+$tam)."$".number_format($item->valor_unitario));
                    break;
                }                    
            case 8:                    
                {
                    $printer->text(str_repeat(" ",4+$tam)."$".number_format($item->valor_unitario));                        
                    break;                   
                }                
        }        
        switch(strlen("$".number_format($item->total)))            
        {
            case 6:
                {
                    $printer->text(str_repeat(" ",7)."$".number_format($item->total)."\n");           
                    break;
                }                    
            case 7:
                { 
                    $printer->text(str_repeat(" ",6)."$".number_format($item->total)."\n");           
                    break;
                }                    
            case 8:                    
                {                        
                    $printer->text(str_repeat(" ",5)."$".number_format($item->total)."\n");           
                    break;
                }                
        }            
    }
    public function ImprimirPlantillaOrdenServicio(Printer $printer,$ordenservicio)
    {
	    $encabezado=$ordenservicio->impresora!=null?$ordenservicio->impresora->tamaño_fuente_encabezado:2;
        $contenido=$ordenservicio->impresora!=null?$ordenservicio->impresora->tamaño_fuente_contenido:1;
        $valorDomicilio=$ordenservicio->orden_encabezado->domicilio==1?$ordenservicio->domicilio:0;
        $propina=$ordenservicio->propina;
        $printer->setTextSize($encabezado,$encabezado);                
        $printer->setJustification(Printer::JUSTIFY_CENTER);        
        $printer-> text($ordenservicio-> empresa->nombre. "\n");    
        $printer->setTextSize($contenido,$contenido);        
        $printer->text("Nit - ".$ordenservicio->empresa->nit."\n" );
        $printer->text($ordenservicio-> empresa->direccion."\n" );
        $printer->text("tel:".$ordenservicio-> empresa->telefono."\n");     
        $printer->setTextSize($encabezado,$encabezado);         
        $printer->text("------------------------\n");                 
        $printer->text("________________________\n\n");                     
        $printer->setJustification(Printer::JUSTIFY_LEFT);        
        $printer->setTextSize($contenido,$contenido);            
        $printer->text("Ticket No:".$ordenservicio->orden_encabezado->codigo."\n" );     
        $printer->text("Fecha/hora:".$ordenservicio->orden_encabezado->fecha." ". $ordenservicio->orden_encabezado->hora."\n");
        $printer->text("Mesero:".$ordenservicio->orden_encabezado->empleado->nombre.' '.$ordenservicio->orden_encabezado->empleado->apellido  .  "\n");
        if($ordenservicio->orden_encabezado->cabaña!=null)
        {
            $printer->text("Mesa:".$ordenservicio->orden_encabezado->cabaña->nombre);
        }        
        $printer->text("Estado:".$ordenservicio->orden_encabezado->estado->nombre. "\n");        
        if($ordenservicio->orden_encabezado->cliente!=null)
        {
            $printer->setJustification(Printer::JUSTIFY_CENTER);                    
            $printer->setTextSize($encabezado,$encabezado);                
            $printer->text("________________________\n");                  
            $printer->setTextSize($contenido,$contenido);              
            $printer->setJustification(Printer::JUSTIFY_LEFT); 
            $printer->text("Cliente:\n");         
            $printer->text("Identificacion:".$ordenservicio->orden_encabezado->cliente->identificacion ."\n");
            $printer->text("Nombre:".$ordenservicio->orden_encabezado->cliente->nombre." ".$ordenservicio->orden_encabezado->cliente->apellido. "\n");
            $printer->text("Direccion:".$ordenservicio->orden_encabezado->cliente->direccion."\n");            
        }          
        $printer->setJustification(Printer::JUSTIFY_CENTER);        
        $printer->setTextSize($encabezado,$encabezado);              
        $printer->text("________________________\n");                                       
        $printer->setTextSize($encabezado,$encabezado);              
        $printer->text("________________________\n\n");    
        $printer->setJustification(Printer::JUSTIFY_LEFT);       
        $printer ->setTextSize($contenido,$contenido);           
        $detalles=$ordenservicio->detalles;         
	    $encabezadoInicial="CANT       DESCRIPCION       PRECIO     TOTAL";   	
        $printer->text($encabezadoInicial."\n");    
        $printer->setJustification(Printer::JUSTIFY_CENTER);        
        $printer->setTextSize($encabezado,$encabezado);  
        $printer->text("________________________\n\n"); 
        $printer->setTextSize($contenido,$contenido);  
	    $printer->setJustification(Printer::JUSTIFY_LEFT);                              
        foreach( $detalles as $item)
        {
            $printer->text(number_format($item->cantidad));
	        $sub=substr($item->producto->nombre,0, 11);                               
	        $printer->text(str_repeat(" ",11).$sub);
            $this->TextAlign($item,$printer);
        }
        $printer ->setTextSize($encabezado,$encabezado);              
        $printer->setJustification(Printer::JUSTIFY_CENTER);        
        $printer->text("________________________\n");                          
        if(count($ordenservicio->orden_encabezado->pagos)>0)
        {
            $printer->text("________________________\n");                          
            $printer->setJustification(Printer::JUSTIFY_LEFT);        
            $printer ->setTextSize($contenido,$contenido);     
            $printer->text("Totales\n");                          
            $printer->setJustification(Printer::JUSTIFY_RIGHT);        
            foreach($ordenservicio->orden_encabezado->pagos as $item)
            {
                $detallepagos=$item->pago_detalle;
              //  $printer->text("Codigo: ".$item->codigo."\n");
               // $printer->text("Fecga / hora: ".$item->fecha_hora."\n");
              //  $printer->text("Forma de pago: ".$item->forma_pago->nombre."\n");
                $printer->text("Subtotal: $".number_format( $item->subtotal)."\n");
	        	if($item->impuesto!=0)
		        {
                    $printer->text("Impuesto: $".number_format( $item->impuesto)."\n");
		        }
		        if($item->descuento!=0)
		        {
	                $printer->text("Descuento: $".number_format( $item->descuento)."\n");
		        }
                if($valorDomicilio!=0)
                {
                    $printer->text("Valor domicilio: $".number_format($valorDomicilio)."\n");
                }
                if($propina!=0)
                {
                    $printer->text("Serv.vol.:  $".number_format( $item->servicio_voluntario==0? $item->total_pagar*$propina:$item->servicio_voluntario )."\n");                
                }
             //   $printer->text("Recibido: $".number_format( $item->recibido)."\n");  
                $printer->text("Cambio: $".number_format( $item->cambio)."\n");             
                foreach($detallepagos as $detallepago)
                {
                    $printer->text($detallepago->detalle_pago . ": $".number_format( $detallepago-> valor_recibido)."\n");

                }                              
                $printer ->setTextSize($encabezado,$encabezado);        
                $printer->text("Total a pagar: $".number_format( $item->total_pagar+$valorDomicilio+$item->servicio_voluntario)."\n");                
                //$printer->text("Observaciones: ".$item->observaciones."\n");                
            }  
            $printer ->setTextSize($encabezado,$encabezado);              
            $printer->setJustification(Printer::JUSTIFY_CENTER);        
            $printer->text("________________________\n\n");
	        $printer ->setTextSize($contenido,$contenido);              
            $printer->text(" Gracias por su estancia en ".strtoupper($ordenservicio-> empresa->nombre).". \n");
            $printer->text(" Vuelve pronto. \n");
            $printer ->setTextSize($encabezado,$encabezado);                      
            $printer->text("________________________\n");                          
            $printer->text("------------------------\n");         
        }        
    }
    public function ImprimirPlantillaComanda(Printer $printer,$ordenservicio )
    {
        $encabezado=$ordenservicio->impresora->tamaño_fuente_encabezado;
        $contenido=$ordenservicio->impresora->tamaño_fuente_contenido;
        $printer ->setTextSize($encabezado,$encabezado);      
        $printer -> text("========================\n");    
        $printer->setJustification(Printer::JUSTIFY_CENTER);        
        $printer -> text($ordenservicio-> empresa->nombre. "\n");    
        $printer ->setTextSize($contenido,$contenido);
        $printer->text($ordenservicio->empresa->nit."\n" );        
        $printer ->setTextSize($encabezado,$encabezado);                      
        $printer->setJustification(Printer::JUSTIFY_CENTER);                
        $printer->text("========================\n");        
        $printer->text("========================\n");        
        $printer->setJustification(Printer::JUSTIFY_LEFT);        
        $printer ->setTextSize($contenido,$contenido);    
        $printer->text("Mesero:".$ordenservicio->orden_encabezado->empleado->nombre.' '.$ordenservicio->orden_encabezado->empleado->apellido  .  "\n");        
        $printer->text("Fecha/hora:".$ordenservicio->orden_encabezado->fecha." ". $ordenservicio->orden_encabezado->hora."\n");
        $printer->text("Hora entrega:".$ordenservicio->orden_encabezado->hora_entrega ."\n");        
        $printer->setTextSize($encabezado,$encabezado);                      
        if($ordenservicio->orden_encabezado->cabaña!=null)
        {
            $printer->text("Mesa:".$ordenservicio->orden_encabezado->cabaña->nombre. "\n");        
            

        }
        else
        {
            $printer->text("Direccion domicilio:".$ordenservicio->orden_encabezado->cliente->direccion. "\n");        
	        
        }
        $printer->setJustification(Printer::JUSTIFY_CENTER);        
        $printer->text("========================\n");    
        $printer->text("=========Detalle========\n");
        $printer->setJustification(Printer::JUSTIFY_LEFT);        
       
        $detalles=$ordenservicio->detalles;          
        foreach( $detalles as $item)
        {               
            $printer ->setTextSize($encabezado,$encabezado);      
            $printer->text("--------------\n");                                         
            $printer->text("Cantidad: ".$item->cantidad."\n");
            $printer->text("Producto: ".$item->producto->nombre." \n");
            if ($item->observaciones!='')
            {
                $printer->text("Observaciones: ".$item->observaciones."\n");            
            }
            $printer->text("--------------\n");                
        /*    $printer ->setTextSize($contenido,$contenido);                                         
            if($item->producto->foraneo==0){
                $ingredientes=$item->producto->preparacions;
                foreach($ingredientes as $ingrediente)
                {
                    $printer->text("--------------\n");                                         
                    $printer->text("Cantidad:".$ingrediente->cantidad."\n");
                    $printer->text("Ingrediente:".$ingrediente->materia_prima->codigo.' - '.$ingrediente->materia_prima->nombre." \n");
                    $printer->text("--------------\n");                                         
                }
            }*/      
        }
        $printer ->setTextSize($encabezado,$encabezado);              
        $printer->setJustification(Printer::JUSTIFY_CENTER);        
        $printer->text("========================\n");            
    }
}
