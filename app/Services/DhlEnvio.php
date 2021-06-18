<?php

namespace App\Services;

use App\Models\Invoice;
use App\Models\Paquete;
use DHL\Datatype\GB\Piece;


use DHL\Client\Web as WebserviceClient;
use DHL\Datatype\AM\Dutiable;
use DHL\Datatype\AM\ExportDeclaration;
use DHL\Datatype\AM\ExportLineItem;
use DHL\Datatype\AM\GrossWeight;
use DHL\Datatype\AM\Weight;
use DHL\Entity\AM\ShipmentRequest;

class DhlEnvio  
{

    private $shipment;
    private $pesoTotal;
    private $paquetes ;

    
    public function __construct($_siteID, $_password) {
        
        
        $this->shipment = new ShipmentRequest();

        $this->shipment->SiteID   = $_siteID; 
        $this->shipment->Password = $_password; 

        $this->shipment->MessageTime      = '2021-06-02T09:30:47-05:00';
        $this->shipment->MessageReference = '1234567890123456789012345678901';
        $this->shipment->SoftwareName = 'ADEyMEX';
        $this->shipment->SoftwareVersion = '1.0';
        $this->shipment->RegionCode       = 'AM';
        $this->shipment->NewShipper       = 'Y';
        $this->shipment->LanguageCode     = 'es';
        $this->shipment->PiecesEnabled    = 'Y';

        $this->pesoTotal = 0;
        

    }


    public function facturacion($_accountNumber)
    {
        $this->shipment->Billing->ShipperAccountNumber = $_accountNumber;
        $this->shipment->Billing->ShippingPaymentType  = 'S';
    }

    public function setRemitente(
        $_remitenteID,
        $_compania,
        $_direccion,
        $_ciudad,
        $_codigoPostal,
        $_nombre, 
        $_telefono,
        $_email
    )
    {   

        $this->shipment->Shipper->ShipperID   = $_remitenteID;
        $this->shipment->Shipper->CompanyName = $_compania;
        $this->shipment->Shipper->addAddressLine($_direccion);
        $this->shipment->Shipper->City = $_ciudad;

        $this->shipment->Shipper->PostalCode  = $_codigoPostal;
        $this->shipment->Shipper->CountryCode = 'MX';
        $this->shipment->Shipper->CountryName = 'MEXICO';

        $this->shipment->Shipper->Contact->PersonName  = $_nombre;
        $this->shipment->Shipper->Contact->PhoneNumber = $_telefono;
        $this->shipment->Shipper->Contact->Email       = $_email;
        
    }

    public function setDestinatario(
        $_compania,
        $_direccion,
        $_ciudad,
        $_codigoPostal,
        $_codigoPais,
        $_nombrePais, 
        $_nombreRemitente,
        $_telefonoRemitente,
        $_emailRemitente,

    ){
        $this->shipment->Consignee->CompanyName = $_compania;
        $this->shipment->Consignee->addAddressLine($_direccion);
        $this->shipment->Consignee->City        = $_ciudad;
        $this->shipment->Consignee->PostalCode  = $_codigoPostal;
        $this->shipment->Consignee->CountryCode = $_codigoPais;
        $this->shipment->Consignee->CountryName = $_nombrePais;
        $this->shipment->Consignee->CountryName = $_nombrePais;
        $this->shipment->Consignee->Contact->PersonName  = $_nombreRemitente;
        $this->shipment->Consignee->Contact->PhoneNumber = $_telefonoRemitente;
        $this->shipment->Consignee->Contact->Email       = $_emailRemitente;

    }

    public function setPaquete($request)
    {
        $this->paquetes = $request;

        $largo = $request->largo_paquete;
        $ancho = $request->ancho_paquete;
        $alto  = $request->alto_paquete;
        $peso  = $request->peso_paquete;
        $this->shipment->ShipmentDetails->NumberOfPieces = count($largo);

        foreach ($largo as $key => $larg) {
            $piece = new Piece();
            $piece->PieceID = ($key + 1);
            $piece->Depth = $larg;
            $piece->Width = $ancho[$key];
            $piece->Height = $alto[$key];
            $piece->Weight = $peso[$key];

            $this->pesoTotal+= $peso[$key];
            $this->shipment->ShipmentDetails->addPiece($piece);
        }

        
    }

    public function detallesEnvio($_globalProductCode, $_localProductCode, $_descripcion)
    {
        
        $this->shipment->ShipmentDetails->Weight     = $this->pesoTotal;
        $this->shipment->ShipmentDetails->WeightUnit = 'K';

        $this->shipment->ShipmentDetails->GlobalProductCode = $_globalProductCode;
        $this->shipment->ShipmentDetails->LocalProductCode  = $_localProductCode;
        
        $this->shipment->ShipmentDetails->Date     = date('Y-m-d');
        $this->shipment->ShipmentDetails->Contents = $_descripcion;
        $this->shipment->ShipmentDetails->DoorTo   = 'DD';
        
        $this->shipment->ShipmentDetails->DimensionUnit = 'C';
        $this->shipment->ShipmentDetails->IsDutiable    = 'N';
        $this->shipment->ShipmentDetails->CurrencyCode  = 'MXN';

        $this->shipment->EProcShip = 'N';
        $this->shipment->LabelImageFormat = 'PDF';


    }

