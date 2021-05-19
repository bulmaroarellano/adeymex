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

        $tarifas->version();
        $tarifas->remitente(['Col. Centro'], 'Toluca de Lerdo', 'EM', 50000, 'MX');
        $tarifas->destinatario([$sepomex->d_asenta], $sepomex->D_mnpio, 'EM', $sepomex->d_codigo, 'MX');
        $tarifas->paquetes((int)$request->peso, (int)$request->largo, (int)$request->ancho, (int) $request->alto);
        $rateReplyDetails = $tarifas->peticion();

        $values = new stdClass();
        $values->sucursal_id = $request->sucursal_id;
        // $values->destino = $request->destino;
        $values->destino = [
            $request->destino => "{$sepomex->d_codigo} {$sepomex->d_asenta} - {$sepomex->D_mnpio}, {$sepomex->d_estado}"
        ];

        $values->destinoCP = $request->destino;
        $values->origen = $request->origen;
        $values->type_paquete = $request->type_paquete;
        $values->largo = $request->largo;
        $values->ancho = $request->ancho;
        $values->alto = $request->alto;
        $values->peso = $request->peso;

        return redirect()->route('envios.index')->with([

            'rateReplyDetails' => $rateReplyDetails,
            'values' => $values,
        ]);

        return view('/paqueteria/envios/envios');
    }
}
