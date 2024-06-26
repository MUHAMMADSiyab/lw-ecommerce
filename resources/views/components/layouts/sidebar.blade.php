<div class="w-64 bg-white text-gray-800 overflow-y-auto mt-8">
    <ul class="flex flex-col px-1 py-2">
        <li class="mb-4">

            @php
                $categories = \App\Models\Category::tree()->get()->toTree();
            @endphp

            <x-layouts.categories-list :categories="$categories" />
        </li>
    </ul>

</div>
