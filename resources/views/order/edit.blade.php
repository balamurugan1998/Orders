
<form id="order_create_form" class="validation">
    @csrf
    <div class="form-group row">
        <label for="example-text-input" class="col-md-2 col-form-label">Products*</label>
        <div class="col-md-10">
            <select name="product" id="product" class="form-control" required>
                <option value="" selected disabled>Select Product</option>
                @foreach ($products as $product)
                    <option @if($order->product_id == $product->id) selected @endif
                        value="{{$product->id}}">{{$product->product_name}}</option>
                @endforeach
            </select>
        </div>

    </div>
    <div class="form-group row" id="quantity_div">
        <label for="example-text-input" class="col-md-2 col-form-label">Quantity*</label>
        <div class="col-md-10">
            <input type="number" name="quantity" id="quantity" class="form-control" required min="1"
            value="{{$order->total_orders}}" max="{{$no_of_quantity}}">
            <input type="hidden" name="per_price" id="per_price" value="{{$order->individual_product_price}}">
        </div>
    </div>

    <div class="form-group row">
        <label for="example-text-input" class="col-md-2 col-form-label">Total Price*</label>
        <div class="col-md-10">
            <input type="hidden" name="total_price" id="total_price" class="form-control" value="{{$order->total_order_price}}">
            <input disabled type="text" name="total_price1" id="total_price1" class="form-control" value="{{$order->total_order_price}}">
        </div>
    </div>

    <div class="modal-footer">
        <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="order_create">Create New</button>
    </div>
</form>


<script>
    var form = $("#order_create_form");

    $("#order_create").click(function () {
        if (!form.valid()) { // Not Valid
            return false;
        } else {
            var data = form.serialize();

            $.ajax({
                type: 'POST',
                url: "{{route('order.store')}}",
                data: data,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                beforeSend: function() {
                    $('#order_create').html('....Please wait');
                },
                success: function(response) {
                    toastr.success(response.message);
                    $("#commonModal").modal('hide');
                    datatable();
                },
                complete: function(response) {
                    $('#order_create').html('Create New');
                },
                error: function(response) {
                    toastr.error("Something Wrong!");
                },
            });
        }
    });

    $("#product").change(function () {

        $.ajax({
            type: 'POST',
            url: "{{route('check_quantity')}}",
            data: { 'product': $(this).val() },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            beforeSend: function() {
                $('#order_create').html('....Please wait');
            },
            success: function(response) {
                if(response.success == true){
                    $("#per_price").val(response.price);
                    if(response.quantity != 0){
                        $("#quantity").attr('max',response.quantity);
                        $("#quantity_div").show();
                    }
                    else{
                        toastr.warning("OOPS! this product out of stock");
                    }
                }
            },
            complete: function(response) {
                $('#order_create').html('Create New');
            },
            error: function(response) {
                toastr.error("Something Wrong!");
            },
        });
    });

    $("#quantity").keyup(function(){
        per_price = $("#per_price").val();
        total_price = $(this).val() * per_price;

        console.log("per_price",per_price);
        console.log("total_price",total_price);

        $("#total_price").val(total_price);
        $("#total_price1").val(total_price);
    });

    $(function ()
    {
        form.validate({});
    });
</script>