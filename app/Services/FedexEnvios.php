<?php

namespace App\Services;


use FedEx\ShipService;
use FedEx\ShipService\ComplexType;
use FedEx\ShipService\ComplexType\BrokerDetail;
use FedEx\ShipService\ComplexType\CommercialInvoiceDetail;
use FedEx\ShipService\ComplexType\CustomerImageUsage;
use FedEx\ShipService\ComplexType\ShippingDocumentFormat;
use FedEx\ShipService\ComplexType\ShippingDocumentSpecification;
use FedEx\ShipService\SimpleType;
use FedEx\ShipService\SimpleType\BrokerType;
use FedEx\ShipService\SimpleType\InternalImageType;
use FedEx\ShipService\SimpleType\RequestedShippingDocumentType;
use FedEx\ShipService\SimpleType\ShippingDocumentImageType;
use FedEx\ShipService\SimpleType\ShippingDocumentStockType;

class FedexEnvios
{

    //+CREDENCIALES 
    private $FEDEX_KEY;
    private $FEDEX_PASSWORD;
    private $FEDEX_ACCOUNT_NUMBER;
    private $FEDEX_METER_NUMBER;

    private $userCredential;
    private $webAuthenticationDetail;
    private $clientDetail;
    private $version;

    //+REMITENTE
    private $shipper;
    private $shipperAddress;
    private $shipperContact;

    //+DESTINATARIO
    private $recipient;
    private $recipientAddress;
    private $recipientContact;

    //+ COMPROBANTE
    private $labelSpecification;

    //+ PAQUETE
    private $packageLineItem;

    //+REPONSABILIDADES
    private $shippingChargesPayor;
    private $shippingChargesPayment;

    //+ENVIO
    private $requestedShipment;
    private $processShipmentRequest;
    private $shipService;

    public function __construct($key, $password, $accountNumber, $meterNumber)
    {

        $this->FEDEX_KEY = $key;
        $this->FEDEX_PASSWORD = $password;
        $this->FEDEX_ACCOUNT_NUMBER = $accountNumber;
        $this->FEDEX_METER_NUMBER = $meterNumber;

        $this->userCredential = new ComplexType\WebAuthenticationCredential();
        $this->webAuthenticationDetail = new ComplexType\WebAuthenticationDetail();
        $this->clientDetail = new ComplexType\ClientDetail();
        $this->version = new ComplexType\VersionId();

        $this->shipper = new ComplexType\Party();
        $this->shipperAddress = new ComplexType\Address(); // [] String's
        $this->shipperContact = new ComplexType\Contact();

        $this->recipient = new ComplexType\Party();
        $this->recipientAddress = new ComplexType\Address();
        $this->recipientContact = new ComplexType\Contact();

        $this->labelSpecification = new ComplexType\LabelSpecification();
        $this->packageLineItem = new ComplexType\RequestedPackageLineItem();

        $this->shippingChargesPayor = new ComplexType\Payor();
        $this->shippingChargesPayment = new ComplexType\Payment();

        $this->requestedShipment = new ComplexType\RequestedShipment();
        $this->processShipmentRequest = new ComplexType\ProcessShipmentRequest();
        $this->shipService = new ShipService\Request();
    }

    public function configuraciones()
    {
        $this->userCredential
            ->setKey($this->FEDEX_KEY)
            ->setPassword($this->FEDEX_PASSWORD);

        $this->webAuthenticationDetail
            ->setUserCredential($this->userCredential);

        $this->clientDetail
            ->setAccountNumber($this->FEDEX_ACCOUNT_NUMBER)
            ->setMeterNumber($this->FEDEX_METER_NUMBER);

        $this->version
            ->setMajor(26)
            ->setIntermediate(0)
            ->setMinor(0)
            ->setServiceId('ship');
    }

    public function remitenteEnvio(array $direccion, $ciudad, $estado, $codigoPostal)
    {
        $this->shipperAddress
            ->setStreetLines($direccion)
            ->setCity($ciudad)
            ->setStateOrProvinceCode($estado)
            ->setPostalCode($codigoPostal)
            ->setCountryCode('MX');

    }

    public function remitenteEnvioContacto($nombre, $telefono, $email,$nombreCompania)
    {

        $this->shipperContact
            ->setCompanyName($nombreCompania)
            ->setEMailAddress($email)
            ->setPersonName($nombre)
            ->setPhoneNumber(($telefono));

        $this->shipper
            ->setAccountNumber($this->FEDEX_ACCOUNT_NUMBER)
            ->setAddress($this->shipperAddress)
            ->setContact($this->shipperContact);
    }

    public function destinatarioEnvio(array $direccion, $ciudad, $estado, $codigoPostal, $countryCode)
    {
        $this->recipientAddress
            ->setStreetLines($direccion)
            ->setCity($ciudad)
            ->setStateOrProvinceCode($estado)
            ->setPostalCode($codigoPostal)
            ->setCountryCode($countryCode);
    }

    public function destinatarioEnvioContacto($nombre, $telefono)
    {

        $this->recipientContact
            ->setPersonName($nombre)
            ->setPhoneNumber(($telefono));

        $this->recipient
            ->setAddress($this->recipientAddress)
            ->setContact($this->recipientContact);
        
    }

