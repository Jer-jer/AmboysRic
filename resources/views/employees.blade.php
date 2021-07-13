@extends('layouts.sidebarnav')

@section('content')
<link href="{{ asset('css/app.css') }}" rel="stylesheet">
<link href="{{ asset('css/employees.css') }}" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/css/all.min.css" integrity="sha256-2XFplPlrFClt0bIdPgpz8H7ojnk10H69xRqd9+uTShA=" crossorigin="anonymous" />
<div class="mt-5 mb-4">
    <div class="col-lg-9 mt-4 mt-lg-0">
        <div class="row">
            <div class="col-md-12">
                <div class="user-dashboard-info-box table-responsive mb-0 bg-white p-4 shadow-sm employees">
                    <table class="table manage-candidates-top mb-0">
                        <thead>
                            <tr>
                                <th>
                                    Employees
                                    <i class="fa fa-plus add icon-click" data-toggle="modal" data-target="#addEmployee" aria-hidden="true" style="padding-left: 5px;"></i>
                                </th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Position</th>
                                <th class="action text-right">Manage</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($employees as $employee)
                            <tr class="candidates-list">
                                <td class="title">
                                    <div class="candidate-list-details">
                                        <div class="candidate-list-info">
                                            <div class="candidate-list-title">
                                                <h5 class="mb-0 text-black">{{ $employee->name }}</h5>
                                            </div>
                                            <div class="candidate-list-option">
                                                <ul class="list-unstyled">
                                                    <li><i class="fas fa-envelope pr-1"></i>{{ $employee->email }}</li>
                                                    <li><i class="fas fa-map-marker-alt pr-1"></i>{{ $employee->address }}</li>
                                                    <li><i class="fas fa-phone pr-1"></i>{{ $employee->contact_no }}</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="candidate-list-favourite-time text-center">
                                    <span class="candidate-list-time order-1 
                                    @if($employee->status == 'EMPLOYED') employed 
                                    @elseif($employee->status == 'SUSPENDED') suspended
                                    @elseif($employee->status == 'FIRED') fired 
                                    @endif">
                                        {{ $employee->status }}
                                    </span>
                                </td>
                                <td class="candidate-list-favourite-time text-center">
                                    <i class="fas 
                                    @if($employee->position == 'MANAGER') fa-briefcase
                                    @else fa-user  
                                    @endif icon-status"></i>
                                    <span class="candidate-list-time">{{ $employee->position }}</span>
                                </td>
                                <td>
                                    <ul class="list-unstyled mb-0 d-flex justify-content-end">
                                        <li>
                                            <i class="fas fa-pencil-alt text-info icon-click editEmp" data-id="{{ $employee->email }}"></i>
                                        </li>
                                        <li>
                                            <i class="far fa-trash-alt text-danger icon-click deleteEmp" data-id="{{ $employee->email }}"></i>
                                        </li>
                                    </ul>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).on('click', '.editEmp', function() {    
        var user_email = $(this).data('id');
            $.ajax({
            url: '/edit_employee',
            type: 'GET',
            data: 'id='+user_email,
            dataType: 'JSON',
            success: function(data, textStatus, jqXHR){ 
                $(".modal-body #id").val(data.id);
                $(".modal-body #employee-name").val(data.name);
                $(".modal-body #email").val(data.email);
                $(".modal-body #password").val(data.password);
                $(".modal-body #address").val(data.address);
                $(".modal-body #contact-number").val(data.contact_no);        
                $(".modal-body #stats").val(data.status);
                $(".modal-body #pos").val(data.position);
                $("a[href='edit']").attr('href', "edit_employee/"+data.id);
                $('#editEmployee').modal('show');
            },
            error: function(jqXHR, textStatus, errorThrown){

        },
        });  
    });

    $(document).on('click', '.deleteEmp', function() {    
        var user_email = $(this).data('id');
            $.ajax({
            url: '/edit_employee',
            type: 'GET',
            data: 'id='+user_email,
            dataType: 'JSON',
            success: function(data, textStatus, jqXHR){ 
                $(".modal-footer #yes-delete").attr("data-id", data.email);
                $('#paConfirm').modal('show');
            },
            error: function(jqXHR, textStatus, errorThrown){

        },
        });  
    });
</script>

@include('modals.auth.add_employee')
@include('modals.auth.edit_employee')
@include('modals.alert')
@endsection