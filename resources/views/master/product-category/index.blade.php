<x-app-layout>
    <x-slot name="header_content">
        <h1>{{ __('Product Category') }}</h1>
    </x-slot>

    <x-slot name="script">
        <script>
            var datatable = $('#crudProductCategory').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{!! url()->current() !!}'
                },
                columns: [
                    {data: 'no', name: 'no', render: function (data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                    }, width: '5%', class: 'text-center'},
                    { data: 'product_category_name', name: 'product_category_name'},
                    {
                        data: 'action',
                        name: 'action',
                        width: '15%',
                        orderable: false,
                        searchable: false,
                    }
                ]
            })
        </script>
    </x-slot>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="flex pb-4 -ml-3">
                        <a href="{{ route('product-category.create') }}" class="btn btn-primary shadow-none">
                            <span class="fas fa-plus"></span> Create
                        </a>
                        <div id="reader" width="600px"></div>
                        <form action="#">
                            <input type="text" id="result">
                        </form>
                    </div>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table id="crudProductCategory" class="table table-striped w-100">
                            <thead>
                                <tr>
                                    <th class="text-center">No</th>
                                    <th class="text-center">Category Name</th>
                                    <th class="text-center">Option</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>
    <script>
        function onScanSuccess(decodedText, decodedResult) {
            // handle the scanned code as you like, for example:
            // console.log(`Code matched = ${decodedText}`, decodedResult);
            $("#result").val(decodedText);
        }

        function onScanFailure(error) {
            // handle scan failure, usually better to ignore and keep scanning.
            // for example:
            console.warn(`Code scan error = ${error}`);
        }

        let html5QrcodeScanner = new Html5QrcodeScanner(
                                                            "reader",
                                                            { fps: 10, qrbox: {width: 250, height: 250} },
                                                            /* verbose= */ false);
        html5QrcodeScanner.render(onScanSuccess, onScanFailure);
    </script>
</x-app-layout>