<?php
namespace App\Repositories;

use Mike42\Escpos\Printer;

class PlantillasRepository{
    public function ImprimirPlantillaOrdenServicio(Printer $printer,$ordenservicio)
    {
        $printer ->setTextSize(3,3);      
        $printer -> text("================\n");    
        $printer->setJustification(Printer::JUSTIFY_CENTER);        
        $printer -> text($ordenservicio-> empresa->nombre. "\n");    
        $printer ->setTextSize(2,2);
        $printer->text($ordenservicio->empresa->nit."\n" );
        $printer->text($ordenservicio-> empresa->direccion."\n" );
        $printer->text($ordenservicio-> empresa->telefono."\n");
        $printer ->setTextSize(3,3);              
        $printer->text("================\n");
        $printer->text("===Encabezado===\n");
        $printer->setJustification(Printer::JUSTIFY_LEFT);        
        $printer ->setTextSize(1,1);            
        $printer->text("Codigo:".$ordenservicio->orden_encabezado->codigo  .  "\n");
        $printer->text("Fecha/hora:".$ordenservicio->orden_encabezado->fecha." ". $ordenservicio->orden_encabezado->hora."\n");
        $printer->text("Hora entrega:".$ordenservicio->orden_encabezado->hora_entrega ."\n");
        $printer->text("Estado:".$ordenservicio->orden_encabezado->estado->nombre. "\n");        
        if($ordenservicio->orden_encabezado->cliente!=null)
        {
            $printer->setJustification(Printer::JUSTIFY_CENTER);                    
            $printer ->setTextSize(3,3);    
            $printer->text("================\n");
            $printer->text("=====Cliente====\n");
            $printer->setJustification(Printer::JUSTIFY_LEFT);        
            $printer ->setTextSize(1,1);              
            $printer->text("Identificacion:\n");
            $printer->text("Nombre:\n");
            $printer->text("Direccion:\n");
            $printer->text("Telefono:\n");
        }          
        if($ordenservicio->orden_encabezado->cabaña!=null)
        {
            $printer ->setTextSize(3,3);              
            $printer->setJustification(Printer::JUSTIFY_CENTER);        
            $printer->text("================\n");
            $printer->text("=====Kiosko=====\n");        
            $printer->setJustification(Printer::JUSTIFY_LEFT);        
            $printer ->setTextSize(1,1);              
            $printer->text("Codigo:".$ordenservicio->orden_encabezado->cabaña->codigo."\n");
            $printer->text("Nombre:".$ordenservicio->orden_encabezado->cabaña->nombre."\n");
            $printer->text("Nombre:".$ordenservicio->orden_encabezado->cabaña->capacidad."\n");        
        }
        $printer->setJustification(Printer::JUSTIFY_CENTER);        
        $printer ->setTextSize(3,3);              
        $printer->text("================\n");
        $printer->text("=====Detalle====\n");
        $printer->setJustification(Printer::JUSTIFY_LEFT);        
        $printer ->setTextSize(1,1);              
        foreach( $ordenservicio->orden_encabezado->orden_detalles as $item)
        {   
            $printer->text("**************\n");         
            $printer->text("Cantidad:".$item->cantidad."\n");
            $printer->text("Producto:".$item->producto->codigo.' - '.$item->producto->nombre." \n");
            $printer->text("Valor unitario:".$item->  valor_unitario."\n");
            $printer->text("Total:".$item->total."\n");
            $printer->text("**************\n");         
        }
        $printer ->setTextSize(3,3);              
        $printer->setJustification(Printer::JUSTIFY_CENTER);        
        $printer->text("================\n");      
        if($ordenservicio->orden_encabezado->observaciones!="")
        {
              
            $printer->text("==Observaciones=\n");
            $printer->setJustification(Printer::JUSTIFY_LEFT);        
            $printer ->setTextSize(1,1);              
            $printer->text($ordenservicio->orden_encabezado->observaciones."\n");
            $printer ->setTextSize(3,3);              
            $printer->setJustification(Printer::JUSTIFY_CENTER);        
            $printer->text("================\n");   
        }        
        if(count($ordenservicio->orden_encabezado->pagos)>0)
        {
            $printer->text("=====Totales====\n");
            $printer->setJustification(Printer::JUSTIFY_LEFT);        
            $printer ->setTextSize(1,1);     
            foreach($ordenservicio->orden_encabezado->pagos as $item)
            {
                $printer->text("Codigo: ".$item->codigo."\n");
                $printer->text("Fecga / hora: ".$item->fecha_hora."\n");
                $printer->text("Forma de pago: ".$item->forma_pago->nombre."\n");
                $printer->text("Subtotal: ".$item->subtotal."\n");
                $printer->text("Impuesto: ". $item->impuesto."\n");
                $printer->text("Deswcuento: ".$item->descuento."\n");
                $printer->text("Total a pagar: ".$item->total_pagar."\n");
                $printer->text("Recibido: ".$item->recibido."\n");  
                $printer->text("Cambio: ".$item->cambio."\n");
                $printer->text("Observaciones: ".$item->observaciones."\n");                
            }  
            $printer ->setTextSize(3,3);              
            $printer->setJustification(Printer::JUSTIFY_CENTER);        
            $printer->text("================\n");
        }        
    }
    public function ImprimirPlantillaComanda(Printer $printer,$ordenservicio)
    {
        $printer ->setTextSize(3,3);      
        $printer -> text("================\n");    
        $printer->setJustification(Printer::JUSTIFY_CENTER);        
        $printer -> text($ordenservicio-> empresa->nombre. "\n");    
        $printer ->setTextSize(2,2);
        $printer->text($ordenservicio->empresa->nit."\n" );        
        $printer ->setTextSize(3,3);                      
        $printer->setJustification(Printer::JUSTIFY_CENTER);        
        $printer ->setTextSize(3,3);              
        $printer->text("================\n");
        $printer->text("=====Detalle====\n");
        $printer->setJustification(Printer::JUSTIFY_LEFT);        
        $printer ->setTextSize(1,1);              
        foreach( $ordenservicio->orden_encabezado->orden_detalles as $item)
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
        $printer ->setTextSize(3,3);              
        $printer->setJustification(Printer::JUSTIFY_CENTER);        
        $printer->text("================\n");      
        if($ordenservicio->orden_encabezado->observaciones!="")
        {              
            $printer->text("==Observaciones=\n");
            $printer->setJustification(Printer::JUSTIFY_LEFT);        
            $printer ->setTextSize(1,1);              
            $printer->text($ordenservicio->orden_encabezado->observaciones."\n");
            $printer ->setTextSize(3,3);              
            $printer->setJustification(Printer::JUSTIFY_CENTER);        
            $printer->text("================\n");   
        }        
    }
}
