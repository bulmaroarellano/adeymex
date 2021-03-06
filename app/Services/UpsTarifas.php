<?php
namespace App\Services;

use Ups\Entity\Address;
use Ups\Entity\Dimensions;
use Ups\Entity\Package;
use Ups\Entity\PackagingType;
use Ups\Entity\ShipFrom;
use Ups\Entity\Shipment;
use Ups\Entity\Shipper;
use Ups\Entity\ShipTo;
use Ups\Entity\UnitOfMeasurement;
use Ups\Rate;

class UpsTarifas  
{

    private $tarifa;
    private $shipment;
    

    public function __construct($_accesKey, $_userID, $_password) {
        
        $this->tarifa = new Rate($_accesKey, $_userID, $_password);
        $this->shipment = new Shipment(); 
        
        

    }


    public function setContactoRemitente(
        $_nombre,
        $_telefono,
        $_cuentaID, 
        $_direccion, 
        $_ciudad,
        $_codigoEstado, 
        $_codigoPostal, 
        $_codigoPais 
    )
    {
        $shipper = new Shipper();
        $shipper->setName($_nombre);

        $address = new Address();
        $address->setAddressLine1($_direccion);
        $address->setCity($_ciudad);
        $address->setStateProvinceCode($_codigoEstado);
        $address->setPostalCode($_codigoPostal);
        $address->setCountryCode($_codigoPais);
        $shipper->setPhoneNumber($_telefono);
        
        // $shipper->setShipperNumber(); // account number UPS 
        
        $shipper->setAddress($address);

        $this->shipment->setShipper($shipper);
        
        
    }

    public function enviarTo(
        $_compania,
        $_telefono,
        $_direccion,
        $_ciudad,
        $_codigoEstado,
        $_codigoPostal,
        $_codigoPais,
    )
    {
        $shipmentTo = new ShipTo(); 
        $shipmentTo->setCompanyName($_compania);
        $shipmentTo->setPhoneNumber($_telefono);

        $address = new Address();
        $address->setAddressLine1($_direccion);
        $address->setCity($_ciudad);
        $address->setStateProvinceCode($_codigoEstado);
        $address->setPostalCode($_codigoPostal);
        $address->setCountryCode($_codigoPais);

        $shipmentTo->setAddress($address);

        $this->shipment->setShipTo($shipmentTo);
    }

    public function enviarFrom(
        $_compania,
        $_telefono,
        $_direccion,
        $_ciudad,
        $_codigoEstado,
        $_codigoPostal,
        $_codigoPais,
    )
    {
        $shipmentFrom = new ShipFrom(); 
        $shipmentFrom->setCompanyName($_compania);
        $shipmentFrom->setPhoneNumber($_telefono);

        $address = new Address();
        $address->setAddressLine1($_direccion);
        $address->setCity($_ciudad);
        $address->setStateProvinceCode($_codigoEstado);
        $address->setPostalCode($_codigoPostal);
        $address->setCountryCode($_codigoPais);

        $shipmentFrom->setAddress($address);

        $this->shipment->setShipFrom($shipmentFrom);

    }

    public function setPaquete($request)
    {
        
        $largo = $request->largo;
        $ancho = $request->ancho;
        $alto  = $request->alto;
        $peso  = $request->peso;

        foreach ($largo as $key => $larg) {
            
            $package = new Package();
            $package->getPackagingType()->setCode(\Ups\Entity\PackagingType::PT_PACKAGE);
    
            $unitsWeight = new UnitOfMeasurement();
            $unitsWeight->setCode(\Ups\Entity\UnitOfMeasurement::PROD_KILOGRAMS);
            $units = new UnitOfMeasurement();
            $units->setCode(\Ups\Entity\UnitOfMeasurement::UOM_CM);
    
            $dimensions = new Dimensions();
            $dimensions->setUnitOfMeasurement($units);
            $dimensions->setWidth($larg);
            $dimensions->setHeight($alto[$key]);
            $dimensions->setLength($ancho[$key]);
            $package->getPackageWeight()->setWeight($peso[$key]);

            $package->getPackageWeight()->setUnitOfMeasurement($unitsWeight);
            $package->setDimensions($dimensions);
            
            $this->shipment->addPackage($package);

        }
    }

    public function getTarifa()
    {
        $rateInformation = new \Ups\Entity\RateInformation;
        $rateInformation->setNegotiatedRatesIndicator(1);
        $this->shipment->setRateInformation($rateInformation);
        
        $rateResponse = $this->tarifa->shopRates($this->shipment);

        // echo '<pre>';
        //     var_dump($rateResponse);
        // echo '</pre>';

        return $rateResponse;
    }
}
