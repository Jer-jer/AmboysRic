<!-- Edit Product -->
<link href="{{ asset('css/modals/product_control.css') }}" rel="stylesheet">
<div class="modal modalfade" id="editProduct" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Edit Product</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="{{ route('edit_product_confirm') }}">
                @csrf
                <div class="modal-body">
                    <input type="hidden" class="form-control" id="id" placeholder="ID Number Here" name="id">
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="product-name" class="col-form-label">Product Name:</label>
                                <input type="text" class="form-control" id="product-name" placeholder="Product Name Here" name="product_name">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="product-name" class="col-form-label">Category:</label>
                                <select class="form-control" id="category" name="category">
                                    <option value="rice">Rice</option>
                                    <option value="appetizer">Appetizer</option>
                                    <option value="main_dish" selected>Main Dish</option>
                                    <option value="beverage">Beverage</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="product-name" class="col-form-label">Status:</label>
                                <select class="form-control status-change" id="stats" name="status">
                                    <option class="text-success" value="available" selected>Available</option>
                                    <option class="text-danger" value="not_available">Not Available</option>
                                </select>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="product-name" class="col-form-label">{{ __('Price:') }}</label>
                                <div class="input-group mb-2 mr-sm-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">{{ __('Php.') }}</div>
                                    </div>
                                    <input type="text" id="price" class="form-control" name="price">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-peach">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    $(document).ready(() => {
        var $select = $('.status-change');
        $select.each(function() {
            $(this).addClass($(this).children(':selected').val());
        }).on('change', function(ev) {
            $(this).attr('class', 'form-control').addClass($(this).children(':selected').val());
        });
    });
</script>