    public function setInternational(array $dataInter, $_declaredValue )
    {
        $dutitable = new Dutiable();
        $dutitable->DeclaredValue = $_declaredValue;
        $dutitable->DeclaredCurrency = 'USD';

        $exportDeclaration = new ExportDeclaration();
        $exportDeclaration->InvoiceNumber = '1';
        $exportDeclaration->InvoiceDate = date('Y-m-d');
        // $exportDeclaration->InterConsignee = 'Intermediate Consignee';
        // $exportDeclaration->IsPartiesRelation = 'N';
        $this->shipment->ExportDeclaration = $exportDeclaration;

        // $lineItems = array();
        $descripciones = $dataInter['desc_producto'];
        $pesosNeto = $dataInter['peso_neto'];
        $cantidades = $dataInter['cantidad'];
        $unidades = $dataInter['unidad_medida'];
        $precios = $dataInter['precio_unitario'];

        foreach ($descripciones as $key => $value) {

            $exportLineItem = new ExportLineItem();
            $exportLineItem->LineNumber ="1";
            $exportLineItem->Quantity = $cantidades[$key];
            $exportLineItem->QuantityUnit = $unidades[$key];
            $exportLineItem->Description= $value;
            $exportLineItem->Value = $precios[$key];

            $weight = new Weight();
            $weight->Weight = $pesosNeto[$key];
            $weight->WeightUnit = 'K';
            
            $grossWeight = new GrossWeight();
            $grossWeight->Weight = $pesosNeto[$key];
            $grossWeight->WeightUnit = 'K';

            $exportLineItem->Weight = $weight;
            $exportLineItem->GrossWeight = $grossWeight;
            
            
            
            $this->shipment->ExportDeclaration->addExportLineItem($exportLineItem);
        }
        

        $this->shipment->UseDHLInvoice = 'Y';
        $this->shipment->Dutiable = $dutitable;
        
    }

    public function getEnvio(bool $inter)
    {   
        
        $client = new WebserviceClient('staging');
        $respXML = $client->call($this->shipment);

        $xmltoJson =  simplexml_load_string($respXML, "SimpleXMLElement", LIBXML_NOCDATA);
        $json = json_encode($xmltoJson);
        $requestShipment = json_decode($json,TRUE);

        // echo '<pre>';
        //     var_dump($requestShipment);
        // echo '</pre>';

        $successEnvio = $requestShipment['Note']['ActionNote'] ?? "error";
        $tipoServicio = $requestShipment['ProductShortName'];
        $masterGuia = $requestShipment['AirwayBillNumber'];
        $contentGuia = $requestShipment['LabelImage']['OutputImage'];
        $this->saveGuias($masterGuia,$contentGuia);

        $this->savePaquete($masterGuia);

        if ($inter) {
            $contentInvoice = $requestShipment['LabelImage']['MultiLabels']['MultiLabel']['DocImageVal'];
            $this->saveCommercialInvoice($masterGuia, $contentInvoice);
        }

        return array($masterGuia, $successEnvio, $tipoServicio);

    }

    public function saveGuias($urlGuia, $contentGuia)
    {

        //! Checar en los multiples envios si solo me da una sola guia maestra
        //* envio/ --> master-
        $urlSlaveGuia = "dhl-guias/envio-{$urlGuia}.pdf";
        file_put_contents( $urlSlaveGuia, base64_decode( $contentGuia ) );
    }


    public function saveCommercialInvoice($masterGuia,$contentGuia)
    {
        $urlGuiaInvoice = "dhl-guias/invoice-{$masterGuia}.pdf";
        file_put_contents( $urlGuiaInvoice, base64_decode( $contentGuia ) );
        Invoice::create([
            'master_guia' => $masterGuia, 
            'invoice_guia' => "invoice-{$masterGuia}", 
            'url_invoice_guia' => $urlGuiaInvoice, 
        ]);
    }

    public function savePaquete($numeroGuia)
    {

        $largo = $this->paquetes->largo_paquete;
        $ancho = $this->paquetes->ancho_paquete;
        $alto  = $this->paquetes->alto_paquete;
        $peso  = $this->paquetes->peso_paquete;

        foreach ($largo as $key => $larg) {
            Paquete::create([
                'numero_guia' => $numeroGuia, 
                'largo_paquete' => $larg, 
                'ancho_paquete' => $ancho[$key], 
                'alto_paquete' => $alto[$key], 
                'peso_paquete' => $peso[$key], 
            ]);
        }
        
    }

}
