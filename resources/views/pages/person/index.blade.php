@extends('layouts.app')
@section('content')
    <div class="page-title-box">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h4 class="page-title mb-1">People</h4>
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item active">Welcome to People Page</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>

    <div class="page-content-wrapper">
        <div class="container-fluid">
            @if ($message = Session::get('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    {{ $message }}
                </div>
            @endif
            <div class="card">
                <div class="card-body">
                    <div class="py-3">
                        <a href="{{ route('person.create') }}" class="btn btn-primary">Create new data</a>
                    </div>
                    <table id="person-table" class="table table-bordered dt-responsive nowrap"
                        style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>NIK</th>
                                <th>Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $no = 1;
                            @endphp
                            @foreach ($people as $person)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $person->NIK }}</td>
                                    <td>{{ $person->name }}</td>
                                    <td>
                                        <form action="{{ route('person.destroy', $person) }}" method="post" id="form-delete-{{$person->id}}">
                                            @csrf
                                            <input type="hidden" name="_method" value="DELETE">
                                        </form>
                                        <a href="{{ route('person.edit', $person->id) }}" class="btn btn-warning">Edit</a>
                                        <button class="btn btn-danger btn-delete" data-id="{{ $person->id }}">Delete</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('script')
    <script>
        $(document).ready(function() {
            $('#person-table').DataTable();

            $('#person-table').on('click', '.btn-delete', function() {
                let id = $(this).data('id');
                Swal.fire({
                    title: "Are you sure?",
                    text: "You won't be able to revert this!",
                    icon: "warning",
                    showCancelButton: !0,
                    confirmButtonText: "Yes, delete it!",
                    cancelButtonText: "No, cancel!",
                    confirmButtonClass: "btn btn-success mt-2",
                    cancelButtonClass: "btn btn-danger ml-2 mt-2",
                    buttonsStyling: !1
                }).then(function(t) {
                    t.value ? 
                        $('#form-delete-'+id).submit()
                    : t.dismiss === Swal.DismissReason.cancel && Swal.fire({
                        title: "Cancelled",
                        text: "Your data is safe :)",
                        icon: "error"
                    })
                })
            })
        })
    </script>
@endsection
