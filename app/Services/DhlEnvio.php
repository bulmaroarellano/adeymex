<?php

namespace App\Services;

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
    private $piece;
    
    public function __construct($_siteID, $_password) {
        
        $this->piece = new Piece();
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

    public function setPaquete($_peso, $_largo, $_ancho, $_alto)
    {
        $this->shipment->ShipmentDetails->NumberOfPieces = 1;
        $this->piece->PieceID = '1';
        
        $this->piece->Depth  = $_largo;
        $this->piece->Width  = $_ancho;
        $this->piece->Height = $_alto;
        $this->piece->Weight = $_peso;

        $this->shipment->ShipmentDetails->addPiece($this->piece);

        
    }

    public function detallesEnvio($_pesoTotal, $_globalProductCode, $_localProductCode, $_descripcion)
    {
        
        $this->shipment->ShipmentDetails->Weight     = $_pesoTotal;
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
        $this->shipment;

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

    public function getEnvio()
    {   
        
        $client = new WebserviceClient('staging');
        $respXML = $client->call($this->shipment);

        // echo '<pre>';
        //     var_dump($respXML);
        // echo '</pre>';
        
        $xmltoJson =  simplexml_load_string($respXML, "SimpleXMLElement", LIBXML_NOCDATA);
        $json = json_encode($xmltoJson);
        $resp = json_decode($json,TRUE);
        
        echo '<pre>';
            var_dump($resp);
        echo '</pre>';

        // Store it as a . PDF file in the filesystem
        

        return $resp;

    }

}
