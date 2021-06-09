<?php

namespace App\Http\Controllers;

use App\Models\Envio;
use App\Services\FedexTrack;
use Illuminate\Http\Request;

class TrackingController extends Controller
{
    public function track(Envio $envio)
    {

        if ($envio->paqueteria == "FEDEX") {
            
            $tracking = new FedexTrack('4J4xrVU6gOh0EJ9p', 'Ko7Vmc7pJ3XryfZsXhKSm07op', '510087100', '119225568');
            $tracking->setGuia($envio->numero_guia);
            $trackReply = $tracking->getTracking();

            $completedTrackDetail = $trackReply->CompletedTrackDetails[0];
            $trackDetail = $completedTrackDetail->TrackDetails[0];
            $statusDetailCode = $trackDetail->StatusDetail->Code;
            
            return $statusDetailCode;
        }

        return view('/paqueteria/envios/envios'); 
        
    }
}
