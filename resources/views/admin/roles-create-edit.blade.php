@extends('admin.master')

@section('body')
    <div class="container p-4">
        <h2 class="mb-3">{{ isset($role) ? 'Edit Role' : 'Create Role' }}</h2>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ isset($role) ? route('admin.roles.update', $role->id) : route('admin.roles.store') }}"
            method="POST">
            @csrf
            @if (isset($role))
                @method('PUT')
            @endif
            <div class="mb-3">
                <label for="name" class="form-label">Role Name</label>
                <input type="text" class="form-control" id="name" name="name"
                    value="{{ old('name', $role->name ?? '') }}" required>
            </div>
            <div class="mb-3">
                <label for="permissions" class="form-label">Assign Permissions</label>
                <select class="form-select" name="permissions[]" multiple>
                    @foreach ($permissions as $permission)
                        <option value="{{ $permission->name }}"
                            {{ isset($role) && $role->permissions->contains($permission->id) ? 'selected' : '' }}>
                            {{ $permission->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-success">{{ isset($role) ? 'Update' : 'Create' }}</button>
            <a href="{{ route('admin.roles.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
@endsection
