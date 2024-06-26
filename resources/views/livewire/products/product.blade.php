<div class="group relative">

    @if ($product->discount)
        <div
            class="discount-badge absolute right-0 bg-orange-600 rounded-tr-lg rounded-bl-lg text-white py-1 px-2 text-[.7rem] ">
            {{ $product->discount->name }}
            {{ $product->discount->type === 'percentage' ? $product->discount->value . '%' : "$" . $product->discount->value }}
        </div>
    @endif


    <a href="{{ route('product_details', [$product->id, $product->slug]) }}">
        <div
            class="aspect-h-1 aspect-w-1 w-full overflow-hidden rounded-md bg-gray-200 lg:aspect-none group-hover:opacity-75 lg:h-80">
            <img src="{{ asset('storage/' . $product->thumbnail) }}" alt="{{ $product->name }}"
                class="h-full w-full object-cover object-center lg:h-full lg:w-full">
        </div>
    </a>

    <a href="{{ route('product_details', [$product->id, $product->slug]) }}">
        <div class="flex justify-between min-h-32 mt-2">
            <div class="product__title text-sm font-[500]">{{ $product->name }}</div>
            <div class="product__price">
                <div class="flex flex-col">
                    @if ($product->discount)
                        <p class="text-sm font-medium text-gray-500">
                            <del>${{ $product->price }}</del>
                        </p>
                    @endif
                    <p class="text-sm font-medium text-gray-700">
                        ${{ $product->calculated_price }}
                    </p>
                </div>
            </div>
        </div>
    </a>

    <button
        class="inline-flex items-center justify-center gap-2 rounded border border-rose-700 bg-rose-700 px-4 py-2 font-[500] leading-6 text-white hover:border-rose-600 hover:bg-rose-600 hover:text-white focus:ring focus:ring-rose-400/50 active:border-rose-700 active:bg-rose-700 dark:focus:ring-rose-400/90 w-full">
        Add to Cart
    </button>



</div>
