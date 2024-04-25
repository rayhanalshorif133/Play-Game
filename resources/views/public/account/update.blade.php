@extends('layouts.app_public', ['title' => 'Tournament'])

@section('styles')
@endsection

@section('content')

<main role="main">



    <!--/ Section one Star /-->
    <section id="account-panel">
      <div class="container-fluid">
        <div class="wrap-one  d-flex justify-content-between">
          <div class="title-box">

          </div>
        </div>
        <div class="row justify-content-center mb-5">
          {{-- update phone number with a form --}}
          <div class="col-md-6">
            {{-- get paly icon image --}}
            <div class="text-center">
              <img src="{{ asset('images/play_icon.png') }}" alt="play icon" class="img-fluid" width="100">
            </div>
            <div class="card">
              <div class="card-header">
                <h4 class="card-title">Update Phone Number</h4>
              </div>
              <div class="card-body">
                <form method="POST" action="{{ route('account.update') }}">
                  @csrf
                  @method('POST')
                  <div class="mb-3">
                    <label for="phone" class="form-label">Phone Number</label>
                    <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror"
                      name="msisdn" value="{{ Auth::user()->msisdn }}" required autocomplete="phone" autofocus>
                    @error('phone')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                    @enderror
                  </div>
                  <div class="mb-3">
                    <button class="btn btn-primary d-grid w-100" type="submit">Update Phone Number</button>
                  </div>
                </form>
              </div>
            </div>

        </div>
      </div>
    </section>

  </main>
@endsection
{{-- scripts --}}
@push('scripts')
@endpush
