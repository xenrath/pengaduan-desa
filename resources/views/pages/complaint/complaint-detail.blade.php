@extends('layouts.app')
@section('content')
    <link href="{{ asset('assets/libs/magnific-popup/magnific-popup.css') }}" rel="stylesheet" type="text/css" />

    <div class="page-title-box">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h4 class="page-title mb-1">Detail Complaint</h4>
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item active">Welcome to Detail Complaint Page</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="page-content-wrapper">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header bg-transparent border-bottom">
                    Detail Pengaduan
                </div>
                <div class="card-body">
                    <table class="table">
                        <tr>
                            <td>Nama Pelapor</td>
                            <td>:</td>
                            <td>{{ $complaint->user->name }}</td>
                        </tr>
                        <tr>
                            <td>Jenis Aduan</td>
                            <td>:</td>
                            <td>{{ $complaint->complaintCategory->complaint_category_name }}</td>
                        </tr>
                        <tr>
                            <td>Aduan</td>
                            <td>:</td>
                            <td>{{ $complaint->complaint_content }}</td>
                        </tr>
                        <tr>
                            <td>Tanggal</td>
                            <td>:</td>
                            <td>{{ date("d M Y", strtotime($complaint->created_at)) }}</td>
                        </tr>
                        <tr>
                            <td>Status</td>
                            <td>:</td>
                            <td>{{ $complaint->status }}</td>
                        </tr>
                        <tr>
                            <td>Gambar</td>
                            <td>:</td>
                            <td>
                                <a class="image-popup-no-margins" href="{{ asset($complaint->complaint_image) }}">
                                    <img class="img-fluid" src="{{ asset($complaint->complaint_image) }}" alt=""
                                        width="100px">
                                </a>

                            </td>
                        </tr>
                    </table>
                    <center>
                        <form id="form-status" method="POST" action="{{ route('complaint.update', $complaint->id) }}">
                            @csrf
                            <input type="hidden" name="_method" value="PUT">
                            <input type="hidden" name="status" id="field-status">
                        </form>
                        @if ($complaint->status == 'Waiting' || $complaint->status == 'Decline')
                            <button class="btn btn-primary btn-sm" id="btn-confirm">Konfirmasi</button>
                        @endif
                        @if ($complaint->status == 'Approved')
                            <button class="btn btn-success btn-sm" id="btn-finished">Selesai</button>    
                        @endif
                        @if ($complaint->status == 'Waiting' || $complaint->status == 'Approved')
                            <button class="btn btn-danger btn-sm" id="btn-decline">Tolak</button>
                        @endif

                    </center>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="{{ asset('assets/libs/magnific-popup/jquery.magnific-popup.min.js') }}"></script>
    <script>
        $(document).ready(function() {

            $(".image-popup-no-margins").magnificPopup({
                type: "image",
                closeOnContentClick: !0,
                closeBtnInside: !1,
                fixedContentPos: !0,
                mainClass: "mfp-no-margins mfp-with-zoom",
                image: {
                    verticalFit: !0
                },
                zoom: {
                    enabled: !0,
                    duration: 300
                }
            })
            $('#btn-confirm').on('click', function() {
                $('#field-status').val('Approved');
                $('#form-status').submit();
            });

            $('#btn-decline').on('click', function() {
                $('#field-status').val('Decline');
                $('#form-status').submit();
            });

            $('#btn-finished').on('click', function() {
                $('#field-status').val('Finished');
                $('#form-status').submit();
            });
        });
    </script>
@endsection
