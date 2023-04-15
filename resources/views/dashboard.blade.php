<x-app-layout title="Oh My Florist">
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-transparent overflow-hidden shadow-sm sm:rounded-lg">
                <div class="grid grid-cols-2 gap-2 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-5">
                    @foreach ($products as $product)
                        <x-card id="{{ $product->id }}" title="{{ $product->name }}" price="{{ $product->price }}"
                            discount="{{ $product->discount }}" image_url="{{ $product->image_url }}" />
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
