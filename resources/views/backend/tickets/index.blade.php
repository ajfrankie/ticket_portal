@extends('backend.layouts.master')

@section('title')
    @lang('translation.tickets')
@endsection
@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
            @lang('translation.tickets')
        @endslot
        @slot('title')
            @lang('translation.tickets')
        @endslot
    @endcomponent

    @include('backend.tickets.filter')

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body border-bottom">
                    <div class="d-flex align-items-center">
                        <h5 class="mb-0 card-title flex-grow-1">tickets</h5>
                        <a href="{{ route('admin.ticket.create') }}" class="btn btn-primary w-md">
                            <i class="fas fa-plus me-1"></i>
                            create ticket
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="">
                        <table class="table align-middle dt-responsive nowrap w-100 table-check">
                            <thead class="table-light">
                                <tr>
                                    <th scope="col">User</th>
                                    <th scope="col">Role</th>
                                    <th scope="col">Subject</th>
                                    <th scope="col">priority</th>
                                    <th scope="col">status</th>
                                    <th scope="col">description</th>
                                    <th scope="col">Action</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($tickets as $ticket)
                                    <tr>
                                        <td>{{ $ticket->user->name }}</td>
                                        <td>{{ $ticket->user->role }}</td>
                                        <td>{{ $ticket->subject }}</td>
                                        <td>{{ $ticket->priority }}</td>
                                        <td>
                                            @if ($ticket->status === 'open')
                                                <span class="badge bg-warning ">Open</span>
                                            @elseif ($ticket->status === 'in_progress')
                                                <span class="badge bg-primary">In Progress</span>
                                            @elseif ($ticket->status === 'closed')
                                                <span class="badge bg-success">Closed</span>
                                            @endif
                                        </td>

                                        <td>{{ $ticket->description }}</td>
                                        <td>
                                            <div class="btn-group text-nowrap" role="group">
                                                <button class="btn btn-soft-secondary btn-sm dropdown-toggle" type="button"
                                                    data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="bx bx-dots-horizontal-rounded fs-5" style="color:#898787"></i>
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="btnGroupVerticalDrop1">

                                                    <a class="dropdown-item"
                                                        href="{{ route('admin.ticket.edit', $ticket->id) }}">
                                                        <i class="bx bx-edit-alt"></i> Edit
                                                    </a>

                                                    <a class="dropdown-item"
                                                        href="{{ route('admin.ticket.destroy', $ticket->id) }}">
                                                        <i class="bx bx-bin-alt"></i>Delete
                                                    </a>

                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    @include('backend.tickets.delete')
                                    @endforeach
                                </tbody>
                            </table>
                        <!-- end table -->
                    </div>
                    <!-- end table responsive -->
                </div>
                <!-- end card body -->
                <div class="text-end">
                    <ul class="pagination-rounded">
                        {{ $tickets->appends(request()->query())->links('vendor.pagination.bootstrap-4') }}
                    </ul>
                </div>
            </div>
            <!--end card-->
        </div>
        <!--end col-->
    </div>
    <!--end row-->
@endsection
