<link href="{{ asset('css/modals/employee_control.css') }}" rel="stylesheet">
<div class="modal modalfade" id="status_error" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-danger" id="exampleModalLongTitle">Alert</h5>
            </div>
            <div class="modal-body">
                You are suspended/fired
            </div>
            <div class="modal-footer">
                <a class="btn btn-peach" href="{{ route('logout') }}" onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                    <span class="nav_name">Sign Out</span>
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
                <!-- <button type="button" class="btn btn-peach" data-dismiss="modal">Yes</button> -->
            </div>
        </div>
    </div>
</div>
<script>
    $('#status_error').modal({
        backdrop: 'static',
        keyboard: false
    });
</script>