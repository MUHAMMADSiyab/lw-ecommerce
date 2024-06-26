<?php

namespace App\Livewire;

use App\Livewire\Forms\BillingDetailsForm;
use App\Models\Address;
use App\Models\CartItem;
use App\Models\Order;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class BillingDetails extends Component
{
    public BillingDetailsForm $form;
    public Order|null $order;

    public function mount()
    {
        $user = auth()->user();
        $this->form->email = $user->email;
        $this->form->shipping_email = $user->email;

        $this->order = Order::query()
            ->with(['shipping_address', 'billing_address'])
            ->whereUserId(auth()->id())
            ->latest()
            ->first();

        if ($this->order) {
            $this->form->first_name = $this->order->billing_address->first_name;
            $this->form->last_name = $this->order->billing_address->last_name;
            $this->form->address_line_1 = $this->order->billing_address->address_line_1;
            $this->form->address_line_2 = $this->order->billing_address->address_line_2;
            $this->form->city = $this->order->billing_address->city;
            $this->form->state = $this->order->billing_address->state;
            $this->form->postal_code = $this->order->billing_address->postal_code;
            $this->form->email = $this->order->billing_address->email;

            $this->form->shipping_first_name = $this->order->shipping_address->first_name;
            $this->form->shipping_last_name = $this->order->shipping_address->last_name;
            $this->form->shipping_address_line_1 = $this->order->shipping_address->address_line_1;
            $this->form->shipping_address_line_2 = $this->order->shipping_address->address_line_2;
            $this->form->shipping_city = $this->order->shipping_address->city;
            $this->form->shipping_state = $this->order->shipping_address->state;
            $this->form->shipping_postal_code = $this->order->shipping_address->postal_code;
            $this->form->shipping_email = $this->order->shipping_address->email;

            $this->form->payment_method = $this->order->payment_method;
        }
    }

    public function save()
    {
        try {
            DB::beginTransaction();

            $this->saveData();

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            //throw $th;
        }
    }

    private function saveData()
    {
        $data = [
            'user_id' => auth()->id(),
            'first_name' => $this->form->first_name,
            'last_name' => $this->form->last_name,
            'address_line_1' => $this->form->address_line_1,
            'address_line_2' => $this->form->address_line_2,
            'city' => $this->form->city,
            'state' => $this->form->state,
            'postal_code' => $this->form->postal_code,
            'email' => $this->form->email,
        ];

        $billing_address = Address::query()
            ->updateOrCreate(['id' => $this->order?->billing_address?->id], $data);

        if ($this->form->same_as_billing) {
            $shipping_address = Address::query()
                ->updateOrCreate(['id' => $this->order?->shipping_address?->id], $data);
        } else {
            $shipping_address = Address::query()->updateOrCreate(
                ['id' => $this->order?->shipping_address?->id],
                [
                    'user_id' => auth()->id(),
                    'first_name' => $this->form->shipping_first_name,
                    'last_name' => $this->form->shipping_last_name,
                    'address_line_1' => $this->form->shipping_address_line_1,
                    'address_line_2' => $this->form->shipping_address_line_2,
                    'city' => $this->form->shipping_city,
                    'state' => $this->form->shipping_state,
                    'postal_code' => $this->form->shipping_postal_code,
                    'email' => $this->form->shipping_email,
                ]
            );
        }

        Order::query()->updateOrCreate(['id' => $this->order?->id], [
            'user_id' => auth()->id(),
            'billing_address_id' => $billing_address->id,
            'shipping_address_id' => $shipping_address->id,
            'payment_method' => $this->form->payment_method,
            'total_amount' => (float)$this->getCartSubtotal()
        ]);
    }

    public function render()
    {
        return view('livewire.billing-details');
    }

    private function getCartSubtotal()
    {
        $userId = auth()->id();
        $guestCartId = request()->cookie('guest_cart_id');

        return CartItem::query()
            ->with('product', 'variations')
            ->when($userId, function ($query) use ($userId) {
                return $query->where('user_id', $userId);
            })
            ->when(!$userId && $guestCartId, function ($query) use ($guestCartId) {
                return $query->where('guest_cart_id', $guestCartId);
            })
            ->latest()
            ->get()
            ->sum(fn ($cartItem) => $cartItem->product->price * $cartItem->quantity);
    }
}
