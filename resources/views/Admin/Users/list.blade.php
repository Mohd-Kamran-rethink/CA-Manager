@extends('Admin.index')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Agents</h1>
                </div>
            </div>
            @if (session()->has('msg-success'))
                <div class="alert alert-success" role="alert">
                    {{ session('msg-success') }}
                </div>
            @elseif (session()->has('msg-error'))
                <div class="alert alert-danger" role="alert">
                    {{ session('msg-success') }}
                </div>
            @endif
        </div>
    </section>



    <section class="content">
        <div class="card">
            <div class="card-body">

                <div class="mb-3 d-flex justify-content-between align-items-centers row">

                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="col-3 my-2">
                                <a href="{{url('users/add')}}" class="btn btn-primary">Add User</a>
                            </div>

                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover text-nowrap">
                                    <thead>
                                        <tr>
                                            <th>S.No.</th>
                                            <th>Role</th>
                                            <th>Project</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($users as $item)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td style="text-transform: capitalize">{{ $item->role }}</td>
                                                <td>
                                                    @if ($item->role == 'manager')
                                                        Leads Project
                                                    @elseif($item->role == 'customer_care_manager')
                                                        Customer Project
                                                    @elseif($item->role == 'expense_manager')
                                                        Expense Project
                                                    @endif
                                                </td>
                                                <td>{{ $item->name }}</td>
                                                <td>{{ $item->email }}</td>
                                                <td>
                                                    <a href="{{ url('users/edit/?id=' . $item->id) }}"
                                                        title="Edit this user" class="btn btn-primary"><i
                                                            class="fa fa-pen"></i></a>
                                                    <button title="Delete this user"
                                                        onclick="openUserModal({{ $item->id }})" class="btn btn-danger"><i
                                                            class="fa fa-trash"></i></button>
                                                </td>


                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="10" class="text-center">No data</td>
                                            </tr>
                                        @endforelse

                                    </tbody>
                                </table>
                            </div>
                            <div class="card-footer clearfix">
                                {{ $users->links('pagination::bootstrap-4') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="modal fade show" id="modal-default" style=" padding-right: 17px;" aria-modal="true" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Delete user</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form action="{{ url('/users/delete') }}" method="POST">
                    @csrf
                    <input type="hidden" name="deleteId" id="deleteInput">
                    <div class="modal-body">
                        <h4>Are you sure you want to delete this user?</h4>
                    </div>
                    <div class="modal-footer ">
                        <button type="submit" class="btn btn-danger">Delete</button>
                        <button type="button" data-dismiss="modal" aria-label="Close"
                            class="btn btn-default">Cancel</button>
                </form>
            </div>
        </div>
    </div>
    <script>
        function openUserModal(id)
        {
            $('#modal-default').modal('show')
            $('#deleteInput').val(id)
        }
        const searchData = () => {
            event.preventDefault();
            const url = new URL(window.location.href);

            const searchValue = $('#searchInput').val().trim();
            const stateFilter = $('#stateFilter').val().trim();
            const languageFilter = $('#languageFilter').val().trim();
            url.searchParams.set('search', searchValue);
            url.searchParams.set('stateFilter', stateFilter);
            url.searchParams.set('languageFilter', languageFilter);
            $('#search-form').attr('action', url.toString()).submit();
        }
    </script>
@endsection
