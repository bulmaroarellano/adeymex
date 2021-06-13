<?php

namespace App\Services;

use DHL\Datatype\GB\Piece;
use DHL\Entity\GB\ShipmentRequest;

use DHL\Client\Web as WebserviceClient;
use DHL\Datatype\AM\Dutiable;
use DHL\Datatype\AM\ExportDeclaration;
use DHL\Datatype\AM\ExportLineItem;
use DHL\Datatype\AM\GrossWeight;
use DHL\Datatype\AM\Weight;

class DhlEnvio  
{

    private $envio;
    private $piece;
    
    public function __construct($_siteID, $_password) {
        
        $this->piece = new Piece();
        $this->envio = new ShipmentRequest();

        $this->envio->SiteID   = $_siteID; 
        $this->envio->Password = $_password; 

        $this->envio->MessageTime      = '2021-06-02T09:30:47-05:00';
        $this->envio->MessageReference = '1234567890123456789012345678901';
        $this->envio->RegionCode       = 'AM';
        $this->envio->NewShipper       = 'Y';
        $this->envio->LanguageCode     = 'es';
        $this->envio->PiecesEnabled    = 'Y';
        

    }


    public function facturacion($_accountNumber)
    {
        $this->envio->Billing->ShipperAccountNumber = $_accountNumber;
        $this->envio->Billing->ShippingPaymentType  = 'S';
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

        $this->envio->Shipper->ShipperID   = $_remitenteID;
        $this->envio->Shipper->CompanyName = $_compania;
        $this->envio->Shipper->addAddressLine($_direccion);
        $this->envio->Shipper->City = $_ciudad;

        $this->envio->Shipper->PostalCode  = $_codigoPostal;
        $this->envio->Shipper->CountryCode = 'MX';
        $this->envio->Shipper->CountryName = 'MEXICO';

        $this->envio->Shipper->Contact->PersonName  = $_nombre;
        $this->envio->Shipper->Contact->PhoneNumber = $_telefono;
        $this->envio->Shipper->Contact->Email       = $_email;
        
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
        $this->envio->Consignee->CompanyName = $_compania;
        $this->envio->Consignee->addAddressLine($_direccion);
        $this->envio->Consignee->City        = $_ciudad;
        $this->envio->Consignee->PostalCode  = $_codigoPostal;
        $this->envio->Consignee->CountryCode = $_codigoPais;
        $this->envio->Consignee->CountryName = $_nombrePais;
        $this->envio->Consignee->CountryName = $_nombrePais;
        $this->envio->Consignee->Contact->PersonName  = $_nombreRemitente;
        $this->envio->Consignee->Contact->PhoneNumber = $_telefonoRemitente;
        $this->envio->Consignee->Contact->Email       = $_emailRemitente;

    }

    public function setPaquete($_peso, $_largo, $_ancho, $_alto)
    {
        $this->envio->ShipmentDetails->NumberOfPieces = 1;
        $this->piece->PieceID = '1';
        
        $this->piece->Depth  = $_largo;
        $this->piece->Width  = $_ancho;
        $this->piece->Height = $_alto;
        $this->piece->Weight = $_peso;

        $this->envio->ShipmentDetails->addPiece($this->piece);

        
    }

    public function detallesEnvio($_pesoTotal, $_globalProductCode, $_localProductCode, $_descripcion)
    {
        
        $this->envio->ShipmentDetails->Weight     = $_pesoTotal;
        $this->envio->ShipmentDetails->WeightUnit = 'K';

        $this->envio->ShipmentDetails->GlobalProductCode = $_globalProductCode;
        $this->envio->ShipmentDetails->LocalProductCode  = $_localProductCode;
        
        $this->envio->ShipmentDetails->Date     = date('Y-m-d');
        $this->envio->ShipmentDetails->Contents = $_descripcion;
        $this->envio->ShipmentDetails->DoorTo   = 'DD';
        
        $this->envio->ShipmentDetails->DimensionUnit = 'C';
        $this->envio->ShipmentDetails->IsDutiable    = 'N';
        $this->envio->ShipmentDetails->CurrencyCode  = 'MXN';

        $this->envio->EProcShip = 'N';
        $this->envio->LabelImageFormat = 'PDF';
        $this->envio;

    }

    public function setInternational(
        $_pesoNeto,
        $_pesoBruto,
        $_declaredValue,
        $_precioUnitario, 
        $_productDescription, 
    )
    {
        $dutitable = new Dutiable();
        $dutitable->DeclaredValue = $_declaredValue;
        $dutitable->DeclaredCurrency = 'USD';

        $exportDeclaration = new ExportDeclaration();
        $exportDeclaration->InvoiceNumber = '1';
        $exportDeclaration->InvoiceDate = date('Y-m-d');

        $exportLineItem = new ExportLineItem();
        $exportLineItem->LineNumber ="1";
        $exportLineItem->Quantity = "2";
        $exportLineItem->QuantityUnit = 'PCS';
        $exportLineItem->Description= $_productDescription;
        $exportLineItem->Value = $_precioUnitario;

        $weight = new Weight();
        $weight->Weight = $_pesoNeto;
        $weight->WeightUnit = 'K';
        
        $grossWeight = new GrossWeight();
        $grossWeight->Weight = $_pesoBruto;
        $grossWeight->WeightUnit = 'K';

        $exportLineItem->Weight = $weight;
        $exportLineItem->GrossWeight = $grossWeight;
        
        $exportDeclaration->ExportLineItem = $exportLineItem;

    

        $this->shipment->UseDHLInvoice = 'Y';
        $this->shipment->Dutiable = $dutitable;
        $this->shipment->ExportDeclaration = $exportDeclaration;
    }

    public function getEnvio()
    {   
        
        $client = new WebserviceClient('staging');
        $respXML = $client->call($this->envio);

        // echo '<pre>';
        //     var_dump($respXML);
        // echo '</pre>';
        
        $xmltoJson =  simplexml_load_string($respXML, "SimpleXMLElement", LIBXML_NOCDATA);
        $json = json_encode($xmltoJson);
        $resp = json_decode($json,TRUE);
        
        // echo '<pre>';
        //     var_dump($resp);
        // echo '</pre>';

        // Store it as a . PDF file in the filesystem
        

        return $resp;

    }

}
