<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="{{ config('midtrans.clientKey') }}"></script>
    <!-- Note: replace with src="https://app.midtrans.com/snap/snap.js" for Production environment -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? config('app.name') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>


<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
        @include('layouts.navigation')

        <main id="content" role="main">
            <div class="max-w-[85rem] mx-auto py-10 px-4 sm:px-6 lg:px-8 text-gray-800 dark:text-gray-400">
                <div
                    class="flex max-w-sm w-full mx-auto flex-col bg-white border shadow-sm rounded-xl dark:bg-gray-800 dark:border-gray-700 dark:shadow-slate-700/[.7]">
                    <div
                        class="bg-gray-100 border-b rounded-t-xl py-3 px-4 md:py-4 md:px-5 dark:bg-gray-800 dark:border-gray-700">
                        <p class="mt-1 text-2xl text-gray-500 dark:text-gray-500">
                            Pembayaran
                        </p>
                    </div>
                    <div class="p-4 md:p-5">
                        <h3 class="text-lg font-bold text-gray-800 dark:text-white">
                            {{ $order->first_name . ' ' . $order->last_name }}
                        </h3>
                        <p class="mt-2 text-gray-800 dark:text-gray-400">
                            {{ $order->email }}
                        </p>

                        <div class="flex flex-col gap-1 mt-3">
                            <span>Quantity: {{ $order->qty }}</span>
                            <span class="text-red-600"> Total Harga: Rp.
                                {{ number_format($order->total_price, 0, ',', '.') }} </span>
                        </div>

                        <button type="button" id="pay-button"
                            class="py-3 px-4 mt-2 inline-flex justify-center items-center gap-2 rounded-md border border-transparent font-semibold bg-blue-500 text-white hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-all text-sm dark:focus:ring-offset-gray-800">
                            Bayar Sekarang
                        </button>
                    </div>
                </div>
            </div>
        </main>

    </div>

    <script type="text/javascript">
        // For example trigger on button clicked, or any time you need
        var payButton = document.getElementById('pay-button');
        payButton.addEventListener('click', function() {
            // Trigger snap popup. @TODO: Replace TRANSACTION_TOKEN_HERE with your transaction token
            window.snap.pay('{{ $snapToken }}', {
                onSuccess: function(result) {
                    alert("payment success!");
                    window.location.href = "{{ route('orders.list') }}";
                },
                onPending: function(result) {
                    alert("wating your payment!");
                    window.location.href = "{{ route('orders.list') }}";
                },
                onError: function(result) {
                    alert("payment failed!");
                    window.location.href = "{{ route('orders.list') }}";
                },
                onClose: function() {
                    /* You may add your own implementation here */
                    alert('you closed the popup without finishing the payment');
                }
            })
        });
    </script>
</body>

</html>
