<?php

namespace App\Models\Crv4All\Imports;

use Curl;
use Htmldom;
use DB;
use Exception;
use Sentinel;
use Comptechsoft\Helpers\App\Response;
use Comptechsoft\Helpers\App\Message;
use App\Models\Animals\Imports\Import as ImportAnimal;
use App\Models\Animals\Imports\Detail;
use App\Models\Animals\Animals\Animal;

class Import
{

    protected $trait_endpoint = 'https://apps.crv4all.com/siresearch/us/detail/{interbull_code}?base={calculation_base}';
    protected $calculation_bases = [
        'Z' => 'Black and White', 
        'R' => 'Red and white', 
        'Y' => 'Dual purpose',
        'B' => 'Belgian blue',
    ];
    protected $response = NULL;
    protected $html_dom = NULL;
    protected $interbull_code = NULL;
    protected $calculation_base = NULL;
    protected $endpoint = NULL;

    protected function getTraitEndpoint($interbull_code, $calculation_base)
    {
        $result = str_replace('{interbull_code}', $interbull_code, $this->trait_endpoint);
        $result = str_replace('{calculation_base}', $calculation_base, $result);
        return $result;
    }

    protected function getResponse($data)
    {
        $this->response = 
            Curl::to($this->endpoint = $this->getTraitEndpoint(
                $this->interbull_code = $data['interbull_code'], 
                $this->calculation_base = $data['calculation_base']
            ))
            ->withOption('SSL_VERIFYPEER', false)
            ->get();
        $this->html_dom = new Htmldom($this->response);
    }

    protected function getElementById($tag, $id)
    {
        return $this->html_dom->find($tag . '[id=' . $id . ']', 0);
    }

    protected function getLongName()
    {
        return trim($this->getElementById('div', 'sire-name')->innertext);
    }

    protected function getShortName()
    {
        return trim($this->getElementById('div', 'sire-short-name')->innertext);
    }

    protected function getGeneralInfos()
    {
        $result = [];
        $dom = $this->getElementById('div', 'general')->find('div[class=field-row]');
        foreach($dom as $i => $item)
        {
            $result[$i] = [
                'caption' => trim($item->find('div[class=field-title]', 0)->innertext),
                'value' => trim($item->find('div[class=field-value]', 0)->innertext),
            ];
        }
        return $result;
    }

    protected function getDescendents()
    {
        $result = [];
        $dom = $this->getElementById('div', 'descent')->find('div[class=field-row]');
        foreach($dom as $i => $item)
        {
            if($i < 3)
            {
                $result[$i] = [
                    'caption' => trim($item->find('div[class=field-title]', 0)->innertext),
                    'value' => null,
                ];
            }
        }
        $result[0]['value'] = [
            'long_name' => trim($dom[0]->find('div[class=field-value]', 0)->find('a', 0)->innertext),
            'interbull_code' => trim(explode('<br/>', $dom[0]->find('div[class=field-value]', 0)->innertext)[1]),
        ];

        $result[1]['value'] = [
            'long_name' => trim(($parts = explode('<br/>', trim($dom[1]->find('div[class=field-value]', 0)->innertext)))[0]),
            'interbull_code' => trim($parts[1]),
        ];

        $result[2]['value'] = [
            'long_name' => trim($dom[2]->find('div[class=field-value]', 0)->find('a', 0)->innertext),
            'interbull_code' => trim(explode('<br/>', $dom[2]->find('div[class=field-value]', 0)->innertext)[1]),
        ];
        return $result;
    }

    protected function getBreedingValues()
    {
        $result = [];
        $thead = $this->getElementById('div', 'breedingvalues')->find('table', 0)->find('thead', 0)->find('tr', 0)->children();
        foreach($thead as $i => $h)
        {
            $result[$i] = [
                'caption' => trim($h->innertext),
                'values' => [
                    [
                        'caption' => 'BV',
                        'value' => NULL,
                    ],
                    [
                        'caption' => '% Rel',
                        'value' => NULL,
                    ]
                ]
            ];
        }
        $tbody = $this->getElementById('div', 'breedingvalues')->find('table', 0)->children(2)->find('tr');
        foreach($tbody as $j => $row)
        {
            foreach($row->children() as $i => $cell)
            {
                $result[$i]['values'][$j]['value'] = trim($cell->innertext);
            }
        }
        return $result;
    }
    
    protected function getProductionValues()
    {
        $result = [];
        $thead = $this->getElementById('div', 'production')->find('table', 0)->find('thead', 0)->find('tr', 0)->children();
        foreach($thead as $i => $h)
        {
            $result[] = [
                'caption' => trim($h->innertext),
                'value' => NULL,
            ];
        }
        $row = $this->getElementById('div', 'production')->find('table', 0)->children(2)->find('tr', 0);
        foreach($row->children() as $i => $cell)
        {
            $result[$i]['value'] = trim($cell->innertext);
        }
        $k = count($result);
        $thead = $this->getElementById('div', 'production')->find('table', 1)->find('thead', 0)->find('tr', 0)->children();
        foreach($thead as $i => $h)
        {
            $result[$i + $k] = [
                'caption' => trim($h->innertext),
                'value' => NULL,
            ];
        }
        $row = $this->getElementById('div', 'production')->find('table', 1)->children(2)->find('tr', 0);
        foreach($row->children() as $i => $cell)
        {
            $result[$i + $k]['value'] = trim($cell->innertext);
        }
        return $result;
    }

