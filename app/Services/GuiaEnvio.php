<?php

namespace App\Services;

use App\Helpers\Helper;
use App\Models\Empresa;
use App\Models\Zip;
use App\Services\DhlEnvio;
use App\Services\FedexEnvios;

class GuiaEnvio  
{

    private $request;
    private $sucursal;
    private $remitente;
    private $destinatario;

    public function __construct($_request,$_sucursal, $_remitente, $_destinatario) {
        
        $this->request = $_request;
        $this->sucursal = $_sucursal;
        $this->remitente = $_remitente;
        $this->destinatario = $_destinatario;
    }

    public function getEnvioFedex()
    {
        
        $tipoPaquete = Helper::getTipoPaquete($this->request->type_paquete_fedex); 
        list($empresaRemitente, $empresaDestinatario, $countryCode, $countryName, $ciudad, $abreviacion) = $this->getDatosEnvio(
            $this->remitente->empresa_id, $this->destinatario->empresa_id, $this->request->id_cp_destinatario
        );

        $envio = new FedexEnvios('RdrCFt8NwQuVQaSK', 'Bbd1Nb5m4ekatPZiMp9BUEI3Y', '510087860', '119072943');
        $envio->configuraciones();

        $envio->remitenteEnvio(
            ['Col. Centro'],
            'Toluca de Lerdo',
            'EM',
            50000,
            'MX'
        ); // direccion de la sucursal  (data --> $sucursal )
        $envio->remitenteEnvioContacto(
            "{$this->remitente->nombre} {$this->remitente->apellido_paterno}",
            $this->remitente->telefono,
            $this->remitente->email,  
            $empresaRemitente ?? '',

        ); // datos de la persona que hace el pedido 
        
        $envio->destinatarioEnvio(
            [$this->destinatario->domicilio1, $this->destinatario->domicilio2, $this->destinatario->domicilio3],  // direcciones -domicilio1,2, 3
            $ciudad,
            $abreviacion, 
            (int)$this->request->destinatario_codigo_postal,
            $countryCode
        );
        $envio->destinatarioEnvioContacto(
            "{$this->destinatario->nombre} {$this->destinatario->apellido_paterno}",
            $this->destinatario->telefono,
        );
        $envio->descEnvio($this->request->paqueteria_code);
        $envio->setPaquete(
            $this->request,
            'paquetePrueba'
        );
        $envio->impuestos();

        if ( !( $this->request->country_code == "MX" )) {
            // ESTABLECER VALORES INTERNACIONALES
            $interData = array(
                "desc_producto" => $this->request->desc_producto,
                "cantidad" => $this->request->cantidad,
                "unidad_medida" => $this->request->unidad_medida,
                "precio_unitario" => $this->request->precio_unitario,
                "peso_neto" => $this->request->peso_neto,
                "peso_bruto" => $this->request->peso_bruto,
            );

            // return $interData;
            $envio->setInternational($interData);
        }

        
        $processShipmentReply =  $envio->getEnvio();
        $successEnvio = $processShipmentReply->HighestSeverity;

        return array($processShipmentReply, $successEnvio);

    }

    public function getEnvioDhl()
    {
        list($empresaRemitente, $empresaDestinatario, $countryCode, $countryName, $ciudad, $abreviacion) = $this->getDatosEnvio(
            $this->remitente->empresa_id, $this->destinatario->empresa_id, $this->request->id_cp_destinatario
        );

        $envio = new DhlEnvio('v62_9kV6umb2sA', 'ooc0Yf6DHG');
        $envio->facturacion('980055830');

        $envio->setRemitente(
            $this->remitente->id, 
            substr($empresaRemitente, 0, 20) ?? '', 
            'Col. Centro', 
            'Toluca de Lerdo', 
            '52280', 
            "{$this->remitente->nombre} {$this->remitente->apellido_paterno}", 
            $this->remitente->telefono, 
            $this->remitente->email
        );

        $envio->setDestinatario(
            substr($empresaDestinatario, 0, 20) ?? '',
            substr($this->destinatario->domicilio1, 0, 25),
            $ciudad,
            $this->request->destinatario_codigo_postal,
            $countryCode, 
            $countryName,
            "{$this->destinatario->nombre} {$this->destinatario->apellido_paterno}", 
            $this->destinatario->telefono, 
            $this->destinatario->email
        );

        $envio->setPaquete(
            $this->request->peso_paquete,
            $this->request->largo_paquete,
            $this->request->ancho_paquete,
            $this->request->alto_paquete
        );

        $envio->detallesEnvio(
            $this->request->peso_paquete,
            $this->request->paqueteria_code,
            $this->request->local_product_code,
            'paquete de prueba'
        );

        if ( !( $this->request->country_code == "MX" )) {
            // ESTABLECER VALORES INTERNACIONALES
            $interData = array(
                "desc_producto" => $this->request->desc_producto,
                "cantidad" => $this->request->cantidad,
                "unidad_medida" => $this->request->unidad_medida,
                "precio_unitario" => $this->request->precio_unitario,
                "peso_neto" => $this->request->peso_neto,
                "peso_bruto" => $this->request->peso_bruto,
            );
            // $envio->setInternational($interData, '30');
        }

        $requestShipment = $envio->getEnvio();
        $successEnvio    = $requestShipment['Note']['ActionNote'] ?? "error";

        return array($requestShipment, $successEnvio);

    }




    public function getDatosEnvio($remitente_empresa_id,$destinatario_empresa_id,  $id_zip)
    {
        $countryCode = Zip::where('id', $id_zip)->value('country_code');
        $countryName = Zip::where('id', $id_zip)->value('country_name');
        $ciudad      = Zip::where('id', $id_zip)->value('admin_name1');
        $abreviacion = Zip::where('id', $id_zip)->value('code_name1');
        $remitenteEmpresa    = Empresa::where('id', $remitente_empresa_id)->value('nombre');
        $destinatarioEmpresa = Empresa::where('id', $destinatario_empresa_id)->value('nombre');

        return array($remitenteEmpresa, $destinatarioEmpresa, $countryCode, $countryName, $ciudad, $abreviacion);
    }









}
