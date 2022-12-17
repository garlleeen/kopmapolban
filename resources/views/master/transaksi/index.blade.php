<x-app-layout>
    <x-slot name="header_content">
        <h1>{{ __('Transaksi') }}</h1>
    </x-slot>

    <x-slot name="script">
        <script>
            function onScanSuccess(decodedText, decodedResult) {
                var audio = new Audio("{{ asset('media/beep.mp3') }}");
                audio.play();
                $("#product_code").val(decodedText);
                // alert("QR berhasil di scan");
            }

            function onScanFailure(error) {
                console.warn(`Code scan error = ${error}`);
            }

            let html5QrcodeScanner = new Html5QrcodeScanner("reader", { fps: 10, qrbox: {width: 250, height: 250} }, false);
            html5QrcodeScanner.render(onScanSuccess, onScanFailure);
        </script>
    </x-slot>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <p>Scan Qr Code Disini</p>
                    </div>
                </div>

                <div class="card-body">
                    <!-- <form> -->
                        <div class="form-group row">
                            <div class="col-sm-4">
                                <div id="reader"></div>
                            </div>
                            <div class="col-sm-4">
                                <div class="row">
                                    <input type="text" class="form-control" id="product_code" wire:model="product_code" value="{{ old('product_code') }}" placeholder="Qr Code Product">   
                                </div>
                                <div class="row">
                                    <input type="text" class="form-control" id="product_name" wire:model="product_name" value="{{ old('product_name') }}" placeholder="Name Product"> 
                                </div>
                                <div class="row">
                                    <input type="text" class="form-control" id="product_price" wire:model="product_price" value="{{ old('product_price') }}" placeholder="Price Product">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <!-- <button class="btn btn-primary">Submit</button> -->
                                <button class="btn btn-primary" wire:click="addToCart">Submit</button>
                                 <!-- <button class="p-2 border-2 rounded border-blue-500 hover:border-blue-600 bg-blue-500 hover:bg-blue-600" wire:click="addToCart">Add To Cart</button> -->
                            </div>
                        </div>
                    <!-- <form> -->
                </div>
            </div>
        </div>
    </div>

    <livewire:cart-component />

    <div class="flex">
        <div class="flex flex-wrap justify-between w-3/4">
            @foreach ($Products as $product)
                <livewire:product-component :product='$product' />
            @endforeach
        </div>
    </div>
    

</x-app-layout>
