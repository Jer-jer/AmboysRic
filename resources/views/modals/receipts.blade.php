<!-- Make Purchase Confirmation -->
<link href="{{ asset('css/modals/product_control.css') }}" rel="stylesheet">
<div class="modal modalfade" id="receipts" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Receipts</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Status</th>
                            <th scope="col">Created at</th>
                            <th scope="col">Updated at</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($receipts as $receipt)
                        <tr>
                            <th scope="row" id="id">{{ $receipt->id }}</th>
                            <td id="status" class="@if( $receipt->status == 'pending' ) text-peach @else text-success @endif">
                                @if( $receipt->status == 'pending' )
                                    Pending
                                @else
                                    Sold
                                @endif
                            </td>
                            <td id="createdat">{{ $receipt->created_at }}</td>
                            <td id="updatedat">{{ $receipt->updated_at}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-peach" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<script>

</script>