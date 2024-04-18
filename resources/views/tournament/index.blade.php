@extends('layouts.app_public')

@section('styles')
<style>
    .btn{
        background-color: #696cff;
        color: white;
    }
    
    .btn-icon{
        background-color: #696cff;
        color: white;
    } 

    .btn-label-facebook{
        background-color: #3b5998;
    }

    .btn-label-google-plus{
        background-color: #dd4b39;
    }
</style>
@endsection

@section('content')
    <div class="w-px-400 mx-auto mt-5">
        <!-- Logo -->
        <div class="card px-4 py-2 flex mx-auto text-center">
            tournament Page
        </div>

    </div>
@endsection


{{-- scripts --}}
@push('scripts')
@endpush
