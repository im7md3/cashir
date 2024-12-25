<?php

namespace App\Http\Livewire\Reports;

use App\Models\Invoice;
use App\Models\Product as ModelsProduct;
use Livewire\Component;
use Livewire\WithPagination;

class Product extends Component
{

    public $product, $from, $to;
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public function between($query)
    {
        if ($this->from && $this->to) {
            $query->whereBetween('created_at', [$this->from, $this->to]);
        } elseif ($this->from) {
            $query->where('created_at', '>=', $this->from);
        } elseif ($this->to) {
            $query->where('created_at', '<=', $this->to);
        } else {
            $query;
        }
    }


    public function mount()
    {
        $this->product = ModelsProduct::with('invoices')->find(request('product'));
    }


    public function render()
    {
        $invoices = Invoice::whereRelation('items', 'product_id', $this->product?->id)->where(function ($q) {
            $this->between($q);
        })->latest()->paginate();
        return view('livewire.reports.product', compact('invoices'));
    }
}
