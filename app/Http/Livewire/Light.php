<?php

namespace App\Http\Livewire;

use GuzzleHttp\Client;
use Livewire\Component;

class Light extends Component
{
    public $brightness = 10;
    public $responses = [];
    public $backup = [];
    public $name= '';
    public $details = [];
    public $type_order= '';
    public $isUpdate = false;
    public $searchColumn= ['name', 'market_cap'];



    public function mount()
    {


    }

    public function detail($id)
    {
        $this -> details = [];
        $client = new Client();
        $url = 'https://api.coingecko.com/api/v3/coins/'.$id;
        $this -> details= $client->get( $url);
        $this -> details = json_decode($this -> details->getBody()->getContents());

        $this -> details = (array) $this -> details;
    }

    public function sort($name)
    {
        $collection = collect($this->responses);

        $this->type_order = $this->type_order === 'asc' ? 'desc' : 'asc';

        $this->responses = $collection->sortBy([[$name, $this->type_order]])->values()->all();
    }


    public function search()
    {
        $this->details = [];
        if($this->name === '')
        {
            $this->responses = $this->backup;
            $this->isUpdate = false;
            return;
        }else {
            $this->responses  = collect($this->backup)->filter(function ($item){
                foreach ($this->searchColumn as $column)
                {
                    if(str_contains(strtolower($item[$column]), strtolower($this->name)))
                        return true;
                }
            });

            $re = [];
            foreach ($this->responses as $response){
                $objet = json_decode(json_encode($response));
                array_push($re, $objet);
            }
            $this->responses = $re;
            $this->isUpdate = true;
        }

    }

    public function render()
    {
        if(!$this->isUpdate)
        {
            $client = new Client();
            $this -> responses = $client->get('https://api.coingecko.com/api/v3/coins/markets?vs_currency=usd');
            $this -> responses = json_decode($this->responses->getBody()->getContents());

            $this->backup = $this->responses;
        }

        return view('livewire.light');
    }


}
