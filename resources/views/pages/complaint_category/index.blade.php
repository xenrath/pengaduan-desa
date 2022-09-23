@extends('layouts.app')
@section('content')
    <div class="page-title-box">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h4 class="page-title mb-1">Complaint Category</h4>
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item active">Welcome to Complaint Category Page</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="page-content-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-4">
                    <div class="card">
                        <div class="card-header bg-transparent border-bottom">
                            Tambah Kategori Aduan
                        </div>

                        <div class="card-body">
                            <form action="{{ route('complaint-category.store') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="complaint_category_name">Nama Kategori Aduan</label>
                                    <input type="hidden" name="id_category" id="id_category">
                                    <input type="text"
                                        class="form-control @error('complaint_category_name') is-invalid @enderror"
                                        name="complaint_category_name" id="complaint_category_name">
                                    @error('complaint_category_name')
                                        <span class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="form-control btn-primary">Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-xl-8">
                    <div class="card">
                        <div class="card-body">
                            <table id="complaint-category-table" class="table table-bordered dt-responsive nowrap"
                                style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Kategori</th>
                                        <th>Opsi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $no = 1;
                                    @endphp
                                    @foreach ($complaint_categories as $complaint_category)
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td>{{ $complaint_category->complaint_category_name }}</td>
                                            <td>
                                                <form
                                                    action="{{ route('complaint-category.destroy', $complaint_category->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    <button type="button" class="btn btn-warning btn-sm" id="btn-edit"
                                                        data-id="{{ $complaint_category->id }}"
                                                        data-name="{{ $complaint_category->complaint_category_name }}">Edit</button>
                                                    <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                                </form>
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
    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function() {
            $('#complaint-category-table').DataTable();
            $('#complaint-category-table').on('click', '#btn-edit', function() {
                let id_category = $(this).data('id');
                let name = $(this).data('name');

                $('#id_category').val(id_category);
                $('#complaint_category_name').val(name);

            });
        })

    </script>
@endsection
