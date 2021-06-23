<?php
namespace App\Services;


use DHL\Client\Web as WebserviceClient;

use DHL\Datatype\AM\Pickup;
use DHL\Datatype\AM\PickupContact;
use DHL\Datatype\AM\PickupPlace;
use DHL\Datatype\AM\Requestor;
use DHL\Datatype\AM\RequestorContact;
use DHL\Entity\AM\BookPickupRequest;


class DhlPickUp  
{

    private $pickUp;
    

    public function __construct($_siteID, $_password) {
        $this->pickUp = new BookPickupRequest();

        $this->pickUp->SiteID   = $_siteID; 
        $this->pickUp->Password = $_password;

        $this->pickUp->MessageTime      = '2021-06-02T09:30:47-05:00';
        $this->pickUp->MessageReference = '1234567890123456789012345678901';
        $this->pickUp->SoftwareName     = 'ADEyMEX';
        $this->pickUp->SoftwareVersion  = '1.0';

    }

    public function setRecolector(
        $_accountNumber,
        $_direccion,
        $_ciudad,
        $_countryCode,
        $_nombreUsuario,
        $_telefonoUsuario
    )
    {

        $requestor = new Requestor();
        $requestor->AccountType = 'D';
        $requestor->AccountNumber = $_accountNumber;
        $requestor->Address1 = $_direccion;
        $requestor->City = $_ciudad;
        $requestor->CountryCode = $_countryCode;

        $requestorContact = new RequestorContact();
        $requestorContact->PersonName = $_nombreUsuario;
        $requestorContact->Phone = $_telefonoUsuario;
        
        $requestor->RequestorContact = $requestorContact;

        $this->pickUp->Requestor = $requestor;
    }

    public function setDireccionPickUp($_direccion, $_ciudad, $_postalCode, $_countryCode)
    {
        
        $place = new PickupPlace();
        $place->LocationType = 'B';
        $place->CompanyName  = 'Adeymex';
        $place->Address1     = $_direccion;
        $place->City         = $_ciudad;
        $place->PostalCode   = $_postalCode;
        $place->CountryCode  = $_countryCode;
        $place->PackageLocation = 'Mostrador';

        $this->pickUp->Place = $place;
        
    }

    public function setPickUp(
        $_fechaRecolecion,
        $hrsRecoleccion,
        $_hrsCierre,
        $nPiezas,
        $_nombreUsuario,
        $_telefonoUsuario
    )
    {
        $pick = new Pickup();
        $pick->PickupDate     = $_fechaRecolecion;
        $pick->PickupTypeCode = 'A';  // A--> el dia de hoy, S--> Anticipada
        $pick->ReadyByTime    = $hrsRecoleccion;  
        $pick->CloseTime      = $_hrsCierre;  
        $pick->Pieces         = $nPiezas;  

        $pickContact = new PickupContact();
        $pickContact->PersonName = $_nombreUsuario;
        $pickContact->Phone = $_telefonoUsuario;

        $this->pickUp->PickupContact = $pickContact; 
        $this->pickUp->Pickup        = $pick;


    }

    public function getPickUp()
    {
        $client = new WebserviceClient('staging');
        $respXML = $client->call($this->pickUp);
        $xmltoJson =  simplexml_load_string($respXML, "SimpleXMLElement", LIBXML_NOCDATA);
        $json = json_encode($xmltoJson);
        $resp = json_decode($json,TRUE);

        // echo '<pre>';
            // var_dump($this->shipment);
            // var_dump($resp);
        // echo '</pre>';

        return $resp;


    }

}
