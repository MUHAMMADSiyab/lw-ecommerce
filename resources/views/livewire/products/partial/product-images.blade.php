@push('styles')
    <!-- Link Swiper's CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <style>
        .mySwiper .swiper-slide-thumb-active {
            opacity: 1;
        }
    </style>
@endpush

<div class="slider__area w-full p-5 h-full flex gap-2 flex-row-reverse">
    <div class="swiper mySwiper2 mx-auto w-full h-full">
        <div class="swiper-wrapper">
            {{-- @foreach ($images as $image) --}}
            <template x-for="(image, index) in productImages">
                <div class="swiper-slide flex justify-center items-center">
                    <img class="w-full h-full block object-cover" :src="'http://127.0.0.1:8000/storage/' + image" />
                </div>
            </template>
            {{-- @endforeach --}}
        </div>
    </div>

    <!-- Bottom slides -->
    <div thumbsSlider="" class="swiper mySwiper h-full">
        <div class="swiper-wrapper">
            {{-- @foreach ($images as $image) --}}
            <template x-for="(image, index) in productImages">
                <div class="swiper-slide  opacity-55 flex justify-center items-center">
                    <img class="w-full h-full object-cover block" :src="'http://127.0.0.1:8000/storage/' + image" />
                </div>
            </template>
            {{-- @endforeach --}}
        </div>
    </div>
</div>

@push('scripts')
    <!-- Swiper JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

    <!-- Initialize Swiper -->
    <script>
        var swiper = new Swiper(".mySwiper", {
            direction: 'vertical',
            spaceBetween: 10,
            slidesPerView: 4,
            freeMode: true,
            watchSlidesProgress: true,
        });
        var swiper2 = new Swiper(".mySwiper2", {
            spaceBetween: 10,
            thumbs: {
                swiper: swiper,
            },
        });
    </script>
@endpush

<script>
    document.addEventListener('livewire:init', () => {
        Livewire.on('imagesChanged', (event) => {
            // const content = `
            //     <div class="swiper-slide  opacity-55 flex justify-center items-center">
            //         <img class="w-full h-full object-cover block" src="https://static-01.daraz.pk/p/9721529763177d470be998d05d5e656f.jpg" />
            //     </div>
            // `;

            // Array.from(document.getElementsByClassName('swiper-wrapper'))
            //     .forEach(wrapper => {
            //         wrapper.innerHTML += content;
            //     })
        });
    });
</script>
