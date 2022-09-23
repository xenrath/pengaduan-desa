@extends('layouts.app')
@section('content')
<div class="page-title-box">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h4 class="page-title mb-1">User</h4>
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item active">Welcome to User Page</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="page-content-wrapper">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#not-active" role="tab">
                            <i class="far fa-clock mr-1"></i> <span class="d-none d-md-inline-block">Unactivated</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#user-active" role="tab">
                            <i class="far fa-check-circle mr-1"></i> <span
                                class="d-none d-md-inline-block">Activated</span>
                        </a>
                    </li>
                </ul>

                <div class="tab-content p-3">
                    <div class="tab-pane active" id="not-active" role="tabpanel">
                        <table id="unactive-table" class="table table-bordered dt-responsive nowrap"
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
                                @foreach ($userNotActive as $notActive)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $notActive->NIK }}</td>
                                    <td>{{ $notActive->name }}</td>
                                    <td>
                                        <form action="{{ route('user.update', $notActive->id) }}" method="post">
                                            @csrf
                                            <input type="hidden" name="_method" value="PUT">

                                            <button type="submit" class="btn btn-primary">Activated</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane" id="user-active" role="tabpanel">
                        <table id="active-table" class="table table-bordered dt-responsive nowrap"
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
                                @foreach ($userActive as $active)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $active->NIK }}</td>
                                    <td>{{ $active->name }}</td>
                                    <td>
                                        <form action="{{ route('user.update', $active->id) }}" method="post">
                                            @csrf
                                            <input type="hidden" name="_method" value="PUT">

                                            <button type="submit" class="btn btn-danger">Unactivated</button>
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
    $(document).ready(function () {
        $('#unactive-table').DataTable();
        $('#active-table').DataTable();
    })

</script>
@endsection
