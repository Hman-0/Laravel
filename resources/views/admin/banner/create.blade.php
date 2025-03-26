@extends('layouts.admin')

@section('title', 'Thêm banner')

@section('content')
    <h1>Thêm banner</h1>
    <form action="{{ route('admin.banners.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        
        <div class="mb-3">
            <label for="ten_banner" class="form-label">Tên banner</label>
            <input type="text" class="form-control @error('ten_banner') is-invalid @enderror" id="ten_banner" name="ten_banner" aria-describedby="ten_banner" reuired value="{{ old('ten_banner') }}">
            @error('ten_banner')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="anh" class="form-label">Hình ảnh</label>
            <input type="file" class="form-control @error('anh') is-invalid @enderror" id="anh" name="anh" aria-describedby="anh" >
            @error('anh')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="link" class="form-label">Liên kết</label>
            <input type="text" class="form-control @error('link') is-invalid @enderror" id="link" name="link" aria-describedby="link"  value="{{ old('link') }}">
            @error('link')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Thêm</button>
    </form>
@endsection

