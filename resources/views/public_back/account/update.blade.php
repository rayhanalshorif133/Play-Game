@extends('layouts.app_public', ['title' => 'Tournament'])

@section('styles')
@endsection

@section('content')
<div class="discription-wrapper">
  <section class="h-100 gradient-form" style="background-color: #fff;">
      <div class="container py-5 h-100">
          <div class="row d-flex justify-content-center align-items-center h-50">
              <div class="col-xl-10 col-md-10">
                  <div class="row g-0 justify-content-center">
                      <div class="col-lg-8 col-md-8 mt-5">
                          <h3 class="text-center mx-auto py-2">
                              Update Your <span class="text-danger">Play</span> Account
                          </h3>
                          <form method="POST" action="{{ route('account.update') }}">
                              @csrf
                              @method('POST')
                              <!-- Email input -->
                              <div class=" mb-4">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                placeholder="Name" name="name" value="{{ Auth::user()->name }}">
                              </div>
                              <div class=" mb-4">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                placeholder="Email" name="email" value="{{ Auth::user()->email }}">
                              </div>
                              <div class=" mb-4">
                                <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror"
                                placeholder="Phone Number" name="msisdn" value="{{ Auth::user()->msisdn }}" required autocomplete="phone" autofocus>
                              </div>
                              <button type="submit" class="btn btn-primary common-btn w-full py-2 mb-2">
                                  Update
                              </button>
                          </form>

                      </div>
                  </div>
              </div>
          </div>
      </div>
  </section>
</div>
@endsection

@push('scripts')
@endpush
