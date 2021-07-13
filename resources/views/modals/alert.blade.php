<!-- Make Purchase Confirmation -->
<link href="{{ asset('css/modals/employee_control.css') }}" rel="stylesheet">
<div class="modal modalfade" id="paConfirm" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-danger" id="exampleModalLongTitle">Alert</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Are you sure?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" id="yes-delete" class="btn btn-peach" data-dismiss="modal">Yes</button>
            </div>
        </div>
    </div>
</div>
<div class="modal modalfade" id="confirm_success" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title employed" id="exampleModalLongTitle">Success</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Successfully Removed
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-peach">
                    <a href="delete" class="button-link">Close</a>
                </button>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).on('click', '#yes-delete', function() {    
        var user_email = $(this).data('id');
        console.log(user_email)
            $.ajax({
            url: '/edit_employee',
            type: 'GET',
            data: 'id='+user_email,
            dataType: 'JSON',
            success: function(data, textStatus, jqXHR){ 
                $("a[href='delete']").attr('href', "delete_employee/"+data.id)
                $('#confirm_success').modal('show');
            },
            error: function(jqXHR, textStatus, errorThrown){

        },
        });  
    });
</script>