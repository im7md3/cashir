<?php

namespace App\Http\Livewire\Reservation;

use App\Models\Client;
use App\Models\Reservation;
use Livewire\Component;
use App\Traits\livewireResource;
use Livewire\WithPagination;
use Illuminate\Validation\Rule;
class Reservations extends Component
{
    use WithPagination, livewireResource;
    public $searchphone,$phone,$client,$client_id,$personno,$social_situation,$name;
    protected function rules()
    {
        return [
            'name' => ['string', 'required'],
            'phone' => 'required|unique:reservations,phone',
            'social_situation' => 'required',
            'personno' => 'required',
            // 'client_id' => 'nullable',
        ];
    }
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName, [
            'name' => ['string', 'required'],
            'phone' => 'required|unique:reservations,phone',
            'social_situation' => 'required',
            'personno' => 'required',
        ]);
    }
    // public function mount(){
    //    $this->client = Client::wherePhone($this->searchphone)->first();
    //    $this->phone = $this->client->phone??null;
    // }
    public function searchname(){
         $client = Client::where(function ($q) {
            if ($this->phone) {
                $q->where('phone', 'LIKE', "%$this->phone%");
            }
            // else{
            //     $q->whereNotIn('phone', 'LIKE', "%$this->phone%");
            // }
        })->first();
        if( $client){
            $this->client = $client ;
            $this->name= $client->name ?? '';
            $this->phone= $client->phone ?? '';
            $this->social_situation= $client->social_situation ?? '';
        }else{
            // $this->client = $client ;
            // $this->name= $client->name ?? '';
            // $this->phone= $client->phone ?? '';
            // $this->social_situation= $client->social_situation ?? '';
        }
     }
    public function render()
    {
        $single = Reservation::where('social_situation', 'single')->get();
        $married = Reservation::where('social_situation', 'married')->get();
        // $single = Reservation::with('client')
        // ->whereHas('client', function ($q)  {
        //     $q->where('social_situation', 'single');
        // })->get();
        // $married = Reservation::with('client')
        // ->whereHas('client', function ($q)  {
        //     $q->where('social_situation', 'married');
        // })->get();
        // $client = Client::where(function ($q) {
        //     if ($this->searchphone) {
        //         $q->where('phone', 'LIKE', "%$this->searchphone%");
        //     }})->first();
        return view('livewire.reservation.reservations',compact('single','married'));
    }
}
