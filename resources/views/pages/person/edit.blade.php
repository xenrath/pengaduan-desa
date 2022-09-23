@extends('layouts.app')
@section('content')
<div class="page-title-box">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h4 class="page-title mb-1">People</h4>
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item active">Welcome to Edit People Page</li>
                </ol>
            </div>

        </div>
    </div>
</div>

<div class="page-content-wrapper">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('person.update', $person->id) }}" method="post">
                    @csrf
                    <input type="hidden" name="_method" value="PUT">
                    <div class="form-group">
                        <label for="NIK">NIK</label>
                        <input type="text" class="form-control @error('NIK') is-invalid @enderror" name="NIK" id="NIK"
                            placeholder="NIK" value={{ $person->NIK }}>
                        @error('NIK')
                        <span class="text-danger text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control @error('NIK') is-invalid @enderror" name="name" id="name"
                            placeholder="name" value={{ $person->name }}>
                        @error('name')
                        <span class="text-danger text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary form-control">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection