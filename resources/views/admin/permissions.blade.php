@extends('admin.master')

@section('body')
    <div class="container p-5">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2>Permissions Management</h2>
            <a href="" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#permissionModal"
                id="createPermissionBtn">Create</a>
        </div>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="modal fade" id="permissionModal" tabindex="-1" aria-labelledby="permissionModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="permissionModalLabel">Create</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form id="permissionForm" action="{{ route('admin.permission.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="_method" id="methodField" value="POST">
                        <input type="hidden" id="permissionId">
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="name" class="form-label">Permission Name</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    aria-describedby="emailHelp">
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" id="submitBtn">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Handle</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($permissions as $key => $item)
                    <tr>
                        <th scope="row">{{$key+1}}</th>
                        <td>{{ $item->name }}</td>
                        <td>
                            <a href="" class="btn btn-sm btn-primary editPermissionBtn" data-bs-toggle="modal"
                                data-bs-target="#permissionModal" data-id="{{ $item->id }}"
                                data-name="{{ $item->name }}">Edit</a>
                            <form class="d-inline" action="{{route('admin.permission.delete', $item->id)}}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button onclick="return confirm('Sure to delete?')" type="submit" class="btn btn-sm btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>
    </div>

    @push('scripts')
        <script>
            $(document).ready(function() {
                $("#createPermissionBtn").on('click', function() {
                    $('#permissionModalLabel').text('Create Permission')
                    $('#permissionForm')[0].reset();
                    $('#permissionId').val('');
                    $('#submitBtn').text('Create');
                    $('#methodField').val('POST');
                    const url = "{{ route('admin.permission.store', ':id') }}";
                    $('#permissionForm').attr('action', url);
                    $('#permissionForm').attr('method', 'POST')
                })

                $(".editPermissionBtn").on('click', function() {
                    const permissionId = $(this).data('id');
                    const permissionName = $(this).data('name');

                    $('#permissionModalLabel').text('Edit Permission')
                    $('#name').val(permissionName)
                    $('#permissionId').val(permissionId);
                    $('#submitBtn').text('Update');
                    $('#methodField').val('PUT');
                    const url = "{{ route('admin.permission.update', ':id') }}".replace(':id', permissionId);
                    $('#permissionForm').attr('action', url);
                })
            })
        </script>
    @endpush
@endsection
