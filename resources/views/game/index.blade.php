@extends('layouts.app')

@section('content')
    <div class="px-3 container-p-y">
        <div class="row p-1rem">
            <div class="card pb-2">
                <div class="d-flex justify-content-between">
                    <h5 class="card-header">Game Details</h5>
                </div>
                @include('show_session_msg')
                <form action="{{ route('admin.games.update') }}" method="POST" enctype="multipart/form-data"
                    class="row g-3 px-5">
                    @csrf
                    @method('PUT')
                    <!-- Title -->
                    <div class="col-12 col-md-6">
                        <label for="title" class="form-label">Title:</label>
                        <input type="text" class="form-control" id="title" name="title" value="{{ $game->title }}"
                            required>
                        @error('title')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <!-- Title -->
                    <div class="col-12 col-md-6">
                        <label for="keyword" class="form-label">Keyword:</label>
                        <input type="text" class="form-control" id="keyword" name="keyword" value="{{ $game->keyword }}"
                            required>
                        @error('keyword')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Description -->
                    <div class="col-12">
                        <label for="description" class="form-label">Description:</label>
                        <textarea class="form-control" id="description" name="description" rows="4" required>{{ $game->description }}</textarea>
                        @error('description')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Banner -->
                    <div class="col-12 col-md-6">
                        <!-- Image Preview -->
                        <div class="mt-2 image_container">
                            <label class="text-bold">Preview Current Banner</label>
                            <img id="banner-preview" src="{{ asset($game->banner) }}" alt="Banner Preview" class="img-fluid">

                        </div>
                        <label for="banner" class="form-label">Banner:</label>
                        <input type="file" class="form-control" id="banner" name="banner" accept="image/*">
                        @error('banner')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Status -->
                    <div class="col-12 col-md-6">
                        <label for="status" class="form-label">Status:</label>
                        <select class="form-select" id="status" name="status">
                            <option value="1" {{ $game->status == 1 ? 'selected' : '' }}>Active</option>
                            <option value="0" {{ $game->status == 0 ? 'selected' : '' }}>Inactive
                            </option>
                        </select>
                        @error('status')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Game URL -->
                    <div class="col-12">
                        <label for="game_url" class="form-label">Game URL:</label>
                        <input type="url" class="form-control" id="game_url" name="game_url"
                            value="{{ $game->url }}">
                        @error('game_url')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Submit Button -->
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('js/custom/game.js') }}"></script>
@endpush
