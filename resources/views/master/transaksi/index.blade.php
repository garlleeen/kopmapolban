<x-app-layout>
    <x-slot name="header_content">
        <h1>{{ __('Transaksi') }}</h1>
    </x-slot>

    <x-slot name="script">
        <script>
            function onScanSuccess(decodedText, decodedResult) {
                $("#product_code").val(decodedText);
                alert("QR berhasil di scan");
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
                <form action="#" method="post">
                    @csrf

                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col-sm-4">
                                <div id="reader"></div>
                            </div>
                            <div class="col-sm-4">
                                <input type="text" value="{{ old('product_code') }}" name="product_code" id="product_code" class="form-control" placeholder="Qr Code Produk">
                            </div>
                            <div class="col-sm-4">
                                <button class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                        
                    </div>
                </form>
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
