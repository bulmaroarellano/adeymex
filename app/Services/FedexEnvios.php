<?php

namespace App\Services;

use App\Models\Guia;
use App\Models\Invoice;
use App\Models\Paquete;
use FedEx\ShipService;
use FedEx\ShipService\ComplexType;
use FedEx\ShipService\ComplexType\CommercialInvoiceDetail;
use FedEx\ShipService\ComplexType\CustomerImageUsage;
use FedEx\ShipService\ComplexType\ShippingDocumentFormat;
use FedEx\ShipService\ComplexType\ShippingDocumentSpecification;
use FedEx\ShipService\SimpleType;
use FedEx\ShipService\SimpleType\InternalImageType;
use FedEx\ShipService\SimpleType\RequestedShippingDocumentType;
use FedEx\ShipService\SimpleType\ShippingDocumentImageType;
use FedEx\ShipService\SimpleType\ShippingDocumentStockType;
use iio\libmergepdf\Merger;
use iio\libmergepdf\Pages;

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

    //+REPONSABILIDADES
    private $shippingChargesPayor;
    private $shippingChargesPayment;

    //+ENVIO
    private $requestedShipment;
    private $shipService;
    private $processShipmentRequest;
    private $processShipmentReply;

    // GUIA MASTER 
    private $masterTrackingID;
    
    //PDF'S
    private $pdfGuia;
    
    // succes
    private $success;

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
        

        $this->shippingChargesPayor = new ComplexType\Payor();
        $this->shippingChargesPayment = new ComplexType\Payment();

        $this->requestedShipment = new ComplexType\RequestedShipment();
        $this->processShipmentRequest = new ComplexType\ProcessShipmentRequest();
        $this->shipService = new ShipService\Request();

        $this->pdfGuia = new Merger;
        
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
    public function descEnvio($tipoServicio)
    {
        $this->requestedShipment->setShipTimestamp(date('c'));
        $this->requestedShipment->setDropoffType(new SimpleType\DropoffType(SimpleType\DropoffType::_REGULAR_PICKUP));
        $this->requestedShipment->setServiceType(new SimpleType\ServiceType($tipoServicio)); // (FEDEX_GROUND)

        $this->requestedShipment->setRateRequestTypes(array(new SimpleType\RateRequestType(SimpleType\RateRequestType::_PREFERRED)));
        
        $this->requestedShipment->setShipper($this->shipper);
        $this->requestedShipment->setRecipient($this->recipient);

        $this->labelSpecification
            // ->setLabelStockType(new SimpleType\LabelStockType(SimpleType\LabelStockType::_PAPER_7X4POINT75))
            ->setLabelStockType(new SimpleType\LabelStockType(SimpleType\LabelStockType::_PAPER_LETTER))
            ->setImageType(new SimpleType\ShippingDocumentImageType(SimpleType\ShippingDocumentImageType::_PDF))
            ->setLabelFormatType(new SimpleType\LabelFormatType(SimpleType\LabelFormatType::_COMMON2D));
        $this->requestedShipment->setLabelSpecification($this->labelSpecification);

        $this->requestedShipment->setPackagingType(
            new \FedEx\ShipService\SimpleType\PackagingType(\FedEx\ShipService\SimpleType\PackagingType::_YOUR_PACKAGING)
        );
        
    }
    public function impuestos()
    {
        $this->shippingChargesPayor->setResponsibleParty($this->shipper);

        $this->shippingChargesPayment
            ->setPaymentType(SimpleType\PaymentType::_SENDER)
            ->setPayor($this->shippingChargesPayor);
        $this->requestedShipment->setShippingChargesPayment($this->shippingChargesPayment);
    }
    public function setInternational(array $dataInter)
    {
        $CommercialInvoice = new ComplexType\CommercialInvoice();
        $CommercialInvoice->setPurpose(new SimpleType\PurposeOfShipmentType(SimpleType\PurposeOfShipmentType::_SOLD));
        
        $commodities = array();
        $descripciones = $dataInter['desc_producto'];
        $pesos = $dataInter['peso_neto'];
        $cantidades = $dataInter['cantidad'];
        $unidades = $dataInter['unidad_medida'];
        $precios = $dataInter['precio_unitario'];
        
        foreach ($descripciones as $key => $value) {
            
            $commodities[] = array(
                'NumberOfPieces' => 1,
                'Description' => $value,
                'CountryOfManufacture' => 'MX',
                'Weight' => array(
                  'Units' => 'KG',
                  'Value' => $pesos[$key],
                ),
                'Quantity' => $cantidades[$key],
                'QuantityUnits' => $unidades[$key],
                'UnitPrice' => array(
                  'Currency' => 'USD',
                  'Amount' => $precios[$key]
                ),
                'CustomsValue' => array(
                  'Currency' => 'USD',
                  'Amount' => $precios[$key]
                )
            );

        }
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
            'Commodities' =>$commodities,
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

    public function setPaquetes($request, $descripcion, bool $inter)
    {
        $largo = $request->largo_paquete;
        $ancho = $request->ancho_paquete;
        $alto  = $request->alto_paquete;
        $peso  = $request->peso_paquete;

        
        $this->requestedShipment->setPackageCount(count($largo));
        $totalWeight = 0;
        foreach ($peso as $key => $value) {
            $totalWeight += $value; 
        }
        $this->requestedShipment->setTotalWeight(new ComplexType\Weight(array(
            'Value' => $totalWeight,
            'Units' => SimpleType\WeightUnits::_KG
        )));

        $formID = $this->getMasterID( $ancho[0], $alto[0] ,$largo[0], $peso[0], $descripcion);          
        $master = new ComplexType\TrackingId();
        $master->FormId = $formID;
        $master->TrackingNumber = $this->masterTrackingID;
        
        $this->requestedShipment->setMasterTrackingId($master) ;
        
        foreach ($largo as $key => $larg) {
            if( $key >  0 ){
                $lineItem = new ComplexType\RequestedPackageLineItem();
                $lineItem
                    ->setSequenceNumber(($key + 1))
                    ->setItemDescription($descripcion)
                    ->setDimensions(new ComplexType\Dimensions(array(
                        'Width' => $ancho[$key],
                        'Height' => $alto[$key],
                        'Length' => $larg,
                        'Units' => SimpleType\LinearUnits::_CM
                    )))
                    ->setWeight(new ComplexType\Weight(array(
                        'Value' => $peso[$key],
                        'Units' => SimpleType\WeightUnits::_KG
                    )));
                $this->requestedShipment->setRequestedPackageLineItems([
                    $lineItem,
                    
                ]);

                $this->processShipmentReply  = $this->getEnvio();
                $slaveGuia = $this->processShipmentReply->CompletedShipmentDetail->CompletedPackageDetails[0]->TrackingIds[0]->TrackingNumber;
                $contentGuia = $this->processShipmentReply->CompletedShipmentDetail->CompletedPackageDetails[0]->Label->Parts[0]->Image;
                $this->saveSlaveGuias($slaveGuia, $contentGuia);
                $this->savePaquete($slaveGuia, $larg, $ancho[$key], $alto[$key], $peso[$key]);

            }
            
        }
        
        
        if ($inter) {
            $contentInovice = $this->processShipmentReply->CompletedShipmentDetail->ShipmentDocuments[0]->Parts[0]->Image;
            $this->saveCommercialInvoice($this->masterTrackingID, $contentInovice);
            
        }
        $urlGuiaFinal = "fedex-guias/master-{$this->masterTrackingID}.pdf";
        $createdPDF = $this->pdfGuia->merge();
        file_put_contents( $urlGuiaFinal, $createdPDF );


        
    }

    public function getMasterID($ancho, $alto, $largo, $peso, $descripcion)
    {
        //* PAQUETE 1 (MASTER)
        $lineItem = new ComplexType\RequestedPackageLineItem();
        $lineItem
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
        $this->requestedShipment->setRequestedPackageLineItems([$lineItem]);
        // CONDITIONES SUCCESS
        $this->processShipmentReply  = $this->getEnvio();
        
        $this->masterTrackingID = $this->processShipmentReply->CompletedShipmentDetail->MasterTrackingId->TrackingNumber;
        $contentGuia = $this->processShipmentReply->CompletedShipmentDetail->CompletedPackageDetails[0]->Label->Parts[0]->Image;
        
        $urlGuia = "fedex-guias/envio-{$this->masterTrackingID}.pdf";
        file_put_contents( $urlGuia, $contentGuia );
        $this->pdfGuia->addFile($urlGuia);
       
        $this->savePaquete($this->masterTrackingID, $largo, $ancho, $alto, $peso);
        $formId = $this->processShipmentReply->CompletedShipmentDetail->MasterTrackingId->FormId;

        return $formId;
    }


    public function getEnvio()
    {
        $this->processShipmentRequest->setWebAuthenticationDetail($this->webAuthenticationDetail);
        $this->processShipmentRequest->setClientDetail($this->clientDetail);
        $this->processShipmentRequest->setVersion($this->version);
        $this->processShipmentRequest->setRequestedShipment($this->requestedShipment);
        
        $this->processShipmentReply = $this->shipService->getProcessShipmentReply($this->processShipmentRequest);        
    
        // echo '<pre>';
            // var_dump($this->processShipmentReply);
            // var_dump($this->requestedShipment);
        // echo '</pre>';
        $this->success = $this->processShipmentReply->HighestSeverity;
        return $this->processShipmentReply;
    }

    public function saveSlaveGuias($slaveGuia, $contentGuia)
    {
        $urlSlaveGuia = "fedex-guias/envio-{$slaveGuia}.pdf";
        file_put_contents( $urlSlaveGuia, $contentGuia );
        $this->pdfGuia->addFile($urlSlaveGuia);

        Guia::create([
            'master_guia' => $this->masterTrackingID, 
            'slave_guia' => $slaveGuia, 
            'url_slave_guia' => $urlSlaveGuia, 
        ]);


    }
    public function saveCommercialInvoice($urlGuia, $contentGuia)
    {
        $urlGuiaInvoice = "fedex-guias/invoice-{$urlGuia}.pdf";
        file_put_contents( $urlGuiaInvoice, $contentGuia );
        // $this->pdfGuia->addFile($urlGuiaInvoice);
        Invoice::create([
            'master_guia' => $this->masterTrackingID, 
            'invoice_guia' => "invoice-{$this->masterTrackingID}", 
            'url_invoice_guia' => $urlGuiaInvoice, 
        ]);
    }

    public function savePaquete($numeroGuia, $largo, $ancho, $alto, $peso)
    {
        Paquete::create([
            'numero_guia' => $numeroGuia, 
            'largo_paquete' => $largo, 
            'ancho_paquete' => $ancho, 
            'alto_paquete' => $alto, 
            'peso_paquete' => $peso, 
        ]);
    }

    public function getGuia()
    {
        $masterGuia = $this->masterTrackingID; 
        $success = $this->success; 
        return array($masterGuia, $success);

    }
}
