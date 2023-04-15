@props(['id', 'title', 'price', 'discount', 'image_url'])

<a href="{{ route('product.show', $id) }}"
    class="relative border scale-95 duration-200 transition-all hover:scale-100 shadow-gray-300  dark:text-gray-200 text-black rounded-xl overflow-hidden">

    @if ($discount > 0)
        <div class="absolute top-0 left-0 bg-red-400 text-white px-2 py-1 text-xs">
            {{ $discount * 100 }}% OFF
        </div>
    @endif

    <img src="{{ $image_url }}" class="w-full h-64 object-cover" alt="">

    <h1 class="mt-2 text-center text-lg font-semibold">
        {{ $title }}
    </h1>

    <div class="text-red-400 py-3 text-sm flex flex-col gap-y-1 items-center">
        <span>
            Rp. {{ number_format($price - $price * $discount, 0, ',', '.') }}
        </span>
        <span class="text-gray-400 text-xs line-through">
            Rp. {{ number_format($price, 0, ',', '.') }}
        </span>
    </div>
</a>
