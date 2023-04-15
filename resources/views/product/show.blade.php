<x-app-layout title="Oh My Florist">
    <div class="grid grid-cols-5">
        <div class="col-span-2 p-2 rounded-3xl">
            <div class="relative ">
                @if ($product->discount > 0)
                    <div class="absolute top-0 left-0 bg-red-400 text-white px-2 py-1 text-xs">
                        {{ $product->discount * 100 }}% OFF
                    </div>
                @endif
                <img src="{{ $product->image_url }}" class="w-full h-full rounded-xl object-cover"
                    alt="{{ $product->name }}">
            </div>
        </div>
        <div class="col-span-3 p-2">
            <div class="flex justify-between w-full">
                <h1 class="text-4xl font-bold">
                    {{ $product->name }}
                </h1>
                <div class="flex flex-col">
                    <span class="text-red-600 font-semibold text-4xl">
                        Rp. {{ number_format($product->price - $product->price * $product->discount, 0, ',', '.') }}
                    </span>
                    @if ($product->discount > 0)
                        <span class="text-gray-400 text-xl line-through"> Rp.
                            {{ number_format($product->price, 0, ',', '.') }}</span>
                    @endif
                </div>
            </div>

            <div class="px-4 mx-auto ">
                <div class="max-w-2xl lg:max-w-5xl mx-auto">
                    <div class="grid items-center lg:grid-cols-2 gap-6 lg:gap-16">
                        <div class="flex flex-col rounded-xl p-4 sm:p-6 lg:p-8 dark:border-gray-700">
                            <form method="post" action="{{ route('orders.store', $product->id) }}">
                                @csrf
                                <div class="grid gap-4">
                                    <!-- Grid -->
                                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                        <div>
                                            <label for="hs-firstname-contacts-1" class="sr-only">First Name</label>
                                            <input value="{{ old('firstName') }}" type="text" name="firstName"
                                                required id="hs-firstname-contacts-1"
                                                class="py-3 px-4 block w-full border-gray-200 rounded-md text-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-slate-900 dark:border-gray-700 dark:text-gray-400
                                                {{ $errors->has('firstName') ? 'border-red-500' : '' }}"
                                                placeholder="First Name">
                                            @error('firstName')
                                                <span class="text-red-500 text-xs">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div>
                                            <label for="hs-lastname-contacts-1" class="sr-only">Last Name</label>
                                            <input value="{{ old('lastName') }}" type="text" name="lastName"
                                                required id="hs-lastname-contacts-1"
                                                class="py-3 px-4 block w-full border-gray-200 rounded-md text-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-slate-900 dark:border-gray-700 dark:text-gray-400
                                            {{ $errors->has('lastName') ? 'border-red-500' : '' }}" "
                                                placeholder="Last Name">
                                            @error('lastName')
    <span class="text-red-500 text-xs">{{ $message }}</span>
@enderror
                                        </div>
                                    </div>
                                    <!-- End Grid -->

                                    <div>
                                        <label for="hs-quantity-contacts-1" class="sr-only">Quantity</label>
                                        <input type="number" name="quantity" id="hs-quantity-contacts-1"
                                            value="{{ old('quantity') ?? 1 }}" autocomplete="quantity"
                                            class="py-3 px-4 block w-full border-gray-200 rounded-md text-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-slate-900 dark:border-gray-700 dark:text-gray-400
                                            {{ $errors->has('quantity') ? 'border-red-500' : '' }}"
                                            " placeholder="Quantity">
                                            @error('quantity')
                                                <span class="text-red-500 text-xs">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div>
                                            <label for="hs-phone-number-1" class="sr-only">Phone Number</label>
                                            <input value="{{ old('phoneNumber') }}" type="text" name="phoneNumber"
                                                id="hs-phone-number-1"
                                                class="py-3 px-4 block w-full border-gray-200 rounded-md text-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-slate-900 dark:border-gray-700 dark:text-gray-400
                                            {{ $errors->has('phoneNumber') ? 'border-red-500' : '' }}"
                                                placeholder="Phone Number">
                                            @error('phoneNumber')
                                                <span class="text-red-500 text-xs">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div>
                                            <label for="hs-address-contacts-1" class="sr-only">Address</label>
                                            <input type="text" name="address" id="hs-address-contacts-1"
                                                value="{{ old('address') }}" autocomplete="Address"
                                                class="py-3 px-4 block w-full border-gray-200 rounded-md text-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-slate-900 dark:border-gray-700 dark:text-gray-400
                                            {{ $errors->has('address') ? 'border-red-500' : '' }}" " placeholder="address">
                                            @error('address')
    <span class="text-red-500 text-xs">{{ $message }}</span>
@enderror
                                        </div>
                                    </div>
                                    <!-- End Grid -->

                                    <div class="mt-4 grid">
                                        <button type="submit"
                                            class="inline-flex justify-center items-center gap-x-3 text-center bg-blue-600 hover:bg-blue-700 border border-transparent text-sm lg:text-base text-white font-medium rounded-md focus:outline-none focus:ring-2 focus:ring-blue-600 focus:ring-offset-2 focus:ring-offset-white transition py-3 px-4 dark:focus:ring-offset-gray-800">
                                            Checkout</button>
                                    </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
