@props(['categories'])


<ul class="pl-4">
    @foreach ($categories as $category)
        <li class=" mb-2">
            @if (!count($category->children))
                <a href="{{ route('category_products', [$category->id, $category->slug]) }}"
                    class="px-2 py-2 hover:text-green-500">
                    {{ $category->name }}
                </a>
            @else
                <span class="text-gray-400 text-sm font-[500]">{{ $category->name }}</span>
            @endif

            @if (count($category->children))
                <x-layouts.categories-list :categories="$category->children" />
            @endif
        </li>
    @endforeach
</ul>
