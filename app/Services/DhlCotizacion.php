<?php

namespace App\Services;

use DHL\Entity\AM\GetQuote;
use DHL\Datatype\AM\PieceType;
use DHL\Client\Web as WebserviceClient;

class DhlCotizacion
{

    private $cotizacion ;
    private $piece;

    public function __construct($_siteID, $_password) {

        $this->piece = new PieceType();
        
        $this->cotizacion = new GetQuote();
        $this->cotizacion->SiteID = $_siteID;
        $this->cotizacion->Password = $_password;

        $this->cotizacion->MessageTime = '2021-05-25T09:30:47-05:00';
        $this->cotizacion->MessageReference = '1234567890123456789012345678901';
        $this->cotizacion->BkgDetails->Date = date('Y-m-d');
        $this->cotizacion->BkgDetails->InsuredCurrency = 'MXN';

    }


    public function setPaquete($peso, $largo, $ancho, $alto)
    {
        $this->piece->PieceID = 1;
        $this->piece->Depth = $largo;
        $this->piece->Width = $ancho;
        $this->piece->Height = $alto;
        $this->piece->Weight = $peso;

        $this->cotizacion->BkgDetails->addPiece($this->piece);
        
        $this->cotizacion->BkgDetails->ReadyTime = 'PT17H20M';
        $this->cotizacion->BkgDetails->ReadyTimeGMTOffset = '+01:00';
        $this->cotizacion->BkgDetails->DimensionUnit = 'CM';
        $this->cotizacion->BkgDetails->WeightUnit = 'KG';
        $this->cotizacion->BkgDetails->PaymentCountryCode = 'MX';
        $this->cotizacion->BkgDetails->IsDutiable = 'N';   // es obligatorio

        $this->cotizacion->BkgDetails->QtdShp->QtdShpExChrg->SpecialServiceType = 'WY';
    }


    public function setRemitente($countryCode, $postalCode, $city)
    {
        $this->cotizacion->From->CountryCode = $countryCode;
        $this->cotizacion->From->Postalcode = $postalCode;
        $this->cotizacion->From->City = $city;
    }

    public function setDestinatario($countryCode, $postalCode, $city)
    {
        $this->cotizacion->To->CountryCode = $countryCode;
        $this->cotizacion->To->Postalcode = $postalCode;
        $this->cotizacion->To->City = $city;
    }

    public function getCotizacion()
    {
        $client = new WebserviceClient('staging');
        $respXML = $client->call($this->cotizacion);

        $xmltoJson =  simplexml_load_string($respXML, "SimpleXMLElement", LIBXML_NOCDATA);

        $json = json_encode($xmltoJson);
        $resp = json_decode($json,TRUE);

        // echo '<pre>';
        //     var_dump($resp['GetQuoteResponse']);
        //     var_dump($resp);
        // echo '</pre>';

        return $resp['GetQuoteResponse'];
    }

    



}
