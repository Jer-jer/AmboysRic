<!-- Make Purchase Confirmation -->
<link href="{{ asset('css/modals/product_control.css') }}" rel="stylesheet">
<div class="modal modalfade" id="confirm" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-danger" id="exampleModalLongTitle">Alert</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Confirm Purchase?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-peach" data-toggle="modal" data-target="#confirm_success" data-dismiss="modal">Yes</button>
            </div>
        </div>
    </div>
</div>
<div class="modal modalfade" id="confirm_success" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title available" id="exampleModalLongTitle">Success</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Purchase Successful
            </div>
            <div class="modal-footer">
                <a href="{{ url('make-purchase') }}" class="btn btn-peach">
                    Close
                </a>
            </div>
        </div>
    </div>
</div>