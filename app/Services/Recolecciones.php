<?php

namespace App\Services;

use App\Models\Envio;
use App\Models\Sucursal;
use App\Services\FedexPickUp;

class Recolecciones  
{
    private $request;
 
    public function __construct($request) {
        
        $this->request = $request;
   
    }


    public function getPickupFedex()
    {
        $sucursal = Sucursal::where('id', $this->request->sucursal_id)->get();

        $pickUpFedex = new FedexPickUp('RdrCFt8NwQuVQaSK', 'Bbd1Nb5m4ekatPZiMp9BUEI3Y', '510087860', '119072943');
        //TODO: Insertar Sucursal 
        $pickUpFedex->setContactPickupLocation('adeymex', '7223568878', 'adeymex@adey.com');
        $pickUpFedex->setAddresPickup('Col. Centro','Toluca de Lerdo', 'EM', 50000 , 'MX');
        $pickUpFedex->setDescriptionLocation(
            'paqueteria adeymex',
            $this->request->fecha_recoleccion,
            $this->request->hrs_cierre
        );

        $pickUpFedex->setPickUpPackage(count($this->request->envio), '');



        $createPickupReply = $pickUpFedex->getPickup();

        $success = $createPickupReply->HighestSeverity;
        $message = $createPickupReply->Notifications[0]->Message;

        if ($success != 'ERROR') {
            $pickupConfirmationNumber = $createPickupReply->PickupConfirmationNumber;
            $location = $createPickupReply->Location;
            $folioRecoleccion = "{$pickupConfirmationNumber}/{$location}";
            $this->updateStatusRecoleccion($folioRecoleccion);
        }

        return array($createPickupReply, $success, $message);

    }

    public function getPickUpDHL()
    {
        $sucursal = Sucursal::where('id', $this->request->sucursal_id)->get();
        $pickUpDHL = new DhlPickUp('v62_9kV6umb2sA', 'ooc0Yf6DHG'); 
        //TODO: INSERTAR SUCURSAL y USUARIO RESPONSABLE DE LA PAQUETERIA
        $pickUpDHL->setRecolector(
            '980055830',
            'Col. Centro',
            'Toluca de Lerdo',
            'MX',
            'famagu', 
            '7223568878'
        );
        $pickUpDHL->setDireccionPickUp('Col. Centro', 'Toluca de Lerdo', '50000', 'MX');
        $fechaRecoleccion = explode('T', $this->request->fecha_recoleccion);
        $fechaRecoleccion[1] =  substr($fechaRecoleccion[1], 0, -3);
        //TODO: INSERTAR USUARIO
        $pickUpDHL->setPickUp(
            $fechaRecoleccion[0],
            $fechaRecoleccion[1],
            $this->request->hrs_cierre,
            count($this->request->envio),
            'famagu',
            '123456789'
        );

        $PUResponse = $pickUpDHL->getPickUp();
        $success = $PUResponse['Note']['ActionNote'] ?? 'Error';

        if ($success != 'Error') {
            $message = 'OK';
            $confirmationNumber = $PUResponse['ConfirmationNumber'];
            $location     = $PUResponse['OriginSvcArea'];
            $folioRecoleccion = "{$confirmationNumber}/{$location}";
            $this->updateStatusRecoleccion($folioRecoleccion);



        }else{

            $message = $PUResponse['Response']['Status']['Condition']['ConditionData'];

        }

        return array($PUResponse, $success, $message);



    }





    public function updateStatusRecoleccion($folioRecoleccion)
    {
        $paquetes = $this->request->envio;  

        foreach ($paquetes as $key => $value) {
            
            Envio::where('id', $value)->update([
                'status_recoleccion' =>  'ESPERANDO RECOLECCION',
                'recoleccion_guia' => $folioRecoleccion
            ]);
        }

    }










}
