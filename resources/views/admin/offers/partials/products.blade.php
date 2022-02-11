
<input id="myInput" type="text" class="form-control mb-2" placeholder="Search.." style="width:200px">
<table class="table table-bordered table-striped table-hover datatable datatable-products" style="background: white;">
    <thead>
        <tr>  
            <th></th>
            <th>
                {{ trans('cruds.product.fields.name') }}
            </th>
            <th>
                {{ trans('cruds.product.fields.price') }}
            </th>
            <th>
                {{ trans('cruds.product.fields.quantity') }}
            </th>
        </tr>
    </thead>
    <tbody>
        @foreach ($products as $product)
            <tr> 
                <td><input {{ $product->value ? 'checked' : null }} data-id="{{ $product->id }}" type="checkbox"
                        class="product-enable"></td>
                <td>{{ $product->name }}</td>
                <td>{{ $product->price }}</td>
                <td><input value="{{ $product->value ?? null }}" {{ $product->value ? null : 'disabled' }}
                        data-id="{{ $product->id }}" name="products[{{ $product->id }}]" type="number"
                        class="product-quantity form-control" placeholder="الكمية المتاحة"></td>
            </tr>
        @endforeach
    </tbody>
</table>

@section('scripts')
    @parent
    <script>
        $('document').ready(function() {
            $('.product-enable').on('click', function() {
                let id = $(this).attr('data-id')
                let enabled = $(this).is(":checked")
                $('.product-quantity[data-id="' + id + '"]').attr('disabled', !enabled)
                $('.product-quantity[data-id="' + id + '"]').val(null)
            })
            
            $("#myInput").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $(".datatable-products tr").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
        });
    </script> 
@endsection
