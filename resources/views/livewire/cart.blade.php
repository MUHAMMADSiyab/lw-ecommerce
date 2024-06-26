<section class="py-24 relative">
    <div class="w-full max-w-7xl px-4 md:px-5 lg-6 mx-auto">

        <h2 class="title font-manrope font-bold text-4xl leading-10 mb-8 text-center text-black">My Cart
        </h2>

        @forelse($cartItems as $cartItem)
            <livewire:cart-item :cartItem="$cartItem" :key="$cartItem->id" />
        @empty
            <h6 class="ml-6 py-8 text-gray-500">No items in cart</h6>
        @endforelse

        <div
            class="flex flex-col md:flex-row items-center md:items-center justify-between lg:px-6 pb-6 border-b border-gray-200 max-lg:max-w-lg max-lg:mx-auto">
            <h5
                class="text-gray-900 font-manrope font-semibold text-2xl leading-9 w-full max-md:text-center max-md:mb-4">
                Subtotal</h5>

            <div class="flex items-center justify-between gap-5 ">
                {{-- <button
                    class="rounded-full py-2.5 px-3 bg-indigo-50 text-indigo-600 font-semibold text-xs text-center whitespace-nowrap transition-all duration-500 hover:bg-indigo-100">Promo
                    Code?</button> --}}
                <h6 class="font-manrope font-bold text-3xl lead-10 text-indigo-600">${{ $subtotal }}</h6>
            </div>
        </div>
        <div class="max-lg:max-w-lg max-lg:mx-auto">
            <p class="font-normal text-base leading-7 text-gray-500 text-center mb-5 mt-6">Shipping taxes, and
                discounts
                calculated
                at checkout</p>
            <a href="{{ route('billing_details') }}" wire:navigate
                class="rounded-full py-4 px-6 bg-indigo-600 text-white font-semibold text-lg w-full text-center transition-all duration-500 hover:bg-indigo-700">Checkout</a>

        </div>


    </div>
</section>
