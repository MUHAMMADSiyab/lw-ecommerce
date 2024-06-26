<section class="py-10 relative">
    <h1 class="text-2xl text-gray-700">Billing Details</h1>
    <h4 class="text-sm text-gray-400">Fill in the billing and shipping details</h4>

    <form wire:submit="save" method="POST" class="mt-8">

        <section id="billing-details">
            <div class="flex gap-3 mb-5">
                <x-text-input type="text" placeholder="First name" wire:model="form.first_name" />
                <x-text-input type="text" placeholder="Last name" wire:model="form.last_name" />
            </div>
            <div class="flex gap-3 mb-5">
                <x-text-input type="text" placeholder="Address Line 1" wire:model="form.address_line_1" />
                <x-text-input type="text" placeholder="Address Line 2" wire:model="form.address_line_2" />
            </div>

            <div class="flex gap-3 mb-5">
                <x-text-input type="text" placeholder="City" wire:model="form.city" />
                <x-text-input type="text" placeholder="State" wire:model="form.state" />
            </div>

            <div class="flex gap-2 mb-3">
                <x-text-input type="text" placeholder="Postal code" wire:model="form.postal_code" />
                <x-text-input type="email" placeholder="Email" wire:model="form.email" />
            </div>
        </section>

        <h3 class="text-xl mt-5 mb-4">Shipping Details</h3>
        <label for="same_as_billing" class="text-gray-600">
            <input type="checkbox" name="same_as_billing" id="same_as_billing" wire:model.live="form.same_as_billing">

            Same as billing
        </label>

        @if (!$form->same_as_billing)
            <section id="shipping-details" class="mt-4">
                <div class="flex gap-3 mb-5">
                    <x-text-input type="text" placeholder="First name" wire:model="form.shipping_first_name" />
                    <x-text-input type="text" placeholder="Last name" wire:model="form.shipping_last_name" />
                </div>
                <div class="flex gap-3 mb-5">
                    <x-text-input type="text" placeholder="Address Line 1"
                        wire:model="form.shipping_address_line_1" />
                    <x-text-input type="text" placeholder="Address Line 2"
                        wire:model="form.shipping_address_line_2" />
                </div>

                <div class="flex gap-3 mb-5">
                    <x-text-input type="text" placeholder="City" wire:model="form.shipping_city" />
                    <x-text-input type="text" placeholder="State" wire:model="form.shipping_state" />
                </div>

                <div class="flex gap-2 mb-3">
                    <x-text-input type="text" placeholder="Postal code" wire:model="form.shipping_postal_code" />
                    <x-text-input type="email" placeholder="Email" wire:model="form.shipping_email" />
                </div>
            </section>
        @endif

        <div class="flex gap-3 mt-6">
            <label for="cash">
                <input type="radio" name="payment_method" id="cash" value="cash"
                    wire:model="form.payment_method">

                Cash on delivery
            </label>
            <label for="card">
                <input type="radio" name="payment_method" id="card" value="card"
                    wire:model="form.payment_method">

                Debit/Credit Card
            </label>
            <label for="paypal">
                <input type="radio" name="payment_method" id="paypal" value="paypal"
                    wire:model="form.payment_method">

                Paypal
            </label>
        </div>

        <div class="flex mt-8">
            <x-primary-button type="submit" class="">Confirm Details</x-primary-button>
        </div>
    </form>
</section>
