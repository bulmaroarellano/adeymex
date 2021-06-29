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

    public function paquetes($request)
    {
        

        $largo = $request->largo;
        $ancho = $request->ancho;
        $alto  = $request->alto;
        $peso  = $request->peso;

        $this->rateRequest->RequestedShipment->PackageCount = count($largo);
        

        $this->rateRequest->RequestedShipment->RateRequestTypes = [SimpleType\RateRequestType::_PREFERRED];
        // $this->rateRequest->RequestedShipment->RateRequestTypes = [SimpleType\RateRequestType::_PREFERRED, SimpleType\RateRequestType::_LIST];
        // $this->rateRequest->RequestedShipment->PackagingType = SimpleType\PackagingType::_FEDEX_ENVELOPE;
        $packageLineItems = array();

        foreach ($largo as $key => $larg) {
            
            $lineItem = new ComplexType\RequestedPackageLineItem();    
            $lineItem->Dimensions->Length = $larg;
            $lineItem->Dimensions->Width  = $ancho[$key];
            $lineItem->Dimensions->Height = $alto[$key];
            $lineItem->Weight->Value      = $peso[$key];
            $lineItem->Weight->Units      = SimpleType\WeightUnits::_KG;
            $lineItem->Dimensions->Units  = SimpleType\LinearUnits::_CM;
            $lineItem->GroupPackageCount  = 1;

            array_push($packageLineItems, $lineItem);
        }
  
        $this->rateRequest->RequestedShipment->setRequestedPackageLineItems($packageLineItems);
  
        

    }

    public function peticion()
    {
        $rateServiceRequest = new Request();
        $rateReply = $rateServiceRequest->getGetRatesReply($this->rateRequest);

        if (!empty($rateReply->RateReplyDetails)) {
          
            return $rateReply;
        }

        
       
        return $rateReply;
        

    }


}
