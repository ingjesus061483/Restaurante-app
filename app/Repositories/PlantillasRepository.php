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
        $printer->text("==Observaciones=\n");
        $printer->setJustification(Printer::JUSTIFY_LEFT);        
        $printer ->setTextSize(1,1);              
        $printer->text($ordenservicio->orden_encabezado->observaciones."\n");
        
        $printer ->setTextSize(3,3);              
        $printer->setJustification(Printer::JUSTIFY_CENTER);          
        $printer->text("================\n");
        $printer->text("=====Totales====\n");
        $printer->text("================\n");

    }
}