    protected function getExteriorValues()
    {
        $result = [];
        $thead = $this->getElementById('div', 'exterior')->find('table', 0)->find('thead', 0)->find('tr', 0)->children();
        foreach($thead as $i => $h)
        {
            $result[] = [
                'caption' => trim($h->innertext),
                'value' => NULL,
            ];
        }
        $row = $this->getElementById('div', 'exterior')->find('table', 0)->children(2)->find('tr', 0);
        foreach($row->children() as $i => $cell)
        {
            $result[$i]['value'] = trim($cell->innertext);
        }
        return $result;
    }

    protected function getFeedIntakeValues()
    {
        $result = [];
        $tables = $this->getElementById('div', 'dry-matter-intake')->find('table');
        $k = 0;
        foreach($tables as $i => $table)
        {
            $cells = $table->find('thead', 0)->find('tr', 0)->children();
            foreach($cells as $j => $h)
            {
                $result[$k] = [
                    'caption' => trim($h->innertext),
                    'value' => NULL,
                ];
                $k++;
            }
        }
        $k = 0;
        foreach($tables as $i => $table)
        {
            $cells = $table->children(2)->find('tr', 0)->children();
            foreach($cells as $i => $h)
            {
                $result[$k]['value'] = trim($h->innertext);
                $k++;
            }
        }
        return $result;
    }

    protected function getLifeTimeProduction()
    {
        $result = [];
        $thead = $this->getElementById('div', 'lifetime-production')->find('table', 0)->find('thead', 0)->find('tr', 0)->children();
        foreach($thead as $i => $h)
        {
            $result[] = [
                'caption' => trim($h->innertext),
                'value' => NULL,
            ];
        }
        $row = $this->getElementById('div', 'lifetime-production')->find('table', 0)->children(2)->find('tr', 0);
        foreach($row->children() as $i => $cell)
        {
            $result[$i]['value'] = trim($cell->innertext);
        }
        return $result;
    }

    protected function getOtherTraits()
    {
        $result = [];
        $row = $this->getElementById('div', 'other-traits')->find('table', 0)->children(2)->find('tr');
        foreach($row as $i => $cell)
        {
            $result[] = [
                'caption' => trim($cell->children(0)->innertext),
                'value' => trim($cell->children(1)->innertext),
            ];
        }
        return $result;
    }

    protected function getFunctionalTraits()
    {
        $result = [];
        $rows = $this->getElementById('div', 'production-traits')->find('table', 0)->children(2)->find('tr');
        foreach($rows as $i => $row)
        {
            try
            {
                $result[] = [
                    'caption' => trim($row->children(0)->innertext),
                    'value' => trim($row->children(3)->innertext),
                    'percent' => trim($row->children(4)->innertext),
                    'error' => NULL,
                ];
            }
            catch(\ErrorException $e)
            {
                $result[] = [
                    'caption' => trim($row->children(0)->innertext),
                    'value' => null,
                    'percent' => null,
                    'error' => $e->getMessage(),
                ];
            }
            
        }
        return $result;
    }

    protected function getExteriorTraits()
    {
        $result = [];
        $rows = $this->getElementById('div', 'exterior-traits')->find('table', 0)->children(2)->find('tr');
        foreach($rows as $i => $row)
        {
            try
            {
                $result[] = [
                    'caption' => trim($row->children(0)->innertext),
                    'value' => trim($row->children(3)->innertext),
                    'error' => NULL,
                ];
            }
            catch(\ErrorException $e)
            {
                $result[] = [
                    'caption' => trim($row->children(0)->innertext),
                    'value' => null,
                    'error' => $e->getMessage(),
                ];
            }
            
        }
        return $result;
    }

    protected function getResult()
    {
        $h = $this->html_dom->find('h2',0)->innertext;
        if($h == 'Unfortunately this sire does not have breeding values')
        {
            return [
                'success' => false,
                'message' => $h
            ];
        }
        return [
            'success' => true,
            'endpoint' => $this->endpoint,
            'long_name' => $this->getLongName(),
            'short_name' => $this->getShortName(),
            'general' => $this->getGeneralInfos(),
            'descendents' => $this->getDescendents(),
            'breedingvalues' => $this->getBreedingValues(),
            'production' => $this->getProductionValues(),
            'exterior' => $this->getExteriorValues(),
            'feed-intake' => $this->getFeedIntakeValues(),
            'lifetime-production' => $this->getLifeTimeProduction(),
            'other-traits' => $this->getOtherTraits(),
            'functional-traits' => $this->getFunctionalTraits(),
            'exterior-traits' => $this->getExteriorTraits(),
        ];
    }

    public function getAnimalTraits($data)
    {
        DB::beginTransaction();
        try
        {
            $animal = Animal::where('interbull_code', $data['interbull_code'])->first();
            if( ! $animal )
            {
                throw new Exception('Nu există animalul cu [' . $data['interbull_code'] . '].');
            }
            $this->getResponse($data);
            $import_animal = ImportAnimal::create([
                'animal_id' => $animal->id,
                'created_by' => Sentinel::check()->id,
                'calculation_base' => $data['calculation_base'],
                'endpoint' => $this->endpoint,
            ]);            
            $result = $this->getResult(); 
            if( ! $result['success'] )
            {
                DB::rollBack();
                return [
                    'success' => false,
                    'exception' => NULL,
                    'result' => [
                        'type' => 'success',
                        'message' => $result['message'],
                        'payload' => [],
                    ]
                ];
            }
            $save = $animal->saveImport($result, $this->calculation_base);
            DB::commit();
            return Response::Success('Importul s-a efectuat cu succes.', [
                'result' => $result,
                'save' => $save,
            ]);
        }
        catch(Exception $e)
        {
            DB::rollBack();
            return Response::Exception($e, 'Ceva nu a funcționat corect. Importul nu s-a putut efectua (' . $e->getMessage() . ')', []);
        } 

    }
}