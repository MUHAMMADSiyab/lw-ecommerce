<div class="p-10" x-data="{
    productImages: $wire.entangle('images'),
    currentVariations: $wire.entangle('current_variations'),
    changeImages(variation) {
        const variationExists =
            this.currentVariations.find(v => v.attribute_name === variation.attribute_name)
        if (!variationExists) {
            this.currentVariations = [...this.currentVariations, variation];
        } else {
            const index = this.currentVariations.
            findIndex(v => v.attribute_name === variation.attribute_name);

            this.currentVariations.splice(index, 1, variation);
        }

        if (variation.images.length) {
            this.productImages = variation.images;
        }
    },
}">
    {{-- <livewire:cart /> --}}
    <div class="main__content flex gap-16">
        {{-- Images area --}}
        <div class="images-area border border-gray-200 h-[550px] w-1/2" wire:ignore>
            @include('livewire.products.partial.product-images')
        </div>
        {{-- Details area --}}
        <div class="details-area w-1/2">
            <h3 class="text-3xl font-light">{{ $product->name }} </h3>
            <h5 class="text-2xl font-[500] mt-3 mb-5"><sup>$</sup>{{ $product->price }}</h5>

            @foreach ($product->variations->groupBy('attribute_name') as $label => $variations)
                <h6 class="py-2 text-gray-500 text-sm font-[500]">{{ $label }}</h6>

                <div class="grid grid-cols-3 gap-2 py-2">
                    @foreach ($variations as $variation)
                        <button
                            class="badge p-2 rounded text-sm shadow-sm border border-gray-100 text-center hover:bg-slate-50 transition"
                            :class="{
                                'bg-gray-700 text-white hover:bg-gray-700': currentVariations.map(v => v.id).includes(
                                    {{ $variation->id }})
                            }"
                            x-on:click="changeImages({{ $variation }})">
                            {{ $variation->attribute_value }}
                        </button>
                    @endforeach
                </div>
            @endforeach

            <button @click="$wire.handleAddToCart({{ $product->id }}, currentVariations)" @class([
                'inline-flex items-center my-4 justify-center gap-2 rounded border border-rose-700 bg-rose-700 px-4 py-2 font-[500] leading-6 text-white hover:border-rose-600 hover:bg-rose-600 hover:text-white focus:ring focus:ring-rose-400/50 active:border-rose-700 active:bg-rose-700 dark:focus:ring-rose-400/90 w-full',
                '!pointer-events-none !opacity-40 !cursor-not-allowed' => $productAlreadyInCart,
            ])>
                {{ !$productAlreadyInCart ? 'Add to Cart' : 'Added to Cart' }}
            </button>

            <div class="description__area">
                <h5 class="text-sm font-[500] text-gray-600 mb-3 mt-6">Product Description</h5>
                <hr>
                <div class="py-2">
                    {!! $product->description !!}
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    document.addEventListener('livewire:initialized', function() {
        console.log(this.$wire);
    })
</script>
