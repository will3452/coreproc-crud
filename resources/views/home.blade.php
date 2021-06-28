@extends('layouts.app')

@section('content')
<div class="container">
    <!-- Button trigger modal -->
    <div class="d-flex justify-content-between">
        <div class="w-50">
            <form action="/home">
                <input type="search" name="q" placeholder="Search Contact" class="form-control">
            </form>
        </div>
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalLong">
            <i class="fa fa-plus"></i>
        </button>
    </div>
    
    <!-- Modal -->
    <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">NEW CONTACT</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('contacts.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="">Name</label>
                        <input type="text" class="form-control" name="name" required>
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Email</label>
                        <input type="text" class="form-control" name="email" required>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Mobile No.</label>
                        <input type="text" class="form-control" name="phone" required>
                        @error('phone')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Address</label>
                        <input type="text" class="form-control" name="address" required>
                        @error('address')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Picture</label>
                        <input type="file" name="img" class="d-block" accept="image/*">
                    </div>
                    <div class="d-flex justify-content-end">
                        <button class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
        </div>
    </div>

    
    @forelse ($contacts as $contact)
        <div class="card mt-2">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-2 d-flex justify-content-center align-items-center">
                        <img src="{{ $contact->img != null ? $contact->public_image : '/noimage.png'}}" alt="image of contact {{ $contact->id }}" class="custom-image">
                    </div>
                    <div class="col-md-10">
                        <div class="form-group">
                            <label for="">Name</label>
                            <input type="text" class="form-control form-control-sm" value="{{ $contact->name }}" readonly>
                        </div>
                        <div class="form-group row">
                            <div class="col">
                                <label for="">Email</label>
                                <input type="text" class="form-control form-control-sm" value="{{ $contact->email }}" readonly>
                            </div>
                            <div class="col">
                                <label for="">Mobile no.</label>
                                <input type="text" class="form-control form-control-sm" value="{{ $contact->phone }}" readonly>
                            </div>
                        </div>
                        <div class="form-group-row">
                            <label for="">Address</label>
                            <input type="text" class="form-control form-control-sm" value="{{ $contact->address }}" readonly>
                        </div>
                    </div>
                </div>
                <div class="text-center text-md-right mt-2">
                    <form action="{{ route('contacts.destroy',$contact) }}" id="deleteForm{{ $contact->id }}" method="POST" >
                        @csrf @method('DELETE')
                    </form>
                    <a href="{{ route('contacts.edit', $contact) }}" class="btn btn-secondary">Edit</a>
                    <button  class="btn btn-danger" onclick="confirmDelete({{ $contact->id }})">Delete</button>
                </div>
            </div>
        </div>
    @empty 
    <div class="w-100  d-flex justify-content-center align-items-center text-secondary" style="height:70vh;">
        No Contact to show.
    </div>
    @endforelse
</div>
@endsection

@push('extra-styles')
    <style>
        .custom-image{
            width:100px !important;
            height:100px !important;
            object-fit: cover;
            border-radius: 50%;
            background: red;
        }
    </style>
@endpush

@push('extra-scripts')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        function confirmDelete(id){
            confirm('are you sure ? ') && $('#deleteForm'+id).submit(); 
        }
    </script>
@endpush