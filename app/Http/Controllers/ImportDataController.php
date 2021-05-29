<?php

namespace App\Http\Controllers;

use App\Imports\IdhImport;
use App\Imports\ibgeImport;
use App\Imports\IsolateImport;
use App\Models\City;
use Illuminate\Support\Facades\Http;
use Maatwebsite\Excel\Facades\Excel;

class ImportDataController extends Controller
{

    /**
     * Import cities, year group, religion group, urban and rural population;
     * Save into db;
     * cities of state Rio Grande do Sul
     * year group (0-19, 20-59 and 60 +)
     * religion group (catholic, evangelical, spiritist and without religion)
     * font of datas (2010):
     *  - https://sidra.ibge.gov.br/Tabela/200
     *  - https://sidra.ibge.gov.br/tabela/1489
     *
     * file name: ibge_data.xlsx
     *
     * @version	2020-09-24
     * @author	Félix Hoffmann Sebastiany (https://github.com/feelixh)
     */
    public function importIbgeFileToDB() {

        Excel::import(new ibgeImport, storage_path('app/files/ibge_data.xlsx'));

        dd('Importou dados IBGE');
    }

    /**
     * Import IDH of cities;
     *
     * @version	2020-09-25
     * @author	Félix Hoffmann Sebastiany (https://github.com/feelixh)
     */
    public function importIdhToDB() {
        Excel::import(new IdhImport, storage_path('app/files/idh.xlsx'));

        dd('Importou dados IDH');
    }

    /**
     * Import isolate index data
     *
     * @version	2020-09-25
     * @author	Félix Hoffmann Sebastiany (https://github.com/feelixh)
     */
    public function importIsolateDataToDB() {
        Excel::import(new IsolateImport, storage_path('app/files/isolateV2.xlsx'));

        dd('Importou dados Isolamento');
    }

    /**
     * Import population, covid cases, covid deaths
     *
     * @version	2020-09-26
     * @author	Félix Hoffmann Sebastiany (https://github.com/feelixh)
     */
    public function importCovidaDataToDB() {
        $response = Http::get('https://brasil.io/api/dataset/covid19/caso/data/?format=json&is_last=True&state=RS'); //com isso tenho cidades, população, óbitos, confirmados
        $results = ($response->json(['results']));

        $cities = City::all();
        //dd($results);
        $count = 0;
        foreach ($results as $result) {
            foreach ($cities as $city) {
                if ($city->name == $result['city']) {
                    $city->population = $result['estimated_population_2019'];
                    $city->covid_deaths = $result['deaths'];
                    $city->covid_confirmed = $result['confirmed'];
                    $city->update();
                    $count++;
                }
            }
        }

        dd('Dados do Covid importados com sucesso. Número de registros afetados: ' . $count);

    }
}
