@extends('layouts.app')
@section('content')
    <div class="page-title-box">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h4 class="page-title mb-1">Complaint</h4>
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item active">Welcome to Complaint Page</li>
                    </ol>
                </div>
                
            </div>
        </div>
    </div>

    <div class="page-content-wrapper">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#home" role="tab">
                                <i class="far fa-clock mr-1"></i> <span class="d-none d-md-inline-block">Waiting</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#profile" role="tab">
                                <i class="far fa-check-circle mr-1"></i> <span
                                    class="d-none d-md-inline-block">Approved</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#messages" role="tab">
                                <i class="far fa-times-circle mr-1"></i> <span
                                    class="d-none d-md-inline-block">Decline</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#finished" role="tab">
                                <i class="fas fa-check-double mr-1"></i> <span
                                    class="d-none d-md-inline-block">Finished</span>
                            </a>
                        </li>
                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content p-3">
                        <div class="tab-pane active" id="home" role="tabpanel">
                            <table id="complaint-table-waiting" class="table table-bordered dt-responsive nowrap"
                                style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Aduan</th>
                                        <th>Kategori Aduan</th>
                                        <th>User</th>
                                        <th>Status</th>
                                        <th>Detail</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $no = 1;
                                    @endphp
                                    @foreach ($waiting as $w)
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td>{{ $w->complaint_content }}</td>
                                            <td>{{ $w->complaintCategory->complaint_category_name }}</td>
                                            <td>{{ $w->user->name }}</td>
                                            <td>{{ $w->status }}</td>
                                            <td>
                                                <a href="{{ route('complaint.show', $w->id) }}"
                                                    class="btn btn-success btn-sm">Detail</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane" id="profile" role="tabpanel">
                            <table id="complaint-table-approve" class="table table-bordered dt-responsive nowrap"
                                style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Aduan</th>
                                        <th>Kategori Aduan</th>
                                        <th>User</th>
                                        <th>Status</th>
                                        <th>Detail</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $no = 1;
                                    @endphp
                                    @foreach ($approved as $a)
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td>{{ $a->complaint_content }}</td>
                                            <td>{{ $a->complaintCategory->complaint_category_name }}</td>
                                            <td>{{ $a->user->name }}</td>
                                            <td>{{ $a->status }}</td>
                                            <td>
                                                <a href="{{ route('complaint.show', $a->id) }}"
                                                    class="btn btn-success btn-sm">Detail</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane" id="messages" role="tabpanel">
                            <table id="complaint-table-decline" class="table table-bordered dt-responsive nowrap"
                                style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Aduan</th>
                                        <th>Kategori Aduan</th>
                                        <th>User</th>
                                        <th>Status</th>
                                        <th>Detail</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $no = 1;
                                    @endphp
                                    @foreach ($declines as $d)
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td>{{ $d->complaint_content }}</td>
                                            <td>{{ $d->complaintCategory->complaint_category_name }}</td>
                                            <td>{{ $d->user->name }}</td>
                                            <td>{{ $d->status }}</td>
                                            <td>
                                                <a href="{{ route('complaint.show', $d->id) }}"
                                                    class="btn btn-success btn-sm">Detail</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane" id="finished" role="tabpanel">
                            <table id="complaint-table-finished" class="table table-bordered dt-responsive nowrap"
                                style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Aduan</th>
                                        <th>Kategori Aduan</th>
                                        <th>User</th>
                                        <th>Status</th>
                                        <th>Detail</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $no = 1;
                                    @endphp
                                    @foreach ($finished as $finish)
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td>{{ $finish->complaint_content }}</td>
                                            <td>{{ $finish->complaintCategory->complaint_category_name }}</td>
                                            <td>{{ $finish->user->name }}</td>
                                            <td>{{ $finish->status }}</td>
                                            <td>
                                                <a href="{{ route('complaint.show', $finish->id) }}"
                                                    class="btn btn-success btn-sm">Detail</a>
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
            $('#complaint-table-waiting').DataTable();
            $('#complaint-table-approve').DataTable();
            $('#complaint-table-decline').DataTable();
            $('#complaint-table-finished').DataTable();
        })

    </script>
@endsection
