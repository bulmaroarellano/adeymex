<?php
namespace App\Services;

use FedEx\PickupService\Request;
use FedEx\PickupService\ComplexType\CreatePickupRequest;
use FedEx\PickupService\SimpleType;

class FedexPickUp  
{

    private $pickUpRequest;

    public function __construct($key, $password, $accountNumber, $meterNumber) {
        
        $this->pickUpRequest = new CreatePickupRequest();

        $this->pickUpRequest->WebAuthenticationDetail->UserCredential->Key = $key;
        $this->pickUpRequest->WebAuthenticationDetail->UserCredential->Password = $password;
        $this->pickUpRequest->ClientDetail->AccountNumber = $accountNumber;
        $this->pickUpRequest->ClientDetail->MeterNumber = $meterNumber;


        $this->pickUpRequest->Version->ServiceId = 'disp';
        $this->pickUpRequest->Version->Major = 22;
        $this->pickUpRequest->Version->Intermediate = 0;
        $this->pickUpRequest->Version->Minor = 0;

        $this->pickUpRequest->TransactionDetail->CustomerTransactionId = 'create pickup request example';
        $this->pickUpRequest->TransactionDetail->Localization->LanguageCode = 'ES';
        $this->pickUpRequest->TransactionDetail->Localization->LocaleCode = 'ES';

        // Associated account number.
        $this->pickUpRequest->AssociatedAccountNumber->Type = SimpleType\AssociatedAccountNumberType::_FEDEX_EXPRESS;
        $this->pickUpRequest->AssociatedAccountNumber->AccountNumber = $accountNumber;


    }

    public function setContactPickupLocation($_company, $_telefono, $_email)
    {   

        $this->pickUpRequest->OriginDetail->PickupLocation->Contact->ContactId = 'KR1059';
        $this->pickUpRequest->OriginDetail->PickupLocation->Contact->PersonName = 'adeymex';
        $this->pickUpRequest->OriginDetail->PickupLocation->Contact->Title = 'Mr.adeymex';
        $this->pickUpRequest->OriginDetail->PickupLocation->Contact->CompanyName = $_company;
        $this->pickUpRequest->OriginDetail->PickupLocation->Contact->PhoneNumber = $_telefono;
        $this->pickUpRequest->OriginDetail->PickupLocation->Contact->EMailAddress = $_email;
        
    }

    public function setAddresPickup($_direccion, $_ciudad, $_estadoCode, $_postalCode, $_countryCode)
    {
        $this->pickUpRequest->OriginDetail->PickupLocation->Address->StreetLines = [$_direccion];
        $this->pickUpRequest->OriginDetail->PickupLocation->Address->City = $_ciudad;
        $this->pickUpRequest->OriginDetail->PickupLocation->Address->StateOrProvinceCode = $_estadoCode;
        $this->pickUpRequest->OriginDetail->PickupLocation->Address->PostalCode = $_postalCode;
        $this->pickUpRequest->OriginDetail->PickupLocation->Address->CountryCode = $_countryCode;

    }

    public function setDescriptionLocation($_descriptionLocation, $_hrsRecoleccion, $_hrsCierre)
    {
        $this->pickUpRequest->OriginDetail->PackageLocation = SimpleType\PickupBuildingLocationType::_FRONT;
        $this->pickUpRequest->OriginDetail->BuildingPart = SimpleType\BuildingPartCode::_DEPARTMENT;
        $this->pickUpRequest->OriginDetail->BuildingPartDescription = $_descriptionLocation;
        // $this->pickUpRequest->OriginDetail->ReadyTimestamp = date('c');
        $this->pickUpRequest->OriginDetail->ReadyTimestamp = $_hrsRecoleccion;
        $this->pickUpRequest->OriginDetail->CompanyCloseTime = "{$_hrsCierre}:00";
        $this->pickUpRequest->OriginDetail->Location = 'NQAA';
        $this->pickUpRequest->OriginDetail->SuppliesRequested = 'supplies requested';

    }


    public function setPickUpPackage($_numeroPack, $_totalPeso)
    {
        $this->pickUpRequest->PackageCount = $_numeroPack;
        // $this->pickUpRequest->TotalWeight->Units = SimpleType\WeightUnits::_KG;
        // $this->pickUpRequest->TotalWeight->Value = $_totalPeso;

        $this->pickUpRequest->CarrierCode = SimpleType\CarrierCodeType::_FDXE;
        $this->pickUpRequest->OversizePackageCount = 0;
        $this->pickUpRequest->Remarks = 'remarks';
        $this->pickUpRequest->CommodityDescription = 'test environment - please do not process pickup';
        $this->pickUpRequest->CountryRelationship = SimpleType\CountryRelationshipType::_DOMESTIC;
    }


    public function getPickup()
    {
        $request = new Request();
        $createPickupReply = $request->getCreatePickupReply($this->pickUpRequest);

        // echo '<pre>';
        //     var_dump($createPickupReply);
        // echo '</pre>';

        return $createPickupReply;


    }


}
