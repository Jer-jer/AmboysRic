<!-- Admin Check -->
<link href="{{ asset('css/modals/employee_control.css') }}" rel="stylesheet">
<div class="modal modalfade" id="checkAdmin" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ __('Enter Admin Password') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="{{ url('admin_check') }}">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <input type="password" id="password" class="form-control @error('password') is-invalid @enderror" name="password" required>

                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Close') }}</button>
                    <button type="submit" class="btn btn-peach">{{ __('Submit') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>