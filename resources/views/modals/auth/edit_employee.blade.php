<!-- Edit Employee -->
<link href="{{ asset('css/modals/employee_control.css') }}" rel="stylesheet">
<div class="modal modalfade" id="editEmployee" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Edit Employee</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="{{ url('api/edit_employee') }}">
                @csrf
                <div class="modal-body">
                    <input type="hidden" id="id" class="form-control @error('name') is-invalid @enderror" name="id">
                    <div class="form-group">
                        <label for="employee-name" class="col-form-label">{{ __('Employee Name:') }}</label>
                        <input type="text" id="employee-name" class="form-control @error('name') is-invalid @enderror" name="name">

                        @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="email" class="col-form-label">{{ __('Email Address:') }}</label>
                                <input type="email" id="email" class="form-control  @error('email') is-invalid @enderror" name="email">

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="password" class="col-form-label">{{ __('Password:') }}</label>
                                <input type="password" id="password" class="form-control @error('password') is-invalid @enderror" name="password" required>

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="address" class="col-form-label">{{ __('Address:') }}</label>
                                <input type="text" id="address" class="form-control @error('address') is-invalid @enderror" name="address">

                                @error('address')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="contact-number" class="col-form-label">{{ __('Contact Number:') }}</label>
                                <input type="text" id="contact-number" class="form-control @error('contact_no') is-invalid @enderror" name="contact_no">

                                @error('contact_no')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="product-name" class="col-form-label">Status:</label>
                                <select id="stats" class="form-control status-change @error('status') is-invalid @enderror" name="status">
                                    <option class="text-success" value="EMPLOYED">Employed</option>
                                    <option class="text-warning" value="SUSPENDED">Suspended</option>
                                    <option class="text-danger" value="FIRED">Fired</option>
                                </select>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="product-name" class="col-form-label">Position:</label>
                                <select id="pos" class="form-control position-change pos @error('status') is-invalid @enderror" name="position">
                                    <option value="EMPLOYEE">Employee</option>
                                    <option value="MANAGER">Manager</option>
                                </select>
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
        // $('.status-change').val((e, val) => {
        //     if(val == 'employed'){
        //         $('.status-change').addClass('employed');
        //     }else if(val == 'suspended'){
        //         $('.status-change').addClass('suspended');
        //     }else{
        //         $('.status-change').addClass('fired');
        //     }
        // });
        // $('.status-change').on('change', (e) => {
        //     if(e.target.value == 'employed'){
        //         $('.status-change').removeClass().addClass('form-control status-change employed');
        //     }else if(e.target.value == 'suspended'){
        //         $('.status-change').removeClass().addClass('form-control status-change suspended');
        //     }else{
        //         $('.status-change').removeClass().addClass('form-control status-change fired');
        //     }
        // });
        var $select = $('.status-change');
        var $pos_select = $('position-change');
        $select.each(function() {
            $(this).addClass($(this).children(':selected').val());
        }).on('change', function(ev) {
            $(this).attr('class', 'form-control').addClass($(this).children(':selected').val());
        });
        // $pos_select.each(function() {
        //     $(this).addClass($(this).children(':selected').val());
        // }).on('change', function(ev) {
        //     $(this).attr('class', 'form-control').addClass($(this).children(':selected').val());
        // });
    });
</script>