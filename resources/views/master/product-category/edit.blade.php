<x-app-layout>
    <x-slot name="header_content">
        <h1>{{ __('Product Category') }}</h1>
    </x-slot>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible show fade">
                            <div class="alert-body">
                                <button class="close" data-dismiss="alert">
                                    <span>&times;</span>
                                </button>
                                There's something wrong!
                                <p>
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </p>
                            </div>
                        </div>
                    @endif
                </div>
                @foreach($ProductCategory as $PC)
                    <form action="{{ route('product-category.update', $PC->product_category_id) }}" method="post">
                        @csrf
                        @method('PUT')

                        <div class="card-body">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Category Name</label>
                                <div class="col-sm-9">
                                    <input type="text" value="{{ old('product_category_name') ?? $PC->product_category_name }}" name="product_category_name" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-right">
                            <button class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                    @endforeach
            </div>
        </div>
    </div>
</x-app-layout>