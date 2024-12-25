<?php

namespace App\Http\Livewire;

use Livewire\Component;

use Livewire\WithFileUploads;

class Settings extends Component
{
    public $website_name, $default_currency = 'USD', $tax_no, $address, $active_bouquet, $building_no, $street, $phone, $active_tax, $logo_img, $icon_img, $tax, $capital, $active_invoice_print, $active_free_invoice, $amount_free_invoice, $price_include_tax = false;
    public $activate_package_balance = true, $message_invoice, $default_payment_method, $acivate_categories;

    use WithFileUploads;

    protected $rules = [
        'website_name' => ['string'],
        'tax_no' => ['string'],
        'address' => ['string'],
        'building_no' => ['string'],
        'logo_img' => ['nullable', 'image', 'max:1024'],
        'icon_img' => ['nullable', 'image', 'max:1024'],
        'street' => ['string'],
        'phone' => ['string'],
        'active_tax' => ['boolean', 'nullable'],
        'tax' => ['required', 'numeric'],
        'capital' => ['required', 'numeric'],
        'active_invoice_print' => ['nullable'],
        'active_free_invoice' => ['nullable'],
        'amount_free_invoice' => ['nullable'],
        'active_bouquet' => ['nullable'],
        'price_include_tax' => ['nullable'],
        'default_currency' => ['required'],
        'activate_package_balance' => ['nullable'],
        'default_payment_method' => ['nullable'],
        'message_invoice' => ['nullable'],
        'acivate_categories' => ['nullable'],
    ];
    public function update()
    {
        $data = $this->validate();
        if ($this->logo_img) {
            delete_file(setting('logo_img'));
            $data['logo_img'] = store_file($this->logo_img, 'settings');
        } else {
            $data['logo_img'] = setting('logo_img');
        }
        if ($this->icon_img) {
            delete_file(setting('icon_img'));
            $data['icon_img'] = store_file($this->icon_img, 'settings');
        } else {
            $data['icon_img'] = setting('icon_img');
        }
        $data['active_invoice_print'] = $this->active_invoice_print ? 1 : 0;
        $data['active_free_invoice'] = $this->active_free_invoice ? 1 : 0;
        $data['active_bouquet'] = $this->active_bouquet ? 1 : 0;
        $data['amount_free_invoice'] = $this->amount_free_invoice ? $this->amount_free_invoice : null;
        $data['acivate_categories'] = $this->acivate_categories ? $this->acivate_categories : null;

        if ($this->active_tax == true) {
            $data['price_include_tax'] = false;
        } else {
            $data['price_include_tax'] = true;
        }

        setting($data)->save();
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => 'تم تعديل الإعدادات بنجاح']);
    }
    public function mount()
    {
        $this->website_name = setting('website_name');
        $this->tax_no = setting('tax_no');
        $this->tax = setting('tax');
        $this->capital = setting('capital');
        $this->address = setting('address');
        $this->building_no = setting('building_no');
        $this->street = setting('street');
        $this->phone = setting('phone');
        $this->active_tax = (int)setting('active_tax');
        $this->acivate_categories = (int)setting('acivate_categories');
        $this->active_invoice_print = (int)setting('active_invoice_print');
        $this->active_free_invoice = (int) setting('active_free_invoice');
        $this->amount_free_invoice = (int)setting('amount_free_invoice');
        $this->active_bouquet = (int)setting('active_bouquet');
        $this->price_include_tax = (int)setting('price_include_tax');
        $this->default_payment_method = setting('default_payment_method');
        $this->message_invoice = setting('message_invoice');
        $this->activate_package_balance = (int)setting('activate_package_balance');
        $this->default_currency = setting('default_currency') ?? 'USD';
        // $this->icon_img=setting('icon_img');
    }
    public function render()
    {
        return view('livewire.settings');
    }
}
