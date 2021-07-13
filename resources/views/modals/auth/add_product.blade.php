<!-- Add Product -->
<link href="{{ asset('css/modals/product_control.css') }}" rel="stylesheet">
<div class="modal modalfade" id="addProduct" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">{{ __('Add Product') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="{{ route('add_product') }}">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="id" class="col-form-label">{{ __('ID:') }}</label>
                                <input type="text" class="form-control" id="id" name="product_id">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="product-name" class="col-form-label">{{ __('Product Name:') }}</label>
                                <input type="text" class="form-control" id="product-name" name="product_name">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="product-name" class="col-form-label">{{ __('Category:') }}</label>
                                <select class="form-control" name="category">
                                    <option value="rice">{{ __('Rice') }}</option>
                                    <option value="appetizer">{{ __('Appetizer') }}</option>
                                    <option value="main_dish">{{ __('Main Dish') }}</option>
                                    <option value="beverage">{{ __('Beverage') }}</option>
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
                                    <input type="text" class="form-control" name="price">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Close') }}</button>
                    <button type="submit" class="btn btn-peach">{{ __('Save Changes') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>