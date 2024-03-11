@extends('layouts.app')

@section('content')
    <div class="px-3 container-p-y">
        <div class="row p-1rem">
            <div class="card pb-2">
                <div class="d-flex justify-content-between px-2">
                    <h5 class="card-header">Update Question</h5>
                    <a href="{{ route('admin.campaigns.index') }}" class="btn btn-danger btn-sm d-block d-flex my-2">
                        <i class='bx bx-arrow-back me-1'></i> Back</a>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.questions.store') }}" method="POST" enctype="multipart/form-data">
                        @method('post')
                        @csrf
                        <input type="hidden" name="id" value="{{ $question->id }}">
                        <div class="row g-1">
                            <div class="col-12 col-lg-4 col-md-6 mb-0">
                                <label for="select_campaign" class="form-label required">Select Campaign</label>
                                <select id="select_campaign" required class="form-select" name="campaign_id">
                                    @foreach ($campaigns as $campaign)
                                        <option value="{{ $campaign->id }}" @if ($campaign->id == $question->campaign_id)
                                            selected
                                        @endif>{{ $campaign->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-12 col-lg-4 col-md-6 mb-0">
                                <label for="title" class="form-label required">Title</label>
                                <input type="text" id="title" required class="form-control" name="title"
                                    placeholder="Enter campaign title" value="{{$question->title}}" />
                            </div>
                            <div class="col-12 col-lg-4 col-md-6 mb-0">
                                <label for="image" class="form-label optional">image</label>
                                <input type="file" id="image" class="form-control" name="image"
                                    placeholder="Enter question image" />
                            </div>
                            <div class="col-12 col-lg-4 col-md-6 mb-0">
                                <label for="option_a" class="form-label optional">Option A</label>
                                <input type="text" id="option_a"  class="form-control" name="option_a"
                                    placeholder="Enter option A" value="{{$question->option_a}}"/>
                            </div>
                            <div class="col-12 col-lg-4 col-md-6 mb-0">
                                <label for="option_b" class="form-label optional">Option B</label>
                                <input type="text" id="option_b"  value="{{$question->option_b}}"  class="form-control" name="option_b"
                                    placeholder="Enter option B" />
                            </div>
                            <div class="col-12 col-lg-4 col-md-6 mb-0">
                                <label for="option_c" class="form-label optional">Option C</label>
                                <input type="text" id="option_c" value="{{$question->option_c}}"  class="form-control" name="option_c"
                                    placeholder="Enter option C" />
                            </div>
                            <div class="col-12 col-lg-4 col-md-6 mb-0">
                                <label for="option_d" class="form-label optional">Option D</label>
                                <input type="text" id="option_d" value="{{$question->option_d}}" class="form-control" name="option_d"
                                    placeholder="Enter option D" />
                            </div>
                            <div class="col-12 col-lg-4 col-md-6 mb-0">
                                <label for="correct_option" class="form-label required">Correct Option</label>
                                <select id="correct_option" required class="form-select" name="correct_option">
                                    <option value="option_a" @if ($question->correct_option == 'option_a')
                                        selected
                                    @endif>Option A</option>
                                    <option value="option_b" @if ($question->correct_option == 'option_b')
                                        selected
                                    @endif>Option B</option>
                                    <option value="option_c" @if ($question->correct_option == 'option_c')
                                        selected
                                    @endif>Option C</option>
                                    <option value="option_d" @if ($question->correct_option == 'option_d')
                                        selected
                                    @endif>Option D</option>
                                </select>
                            </div>
                            <div class="col-12 col-lg-4 col-md-6 mb-0">
                                <label for="score" class="form-label required">Score</label>
                                <input type="number" id="score" required class="form-control" name="score"
                                    placeholder="Enter question's score" value="{{$question->score}}" />
                            </div>
                            {{-- status --}}
                            <div class="col-12 col-lg-4 col-md-6 mb-0">
                                <label for="status" class="form-label required">Status</label>
                                <select id="status" required class="form-select" name="status">
                                    <option value="1" @if($question->score == '1') selected @endif >Active</option>
                                    <option value="0" @if($question->score == '0') selected @endif >Inactive</option>
                                </select>
                            </div>
                            {{-- description --}}
                            <div class="col-12 col-lg-4 col-md-6 mb-0">
                                <label for="description" class="form-label optional">Description</label>
                                <textarea id="description" class="form-control" name="description"
                                    placeholder="Enter campaign description">{{$question->description}}</textarea>
                            </div>


                            <div class="d-flex space-x-5 my-3">
                                <a href="{{ route('admin.questions.index') }}" type="button" class="btn btn-outline-secondary">
                                    Close
                                </a>
                                <button type="submit" class="btn btn-primary">
                                    Update
                                </button>
                            </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
@endsection


{{-- scripts --}}
@push('scripts')
<script>
    $(document).ready(function () {
        $('#correct_option').on('change', function () {
            var option = $(this).val();
            option = '#' + option;
            const correctOptionValue = $(option).val();
            if(!correctOptionValue){
                $(option).focus();
                $(option).after('<small class="text-danger">This field is required</small>');
            }
            setTimeout(() => {
                $(option).next().remove();
            }, 3000);
        });

    });
</script>
@endpush
