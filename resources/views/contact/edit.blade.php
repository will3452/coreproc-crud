@extends('layouts.app')
@section('content')
    <div class="container">
        <h2>Edit Contact</h2>
        <form action="{{ route('contacts.update', $contact) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method("PUT")
            <div class="form-group">
                <label for="">Name</label>
                <input type="text" 
                class="form-control" 
                name="name" 
                value="{{ $contact->name }}"
                required>
                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="">Email</label>
                <input type="text"
                 class="form-control" 
                 name="email" 
                 value="{{ $contact->email }}"
                 required>
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="">Mobile No.</label>
                <input type="text" 
                class="form-control"
                name="phone"
                value="{{ $contact->phone }}"
                required>
                @error('phone')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="">Address</label>
                <input type="text"
                 class="form-control" 
                 name="address" 
                 value="{{ $contact->address }}"
                 required>
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
@endsection