    public function especificacionesPaquete($ancho, $alto, $largo, $peso, $descripcion)
    {
    
        $this->packageLineItem
            ->setSequenceNumber(1)
            ->setItemDescription($descripcion)
            ->setDimensions(new ComplexType\Dimensions(array(

                'Width' => $ancho,
                'Height' => $alto,
                'Length' => $largo,
                'Units' => SimpleType\LinearUnits::_CM

            )))
            ->setWeight(new ComplexType\Weight(array(
                'Value' => $peso,
                'Units' => SimpleType\WeightUnits::_KG
            )));

        $this->labelSpecification
            ->setLabelStockType(new SimpleType\LabelStockType(SimpleType\LabelStockType::_PAPER_7X4POINT75))
            ->setImageType(new SimpleType\ShippingDocumentImageType(SimpleType\ShippingDocumentImageType::_PDF))
            ->setLabelFormatType(new SimpleType\LabelFormatType(SimpleType\LabelFormatType::_COMMON2D));
    }

    public function impuestos()
    {
        $this->shippingChargesPayor->setResponsibleParty($this->shipper);

        $this->shippingChargesPayment
            ->setPaymentType(SimpleType\PaymentType::_SENDER)
            ->setPayor($this->shippingChargesPayor);
        $this->requestedShipment->setShippingChargesPayment($this->shippingChargesPayment);
    }

    public function setInternational()
    {
        $CommercialInvoice = new ComplexType\CommercialInvoice();
        
        //+ gastos de flete 

        $FreightCharge = new ComplexType\Money([
            'Currency' => 'USD',
            'Amount' => '10'
        ]);

        $CommercialInvoice
            ->setPurpose(new SimpleType\PurposeOfShipmentType(SimpleType\PurposeOfShipmentType::_SOLD))
            ->setFreightCharge($FreightCharge);
            //->setDeclarationStatement('bla bla');
        

        $CustomsClearanceDetail = [
            'DutiesPayment' => new ComplexType\Payment([
              'PaymentType' => 'SENDER', // valid values RECIPIENT, SENDER and THIRD_PARTY
             'Payor' => new ComplexType\Payor([
               'ResponsibleParty' => new ComplexType\Party([
                 'AccountNumber' => $this->FEDEX_ACCOUNT_NUMBER, // OPTIONAL  
                 'Contact' => new ComplexType\Contact([]),
                 'Address' => new ComplexType\Address([])
               ])  
             ])
            ]),
            'DocumentContent' => 'NON_DOCUMENTS',
            'CustomsValue' => new ComplexType\Money([
              'Currency' => 'USD',
              'Amount' => 400.0
            ]),
            'Commodities' => [
              [
                'NumberOfPieces' => 1,
                'Description' => 'Books',
                'CountryOfManufacture' => 'MX',
                'Weight' => array(
                  'Units' => 'KG',
                  'Value' => 0.5
                ),
                'Quantity' => 1,
                'QuantityUnits' => 'EA',
                'UnitPrice' => array(
                  'Currency' => 'USD',
                  'Amount' => 100.000000
                ),
                'CustomsValue' => array(
                  'Currency' => 'USD',
                  'Amount' => 400.000000
                )
              ]
            ],
            'ExportDetail' => new ComplexType\ExportDetail([
              'B13AFilingOption' => 'NOT_REQUIRED'
            ]),
            // 'PartiesToTransactionAreRelated' => true, 
            'CommercialInvoice' => $CommercialInvoice
        ];

        $this->requestedShipment->setCustomsClearanceDetail(
            new ComplexType\CustomsClearanceDetail($CustomsClearanceDetail)
        );
        $shippingDocumentSpecification = new ShippingDocumentSpecification([
            'ShippingDocumentTypes' => [
                RequestedShippingDocumentType::_COMMERCIAL_INVOICE
            ],
            'CommercialInvoiceDetail' => new CommercialInvoiceDetail([
                'CustomerImageUsages' => [
                    new CustomerImageUsage([
                        'InternalImageType' => InternalImageType::_LETTER_HEAD
                    ])
                ],
                'Format' => new ShippingDocumentFormat([
                    'ImageType' => ShippingDocumentImageType::_PDF,
                    'StockType' => ShippingDocumentStockType::_PAPER_LETTER
                ])
            ])
        ]);
       
        $this->requestedShipment->setShippingDocumentSpecification($shippingDocumentSpecification);
        

        

    }

    public function descEnvio($tipoServicio, $tipoPaquete )
    {
        $this->requestedShipment->setShipTimestamp(date('c'));
        $this->requestedShipment->setDropoffType(new SimpleType\DropoffType(SimpleType\DropoffType::_REGULAR_PICKUP));
        $this->requestedShipment->setServiceType(new SimpleType\ServiceType($tipoServicio)); // (FEDEX_GROUND)
        $this->requestedShipment->setPackagingType(new SimpleType\PackagingType($tipoPaquete)); //(_YOUR_PAKING)
        
        $this->requestedShipment->setShipper($this->shipper);
        $this->requestedShipment->setRecipient($this->recipient);
        $this->requestedShipment->setLabelSpecification($this->labelSpecification);
        
        $this->requestedShipment->setRateRequestTypes(array(new SimpleType\RateRequestType(SimpleType\RateRequestType::_PREFERRED)));
        $this->requestedShipment->setPackageCount(1);

        $this->requestedShipment->setRequestedPackageLineItems([
            $this->packageLineItem
        ]);
        
    }


    public function peticionEnvio()
    {
        $this->processShipmentRequest->setWebAuthenticationDetail($this->webAuthenticationDetail);
        $this->processShipmentRequest->setClientDetail($this->clientDetail);
        $this->processShipmentRequest->setVersion($this->version);
        $this->processShipmentRequest->setRequestedShipment($this->requestedShipment);
        
        $result = $this->shipService->getProcessShipmentReply($this->processShipmentRequest);
        
        
        echo '<pre>';
            var_dump($result);
            // var_dump($this->requestedShipment);
        echo '</pre>';
        
        
        
        return $result;
        
        // var_dump($result->CompletedShipmentDetail->CompletedPackageDetails[0]->Label->Parts[0]->Image);
    }
}
