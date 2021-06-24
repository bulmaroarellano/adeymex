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

        // return $request;

        $sucursal = Sucursal::where('id', $request->sucursal_id)->first();
        $zip = Zip::where('id', $request->destino)->first();

        $values = new stdClass();
        $values->sucursal_id = $request->sucursal_id;
        $values->destinoCP = $request->destino;
        $values->origen = $request->origen;
        $values->cargo_logistica = $request->cargo_logistica;
        $values->country_code = $request->country_code;
        
        $values->destino = [
            $request->destino => "{$zip->postal_code} {$zip->place_name} - {$zip->admin_name2}, {$zip->admin_name1}"
        ];

        if ($request->country_code != 'MX') {

            // Internacionales
            $rateReply = $this->getCotizacionFedex($request, $zip); // FEDEX
            $quoteResponse = $this->getCotizacionDhl($request, $zip); // DHL 
            $rateResponse = $this->getCotizacionUps($request, $zip); // UPS
        
            return redirect()->route('envios.index')->with([
                'rateReply' => $rateReply,
                'quoteResponse' => $quoteResponse,
                'rateResponse' => $rateResponse,
                'values' => $values,
                'countryCode' => $request->country_code,
                'type_paquete' => $request->type_paquete,
                'largo' => $request->largo,
                'ancho' => $request->ancho,
                'alto' => $request->alto,
                'peso' => $request->peso,
            ]);
        }else{
            // Nacionales
            $rateReply = $this->getCotizacionFedex($request, $zip); // FEDEX
            $quoteResponse = $this->getCotizacionDhl($request, $zip); // DHL 
            
        
            return redirect()->route('envios.index')->with([
                'rateReply' => $rateReply,
                'quoteResponse' => $quoteResponse,
                'values' => $values,
                'countryCode' => $request->country_code,
                'type_paquete' => $request->type_paquete,
                'largo' => $request->largo,
                'ancho' => $request->ancho,
                'alto' => $request->alto,
                'peso' => $request->peso,
            ]);

        }
            
        
        
    }

    public function getCotizacionFedex($request, $zip)
    {
      
        $tarifas = new FedexTarifas('RdrCFt8NwQuVQaSK', 'Bbd1Nb5m4ekatPZiMp9BUEI3Y', '510087860', '119072943', 'NMP');
        // $tarifas = new FedexTarifas('4J4xrVU6gOh0EJ9p', 'Ko7Vmc7pJ3XryfZsXhKSm07op', '510087100', '119225568', 'NMP');
        $tarifas->version();
        $tarifas->remitente(['Col. Centro'], 'Toluca de Lerdo', 'EM', 50000, 'MX');
        //!  FALTA ABREVIACION
        $tarifas->destinatario([$zip->place_name], $zip->admin_name2, $zip->code_name1, $zip->postal_code, $zip->country_code);
        $tarifas->paquetes(
            $request
        );
        $rateReply = $tarifas->peticion();
        
        

        return $rateReply;

    }


    public function getCotizacionDhl($request, $zip)
    {
        $tarifas = new DhlCotizacion('v62_9kV6umb2sA', 'ooc0Yf6DHG');

        // $tarifas->setRemitente('MX', '50000', 'Toluca de lerdo');
        $tarifas->setRemitente('MX', '52280', 'Toluca');
        $tarifas->setDestinatario($zip->country_code,$zip->postal_code ,$zip->admin_name2);
        $tarifas->setPaquetes($request);
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
        $tarifas->setPaquete($request);
        $rateResponse = $tarifas->getTarifa();

        return $rateResponse;
        
    }


}
