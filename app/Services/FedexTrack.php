<?php

namespace App\Services;

use FedEx\TrackService\ComplexType\Localization;
use FedEx\TrackService\ComplexType\TrackRequest;
use FedEx\TrackService\ComplexType\TrackSelectionDetail;
use FedEx\TrackService\ComplexType\TransactionDetail;
use FedEx\TrackService\Request;
use FedEx\TrackService\SimpleType;


class FedexTrack  
{


    private $trackRequest;

    public function __construct($key, $password, $accountNumber, $meterNumber) {
        $this->trackRequest = new TrackRequest();
        $this->trackRequest->WebAuthenticationDetail->UserCredential->Key = $key;
        $this->trackRequest->WebAuthenticationDetail->UserCredential->Password = $password;
        $this->trackRequest->ClientDetail->AccountNumber = $accountNumber;
        $this->trackRequest->ClientDetail->MeterNumber = $meterNumber;

        // Version
        $this->trackRequest->Version->ServiceId = 'trck';
        $this->trackRequest->Version->Major = 19;
        $this->trackRequest->Version->Intermediate = 0;
        $this->trackRequest->Version->Minor = 0;

        $transactionDetail = new TransactionDetail([
            'Localization' => new Localization([
                'LanguageCode' => 'ES', 
                'LocaleCode' => 'es'
            ])
        ]);

        $this->trackRequest->TransactionDetail = $transactionDetail;
    }


    public function setGuia($numeroGuia)
    {
        $this->trackRequest->SelectionDetails = [new TrackSelectionDetail()];
        // For get all events
        
        $this->trackRequest->ProcessingOptions = [SimpleType\TrackRequestProcessingOptionType::_INCLUDE_DETAILED_SCANS];

        $this->trackRequest->SelectionDetails[0]->PackageIdentifier->Value = $numeroGuia;
        $this->trackRequest->SelectionDetails[0]->PackageIdentifier->Type = SimpleType\TrackIdentifierType::_TRACKING_NUMBER_OR_DOORTAG;

    }

    public function getTracking()
    {
        $request = new Request();
        $trackReply = $request->getTrackReply($this->trackRequest);

        echo '<pre>';
            var_dump($trackReply);
        echo '</pre>';

        return $trackReply;
        
    }
}
