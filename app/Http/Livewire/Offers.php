<?php

namespace App\Http\Livewire;

use App\Models\Offer;
use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class Offers extends Component
{

    public $product_id, $start, $end, $rate, $show, $offer, $screen = 'index', $type = 'product';
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    protected function rules()
    {
        return [
            'product_id' => 'required',
            'start' => 'required',
            'end' => 'required',
            'rate' => 'required',
            'show' => 'nullable',
        ];
    }

    public function edit(Offer $offer)
    {
        $this->product_id = $offer->product_id ?? 'all';
        $this->rate = $offer->rate;
        $this->end = $offer->end;
        $this->start = $offer->start;
        $this->show = $offer->show;
        $this->offer = $offer;
        $this->type = $offer->type;
        $this->screen = 'edit';
    }

    public function save()
    {
        $data = $this->validate();
        if ($data['product_id'] == 'all') {
            $exists = Offer::where('type', 'all')->first();
            if ($exists) {
                $this->dispatchBrowserEvent('alert', ['type' => 'error',  'message' => 'لا يمكنك وضع اكثر من عرض لكل المنتجات برجاء حذف القديم او تعديلة']);
                return;
            }
            $data['product_id'] = null;
            $data['type'] = 'all';
        }
        if ($this->offer) {
            $this->offer->update($data);
        } else {
            Offer::create($data);
        }
        $this->reset();
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => 'تم الحفظ بنجاح']);
    }
    public function delete(Offer $offer)
    {
        $offer->delete();
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => 'تم الحفظ بنجاح']);
    }
    public function updatedScreen()
    {
        if ($this->screen == 'index') {
            $this->reset();
        }
    }
    public function render()
    {
        $offers = Offer::latest()->paginate(10);
        $products = Product::all();
        return view('livewire.offers', compact('offers', 'products'));
    }
}
