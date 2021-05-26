<?php

namespace App\Services;

use FedEx\RateService\Request;
use FedEx\RateService\ComplexType;
use FedEx\RateService\SimpleType;




class FedexTarifas
{

    private $rateRequest;

    public function __construct($key, $password, $accountNumber, $meterNumber, $moneda)
    {
        $this->rateRequest = new ComplexType\RateRequest();

        $this->rateRequest->WebAuthenticationDetail->UserCredential->Key = $key;
        $this->rateRequest->WebAuthenticationDetail->UserCredential->Password = $password;
        $this->rateRequest->ClientDetail->AccountNumber = $accountNumber;
        $this->rateRequest->ClientDetail->MeterNumber = $meterNumber;

        $this->rateRequest->RequestedShipment->PreferredCurrency = $moneda;
        $this->rateRequest->TransactionDetail->CustomerTransactionId = 'testing rate service request';


    }



    public function version()
    {

        $this->rateRequest->Version->ServiceId = 'crs';
        $this->rateRequest->Version->Major = 28;
        $this->rateRequest->Version->Minor = 0;
        $this->rateRequest->Version->Intermediate = 0;
        $this->rateRequest->ReturnTransitAndCommit = true;
    }

    public function remitente(array $direccion, $ciudad, $estado, $codigoPostal, $paisCode)
    {
        
        $this->rateRequest->RequestedShipment->Shipper->Address->StreetLines = $direccion;
        $this->rateRequest->RequestedShipment->Shipper->Address->City = $ciudad;
        $this->rateRequest->RequestedShipment->Shipper->Address->StateOrProvinceCode = $estado;
        $this->rateRequest->RequestedShipment->Shipper->Address->PostalCode = $codigoPostal;
        $this->rateRequest->RequestedShipment->Shipper->Address->CountryCode = $paisCode;
        $this->rateRequest->RequestedShipment->ShippingChargesPayment->PaymentType = SimpleType\PaymentType::_SENDER;
    }

    public function destinatario(array $direccion, $ciudad, $estado, $codigoPostal, $paisCode)
    {
       
        $this->rateRequest->RequestedShipment->Recipient->Address->StreetLines = $direccion;
        $this->rateRequest->RequestedShipment->Recipient->Address->City = $ciudad;
        $this->rateRequest->RequestedShipment->Recipient->Address->StateOrProvinceCode = $estado;
        $this->rateRequest->RequestedShipment->Recipient->Address->PostalCode = $codigoPostal;
        $this->rateRequest->RequestedShipment->Recipient->Address->CountryCode = $paisCode;
    }

    public function paquetes($peso, $largo, $ancho, $alto)
    {
        //rate request types
        // $this->rateRequest->RequestedShipment->RateRequestTypes = [SimpleType\RateRequestType::_PREFERRED, SimpleType\RateRequestType::_LIST];
        $this->rateRequest->RequestedShipment->RateRequestTypes = [SimpleType\RateRequestType::_PREFERRED];

        // $this->rateRequest->RequestedShipment->PackagingType = SimpleType\PackagingType::_FEDEX_ENVELOPE;
        $this->rateRequest->RequestedShipment->PackageCount = 1;

        //create package line items
        $this->rateRequest->RequestedShipment->RequestedPackageLineItems = [new ComplexType\RequestedPackageLineItem()];

        //package 1
        $this->rateRequest->RequestedShipment->RequestedPackageLineItems[0]->Weight->Value = $peso;
        $this->rateRequest->RequestedShipment->RequestedPackageLineItems[0]->Weight->Units = SimpleType\WeightUnits::_KG;
        $this->rateRequest->RequestedShipment->RequestedPackageLineItems[0]->Dimensions->Length = $largo;
        $this->rateRequest->RequestedShipment->RequestedPackageLineItems[0]->Dimensions->Width = $ancho;
        $this->rateRequest->RequestedShipment->RequestedPackageLineItems[0]->Dimensions->Height = $alto;
        $this->rateRequest->RequestedShipment->RequestedPackageLineItems[0]->Dimensions->Units = SimpleType\LinearUnits::_CM;
        $this->rateRequest->RequestedShipment->RequestedPackageLineItems[0]->GroupPackageCount = 1;

        //package 2
        // $this->rateRequest->RequestedShipment->RequestedPackageLineItems[1]->Weight->Value = 5;
        // $this->rateRequest->RequestedShipment->RequestedPackageLineItems[1]->Weight->Units = SimpleType\WeightUnits::_KG;
        // $this->rateRequest->RequestedShipment->RequestedPackageLineItems[1]->Dimensions->Length = 20;
        // $this->rateRequest->RequestedShipment->RequestedPackageLineItems[1]->Dimensions->Width = 20;
        // $this->rateRequest->RequestedShipment->RequestedPackageLineItems[1]->Dimensions->Height = 10;
        // $this->rateRequest->RequestedShipment->RequestedPackageLineItems[1]->Dimensions->Units = SimpleType\LinearUnits::_CM;
        // $this->rateRequest->RequestedShipment->RequestedPackageLineItems[1]->GroupPackageCount = 1;
    }

    public function peticion()
    {
        $rateServiceRequest = new Request();
        $rateReply = $rateServiceRequest->getGetRatesReply($this->rateRequest);

        if (!empty($rateReply->RateReplyDetails)) {
            // foreach ($rateReply->RateReplyDetails as $rateReplyDetail) {
            //     var_dump($rateReplyDetail->ServiceType);
            //     if (!empty($rateReplyDetail->RatedShipmentDetails)) {
            //         foreach ($rateReplyDetail->RatedShipmentDetails as $ratedShipmentDetail) {
            //             var_dump($ratedShipmentDetail->ShipmentRateDetail->RateType . ": " . $ratedShipmentDetail->ShipmentRateDetail->TotalNetCharge->Amount);
            //         }
            //     }
            //     echo "<hr />";
            // }
            // echo '<pre>';
            // var_dump($rateReply);
            // echo '</pre>';
            // return $rateReply->RateReplyDetails;
            return $rateReply;
        }
        
        return $rateReply;
        

    }


}
