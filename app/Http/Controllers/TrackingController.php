<?php

namespace App\Http\Controllers;

use App\Models\Envio;
use App\Services\FedexTrack;
use Illuminate\Http\Request;

class TrackingController extends Controller
{
    public function track(Envio $envio)
    {
        // return $envio;

        if ($envio->paqueteria == "FEDEX") {
            
            $tracking = new FedexTrack('4J4xrVU6gOh0EJ9p', 'Ko7Vmc7pJ3XryfZsXhKSm07op', '510087100', '119225568');
            $tracking->setGuia($envio->master_guia);
            $trackReply = $tracking->getTracking();

            $completedTrackDetail = $trackReply->CompletedTrackDetails[0];
            $trackDetail = $completedTrackDetail->TrackDetails[0];
            
            $statusEnvio = Envio::select('status_envio')->where('id', $envio->id);
            
            if ( $statusEnvio != $envio->status_envio) { // si son diferentes actalizar parametro 
                $descripcionStatus= $trackDetail->StatusDetail->Description;    
                $envio = Envio::where('id', $envio->id)->update(['status_envio' => $descripcionStatus]);
            } 

        }

        // return view('/paqueteria/envios/envios'); 
        
    }
}
