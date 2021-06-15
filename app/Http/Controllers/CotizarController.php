<?php

namespace App\Http\Controllers;

use App\Models\Sepomex;
use App\Models\Sucursal;
use App\Models\Zip;
use App\Services\DhlCotizacion;
use App\Services\FedexTarifas;
use App\Services\UpsTarifas;
use Illuminate\Http\Request;
use stdClass;

class CotizarController extends Controller
{

    public function getCotizacion(Request $request)
    {
    //    return $request;

        $sucursal = Sucursal::where('id', $request->sucursal_id)->first();
        // $sepomex = Sepomex::where('id', $request->destino)->first();
        $zip = Zip::where('id', $request->destino)->first();

        $values = new stdClass();
        $values->sucursal_id = $request->sucursal_id;
        
        $values->destinoCP = $request->destino;
        $values->origen = $request->origen;
        $values->type_paquete = $request->type_paquete;
        $values->cargo_logistica = $request->cargo_logistica;
        $values->largo = $request->largo;
        $values->ancho = $request->ancho;
        $values->alto = $request->alto;
        $values->peso = $request->peso;

        $values->country_code = $request->country_code;
        $values->seguro_envio = $request->seguro_envio;
        
        // $values = $request;
        $values->destino = [
            $request->destino => "{$zip->postal_code} {$zip->place_name} - {$zip->admin_name2}, {$zip->admin_name1}"
        ];


        
            
        $rateReply = $this->getCotizacionFedex($request, $zip); // FEDEX
        $quoteResponse = $this->getCotizacionDhl($request, $zip); // DHL 
        $rateResponse = $this->getCotizacionUps($request, $zip); // UPS
        
        return redirect()->route('envios.index')->with([
            'rateReply' => $rateReply,
            'quoteResponse' => $quoteResponse,
            'rateResponse' => $rateResponse,
            'values' => $values,
            'countryCode' => $request->country_code,
        ]);
        
    }

    public function getCotizacionFedex($request, $zip)
    {
      
        $tarifas = new FedexTarifas('RdrCFt8NwQuVQaSK', 'Bbd1Nb5m4ekatPZiMp9BUEI3Y', '510087860', '119072943', 'NMP');
        // $tarifas = new FedexTarifas('4J4xrVU6gOh0EJ9p', 'Ko7Vmc7pJ3XryfZsXhKSm07op', '510087100', '119225568', 'NMP');
        $tarifas->version();
        $tarifas->remitente(['Col. Centro'], 'Toluca de Lerdo', 'EM', 50000, 'MX');
        //!  FALTA ABREVIACION
        $tarifas->destinatario([$zip->place_name], $zip->admin_name2, $zip->code_name1, $zip->postal_code, $zip->country_code);
        $tarifas->paquetes((float)$request->peso, (int)$request->largo, (int)$request->ancho, (int) $request->alto);
        $rateReply = $tarifas->peticion();
        
        

        return $rateReply;

    }


    public function getCotizacionDhl($request, $zip)
    {
        $tarifas = new DhlCotizacion('v62_9kV6umb2sA', 'ooc0Yf6DHG');
        $tarifas->setPaquete((float) $request->peso, (int) $request->largo, (int) $request->ancho, (int) $request->alto);
        // $tarifas->setPaquete(10, 5, 10, 10);

        // $tarifas->setRemitente('MX', '50000', 'Toluca de lerdo');
        $tarifas->setRemitente('MX', '52280', 'Toluca');
        $tarifas->setDestinatario($zip->country_code,$zip->postal_code ,$zip->admin_name2);
        // $tarifas->setDestinatario('US', '36532', 'Alabama');
        $getQuoteResponse = $tarifas->getCotizacion();

        return $getQuoteResponse;

    }

    public function getCotizacionUps($request, $zip)
    {

        $tarifas = new UpsTarifas('FD890B5FA3A41F75', '795ITMEX5345', '710IX24ZQ496');
        $tarifas->setContactoRemitente(
            '', 
            '', 
            '',
            '', 
            '', 
            '', 
            '50000',
            'MX'
        );
        $tarifas->enviarTo(
            '', 
            '', 
            '', 
            '', 
            $zip->code_name1, 
            $zip->postal_code, 
            $zip->country_code
        );
        $tarifas->setPaquete((float)$request->peso, (int) $request->alto, (int) $request->largo,(int) $request->ancho);
        $rateResponse = $tarifas->getTarifa();
   

        return $rateResponse;
        
    }


}
