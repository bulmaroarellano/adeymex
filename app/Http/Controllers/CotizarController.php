<?php

namespace App\Http\Controllers;

use App\Models\Sepomex;
use App\Models\Sucursal;
use App\Services\FedexTarifas;
use Illuminate\Http\Request;
use stdClass;

class CotizarController extends Controller
{

    public function getCotizacion(Request $request)
    {

        $sucursal = Sucursal::where('id', $request->sucursal_id)->first();
        $sepomex = Sepomex::where('id', $request->destino)->first();

        $tarifas = new FedexTarifas('RdrCFt8NwQuVQaSK', 'Bbd1Nb5m4ekatPZiMp9BUEI3Y', '510087860', '119072943', 'NMP');
        // $tarifas = new FedexTarifas('4J4xrVU6gOh0EJ9p', 'Ko7Vmc7pJ3XryfZsXhKSm07op', '510087100', '119225568', 'NMP');

        $tarifas->version();
        $tarifas->remitente(['Col. Centro'], 'Toluca de Lerdo', 'EM', 50000, 'MX');
        $tarifas->destinatario([$sepomex->d_asenta], $sepomex->D_mnpio, 'EM', $sepomex->d_codigo, 'MX');
        $tarifas->paquetes((float)$request->peso, (int)$request->largo, (int)$request->ancho, (int) $request->alto);
        $rateReply = $tarifas->peticion();
        $successCotizacion = $rateReply->HighestSeverity;

        $values = new stdClass();
        $values->sucursal_id = $request->sucursal_id;
        // $values->destino = $request->destino;
        $values->destino = [
            $request->destino => "{$sepomex->d_codigo} {$sepomex->d_asenta} - {$sepomex->D_mnpio}, {$sepomex->d_estado}"
        ];

        $values->destinoCP = $request->destino;
        $values->origen = $request->origen;
        $values->type_paquete = $request->type_paquete;
        $values->cargo_logistica = $request->cargo_logistica;
        $values->largo = $request->largo;
        $values->ancho = $request->ancho;
        $values->alto = $request->alto;
        $values->peso = $request->peso;

        return redirect()->route('envios.index')->with([

            'rateReply' => $rateReply,
            'successCotizacion' => $successCotizacion,
            'values' => $values,
        ]);

        return view('/paqueteria/envios/envios');
    }
}
