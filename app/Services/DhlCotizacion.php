<?php

namespace App\Services;

use DHL\Entity\AM\GetQuote;
use DHL\Datatype\AM\PieceType;
use DHL\Client\Web as WebserviceClient;
use DHL\Datatype\AM\DCTDutiable;
use DHL\Datatype\AM\Dutiable;

class DhlCotizacion
{

    private $cotizacion ;
  

    public function __construct($_siteID, $_password) {

        
        
        $this->cotizacion = new GetQuote();
        $this->cotizacion->SiteID = $_siteID;
        $this->cotizacion->Password = $_password;

        $this->cotizacion->MessageTime = '2021-05-25T09:30:47-05:00';
        $this->cotizacion->MessageReference = '1234567890123456789012345678901';
        $this->cotizacion->BkgDetails->Date = date('Y-m-d');
        $this->cotizacion->BkgDetails->InsuredCurrency = 'MXN';
        $this->cotizacion->SoftwareName = 'ADEyMEX';
        $this->cotizacion->SoftwareVersion = '1.0';

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

    public function setPaquetes($request)
    {
        $largo = $request->largo;
        $ancho = $request->ancho;
        $alto  = $request->alto;
        $peso  = $request->peso;
        

        foreach ($largo as $key => $larg) {
            $piece = new PieceType();
            $piece->PieceID = ( $key + 1 );
            $piece->Depth = $larg;
            $piece->Width = $ancho[$key];
            $piece->Height = $alto[$key];
            $piece->Weight = $peso[$key];
            $this->cotizacion->BkgDetails->addPiece($piece);

        }
        if ( ! ($request->country_code == "MX") ) {
            
            $dutitable = new DCTDutiable();
            $dutitable->DeclaredValue = '100';
            $dutitable->DeclaredCurrency = 'USD';
            $this->cotizacion->BkgDetails->IsDutiable = 'Y';   
            $this->cotizacion->Dutiable = $dutitable;
        }{
            $this->cotizacion->BkgDetails->IsDutiable = 'N';   

        }

        $this->cotizacion->BkgDetails->ReadyTime = 'PT17H20M';
        $this->cotizacion->BkgDetails->ReadyTimeGMTOffset = '+01:00';
        $this->cotizacion->BkgDetails->DimensionUnit = 'CM';
        $this->cotizacion->BkgDetails->WeightUnit = 'KG';
        $this->cotizacion->BkgDetails->PaymentCountryCode = 'MX';
        $this->cotizacion->BkgDetails->QtdShp->QtdShpExChrg->SpecialServiceType = 'WY';
        


    }

    public function getCotizacion()
    {
        $client = new WebserviceClient('staging');
        $respXML = $client->call($this->cotizacion);

        $xmltoJson =  simplexml_load_string($respXML, "SimpleXMLElement", LIBXML_NOCDATA);

        $json = json_encode($xmltoJson);
        $resp = json_decode($json,TRUE);

        // echo '<pre>';
            // var_dump($resp['GetQuoteResponse']);
            // var_dump($resp);
        // echo '</pre>';

        return $resp['GetQuoteResponse'];
    }

    



}
