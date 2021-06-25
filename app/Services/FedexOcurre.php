<?php


namespace App\Services;

use FedEx\LocationsService\Request;
use FedEx\LocationsService\ComplexType;
use FedEx\LocationsService\ComplexType\SearchLocationsRequest;
use FedEx\LocationsService\SimpleType;

class FedexOcurre  
{
    private $locationRequest;

    public function __construct($key, $password, $accountNumber, $meterNumber) {
        
        $this->locationRequest = new SearchLocationsRequest();

        $this->locationRequest->WebAuthenticationDetail->UserCredential->Key = $key;
        $this->locationRequest->WebAuthenticationDetail->UserCredential->Password = $password;
        $this->locationRequest->ClientDetail->AccountNumber = $accountNumber;
        $this->locationRequest->ClientDetail->MeterNumber = $meterNumber;
        // $this->locationRequest->ClientDetail->Region = 'MX';


        $this->locationRequest->TransactionDetail->CustomerTransactionId = 'test locations service request';
        // Version.
        $this->locationRequest->Version->ServiceId = 'locs';
        $this->locationRequest->Version->Major = 12;
        $this->locationRequest->Version->Intermediate = 0;
        $this->locationRequest->Version->Minor = 0;
        $this->locationRequest->EffectiveDate = '2021-06-25';

    }


    public function setDireccion(array $direccion, $ciudad, $stateCode, $postalCode, $countryCode)
    {
        
        // Locations search criterion.
        $this->locationRequest->LocationsSearchCriterion = SimpleType\LocationsSearchCriteriaType::_ADDRESS;
        // Address
        $this->locationRequest->Address->StreetLines = $direccion;
        $this->locationRequest->Address->City = $ciudad;
        $this->locationRequest->Address->StateOrProvinceCode = $stateCode;
        $this->locationRequest->Address->PostalCode = $postalCode;
        $this->locationRequest->Address->CountryCode = $stateCode;
        $this->locationRequest->Address->CountryName = 'Mexico';
        // $this->locationRequest->ShipperAccountNumber = '510087860';
        $this->locationRequest->ShipperAccountNumber = '510087100';


    }

    public function setDistancia()
    {

        $this->locationRequest->Constraints->RadiusDistance->Value = '20.0';
        $this->locationRequest->Constraints->RadiusDistance->Units = 'KM';
        
    }

    public function getLocations()
    {
        // Multiple matches action.
        $this->locationRequest->MultipleMatchesAction = SimpleType\MultipleMatchesActionType::_RETURN_ALL;
        $this->locationRequest->SortDetail->Criterion = 'DISTANCE';
        $this->locationRequest->SortDetail->Order = 'LOWEST_TO_HIGHEST';

        // Get Search Locations reply.
        $locationServiceRequest = new Request();
        $searchLocationsReply = $locationServiceRequest->getSearchLocationsReply($this->locationRequest);

        // echo '<pre>';
            // var_dump($this->locationRequest);
            // var_dump($searchLocationsReply);
        // echo '</pre>';

        return $searchLocationsReply;
        
    }

}
