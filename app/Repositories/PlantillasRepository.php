<?php
namespace App\Repositories;
use Mike42\Escpos\Printer;
class PlantillasRepository
{
    public function ImprimirPlantillaOrdenServicio(Printer $printer,$ordenservicio)
    {
        $encabezado=$ordenservicio->impresora->tamaño_fuente_encabezado;
        $contenido=$ordenservicio->impresora->tamaño_fuente_contenido;
        $valorDomicilio=$ordenservicio->orden_encabezado->domicilio==1?$ordenservicio->domicilio:0;
        $propina=$ordenservicio->propina;
        $printer ->setTextSize($encabezado,$encabezado);      
        $printer -> text("========================\n");    
        $printer->setJustification(Printer::JUSTIFY_CENTER);        
        $printer -> text($ordenservicio-> empresa->nombre. "\n");    
        $printer ->setTextSize($contenido,$contenido);
        $printer->text($ordenservicio->empresa->nit."\n" );
        $printer->text($ordenservicio-> empresa->direccion."\n" );
        $printer->text($ordenservicio-> empresa->telefono."\n");
        $printer ->setTextSize($encabezado,$encabezado);              
        $printer -> text("========================\n");    
        $printer->text("======Encabezado======\n");
        $printer->setJustification(Printer::JUSTIFY_LEFT);        
        $printer ->setTextSize($contenido,$contenido);            
        $printer->text("Codigo:".$ordenservicio->orden_encabezado->codigo  .  "\n");
        $printer->text("Mesero:".$ordenservicio->orden_encabezado->empleado->nombre.' '.$ordenservicio->orden_encabezado->empleado->apellido  .  "\n");
        $printer->text("Fecha/hora:".$ordenservicio->orden_encabezado->fecha." ". $ordenservicio->orden_encabezado->hora."\n");
        $printer->text("Hora entrega:".$ordenservicio->orden_encabezado->hora_entrega ."\n");
        $printer->text("Estado:".$ordenservicio->orden_encabezado->estado->nombre. "\n");        
        if($ordenservicio->orden_encabezado->cliente!=null)
        {
            $printer->setJustification(Printer::JUSTIFY_CENTER);                    
            $printer ->setTextSize($encabezado,$encabezado);    
            $printer -> text("========================\n");    
            $printer->text("=========Cliente==========\n");
            $printer->setJustification(Printer::JUSTIFY_LEFT);        
            $printer ->setTextSize($contenido,$contenido);              
            $printer->text("Identificacion:".$ordenservicio->orden_encabezado->cliente->identificacion ."\n");
            $printer->text("Nombre:".$ordenservicio->orden_encabezado->cliente->nombre." ".$ordenservicio->orden_encabezado->cliente->apellido. "\n");
            $printer->text("Direccion:".$ordenservicio->orden_encabezado->cliente->direccion."\n");
            $printer->text("Telefono:".$ordenservicio->orden_encabezado->cliente->telefono."\n");
        }          
        if($ordenservicio->orden_encabezado->cabaña!=null)
        {
            $printer ->setTextSize($encabezado,$encabezado);              
            $printer->setJustification(Printer::JUSTIFY_CENTER);        
            $printer ->text("========================\n");    
            $printer->text("===========Mesa=========\n");        
            $printer->setJustification(Printer::JUSTIFY_LEFT);        
            $printer ->setTextSize($contenido,$contenido);              
            $printer->text("Codigo:".$ordenservicio->orden_encabezado->cabaña->codigo."\n");
            $printer->text("Nombre:".$ordenservicio->orden_encabezado->cabaña->nombre."\n");
            $printer->text("Nombre:".$ordenservicio->orden_encabezado->cabaña->capacidad."\n");        
        }
        $printer->setJustification(Printer::JUSTIFY_CENTER);        
        $printer ->setTextSize($encabezado,$encabezado);              
        $printer ->text("========================\n");    
        $printer->text("==========Detalle=======\n");
        $printer->setJustification(Printer::JUSTIFY_LEFT);        
        $printer ->setTextSize($contenido,$contenido);   
        $detalles=$ordenservicio->detalles;         
        foreach( $detalles as $item)
        {   
            $printer->text("**************\n");         
            $printer->text("Cantidad:".$item->cantidad."\n");
            $printer->text("Producto:".$item->producto->codigo.' - '.$item->producto->nombre." \n");
            $printer->text("Valor unitario:".$item->  valor_unitario."\n");
            $printer->text("Total:".$item->total."\n");
            $printer->text("**************\n");         
        }
        $printer ->setTextSize($encabezado,$encabezado);              
        $printer->setJustification(Printer::JUSTIFY_CENTER);        
        $printer -> text("========================\n");    
        if($ordenservicio->orden_encabezado->observaciones!="")
        {             
            $printer->text("=====Observaciones====\n");
            $printer->setJustification(Printer::JUSTIFY_LEFT);        
            $printer ->setTextSize($contenido,$contenido);              
            $printer->text($ordenservicio->orden_encabezado->observaciones."\n");
            $printer ->setTextSize($encabezado,$encabezado);              
            $printer->setJustification(Printer::JUSTIFY_CENTER);        
            $printer->text("========================\n");      
        }        
        if(count($ordenservicio->orden_encabezado->pagos)>0)
        {
            $printer->text("==========Totales=======\n");
            $printer->setJustification(Printer::JUSTIFY_LEFT);        
            $printer ->setTextSize($contenido,$contenido);     
            foreach($ordenservicio->orden_encabezado->pagos as $item)
            {
                $printer->text("Codigo: ".$item->codigo."\n");
                $printer->text("Fecga / hora: ".$item->fecha_hora."\n");
              //  $printer->text("Forma de pago: ".$item->forma_pago->nombre."\n");
                $printer->text("Subtotal: $".number_format( $item->subtotal)."\n");
                $printer->text("Impuesto: $".number_format( $item->impuesto)."\n");
                $printer->text("Descuento: $".number_format( $item->descuento)."\n");
                if($valorDomicilio!=0)
                {
                    $printer->text("Valor domicilio: $".number_format($valorDomicilio)."\n");
                }
                if($propina!=0)
                {
                    $printer->text("Propina voluntaria:  $".number_format( $item->total_pagar*$propina )."\n");                
                }
                $printer ->setTextSize($encabezado,$encabezado);              
                $printer->text("**************\n");         
                $printer->text("Total a pagar: $".number_format( $item->total_pagar+$valorDomicilio+$item->total_pagar*$propina)."\n");
                $printer->text("**************\n");                         
                $printer ->setTextSize($contenido,$contenido);     
                $printer->text("Recibido: $".number_format( $item->recibido)."\n");  
                $printer->text("Cambio: $".number_format( $item->cambio)."\n");             
                $printer->text("Observaciones: ".$item->observaciones."\n");                
            }  
            $printer ->setTextSize($encabezado,$encabezado);              
            $printer->setJustification(Printer::JUSTIFY_CENTER);        
            $printer -> text("========================\n");    
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
        $printer->text("=======Encabezado=======\n");
        $printer->setJustification(Printer::JUSTIFY_LEFT);        
        $printer ->setTextSize($contenido,$contenido);    
        $printer->text("Mesero:".$ordenservicio->orden_encabezado->empleado->nombre.' '.$ordenservicio->orden_encabezado->empleado->apellido  .  "\n");        
        $printer->text("Fecha/hora:".$ordenservicio->orden_encabezado->fecha." ". $ordenservicio->orden_encabezado->hora."\n");
        $printer->text("Hora entrega:".$ordenservicio->orden_encabezado->hora_entrega ."\n");        
        $printer ->setTextSize($encabezado,$encabezado);                      
        $printer->setJustification(Printer::JUSTIFY_CENTER);        
        $printer->text("========================\n");    
        $printer->text("=========Detalle========\n");
        $printer->setJustification(Printer::JUSTIFY_LEFT);        
        $printer ->setTextSize($contenido,$contenido);    
        $detalles=$ordenservicio->detalles;          
        foreach( $detalles as $item)
        {   
            $printer->text("**************\n");         
            $printer->text("Cantidad:".$item->cantidad."\n");
            $printer->text("Producto:".$item->producto->codigo.' - '.$item->producto->nombre." \n");
            $printer->text("**************\n");   
            if($item->producto->foraneo==1){
                $ingredientes=$item->producto->preparacions;
                foreach($ingredientes as $ingrediente)
                {
                    $printer->text("**************\n");         
                    $printer->text("Cantidad:".$ingrediente->cantidad."\n");
                    $printer->text("Ingrediente:".$ingrediente->materia_prima->codigo.' - '.$ingrediente->materia_prima->nombre." \n");
                    $printer->text("**************\n");   
                }
            }      
        }
        $printer ->setTextSize($encabezado,$encabezado);              
        $printer->setJustification(Printer::JUSTIFY_CENTER);        
        $printer->text("========================\n");      
        if($ordenservicio->orden_encabezado->observaciones!="")
        {              
            $printer->text("====Observaciones===\n");
            $printer->setJustification(Printer::JUSTIFY_LEFT);        
            $printer ->setTextSize($contenido,$contenido);              
            $printer->text($ordenservicio->orden_encabezado->observaciones."\n");
            $printer ->setTextSize($encabezado,$encabezado);              
            $printer->setJustification(Printer::JUSTIFY_CENTER);        
            $printer->text("========================\n");    
        }        
    }
}
