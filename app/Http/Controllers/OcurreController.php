<?php

namespace App\Http\Controllers;

use App\Models\Zip;
use App\Services\FedexOcurre;
use Illuminate\Http\Request;
use stdClass;

class OcurreController extends Controller
{
    


    public function index(Request $request)
    {

        return $request;
            
    }

    public function searchOcurre(Request $request)
    {

        $ocurres = [];

        // if ($request->ajax()) {
        if ($request->has('idZip')) {
            
            $idZip = $request->idZip;
            //* place_name --> direccion
            //* admin_name1 = Mexico, sinaloa (estados ) 
            //* code_name1 = abreviacion 2 letras estados,
            //* admin_name2 = Toluca, atlacomulco (municipio)

            $zip = Zip::select('postal_code', 'place_name', 'admin_name1', 'admin_name2')
                    ->where('id', 'LIKE', "%$idZip%")->get();

            $locations = new FedexOcurre('4J4xrVU6gOh0EJ9p', 'Ko7Vmc7pJ3XryfZsXhKSm07op', '510087100', '119225568');
            // $locations->setDireccion(['Col. De la Veracruz'],'Toluca de Lerdo', 'MX', 51356 , 'EM');
            $locations->setDireccion([$zip[0]->place_name],$zip[0]->admin_name2, 'MX', $zip[0]->postal_code, $zip[0]->code_name1);
            $searchLocationsReply = $locations->getLocations();
            
            if ($searchLocationsReply->ResultsReturned > 0) {

                $addressToLocationRelationship = $searchLocationsReply->AddressToLocationRelationships[0];

                foreach ($addressToLocationRelationship->DistanceAndLocationDetails as $key => $distanceAndLocationDetail) {

                    array_push($ocurres, (object) [
                        'id' => $key,
                        'dis' => $distanceAndLocationDetail->Distance->Value,
                        'dir' => $distanceAndLocationDetail->LocationDetail->LocationContactAndAddress->Address->StreetLines
                    ]);
                    
                }

            }
            return response()->json($ocurres);
        }

    }
    

}
