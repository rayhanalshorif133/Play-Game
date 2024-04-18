@extends('layouts.app')

@section('content')
    <div class="px-3 container-p-y">
        <div class="row p-1rem">
            <div class="card pb-2">
                <div class="d-flex justify-content-between px-2">
                    <h5 class="card-header">Update Campaign</h5>
                    <a href="{{ route('admin.campaigns.index') }}" class="btn btn-danger btn-sm d-block d-flex my-2">
                        <i class='bx bx-arrow-back me-1'></i> Back</a>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.campaigns.update',$campaign->id) }}" method="POST" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="row g-1">
                            <div class="col-12 col-lg-4 col-md-6 mb-0">
                                <label for="title" class="form-label required">Title</label>
                                <input type="text" id="title" required class="form-control" name="title"
                                    placeholder="Enter campaign title" value="{{$campaign->title}}"/>
                            </div>
                            <div class="col-12 col-lg-4 col-md-6 mb-0">
                                <label for="thumbnail" class="form-label optional">Thumbnail</label>
                                <input type="file" id="thumbnail" class="form-control" name="thumbnail"
                                    placeholder="Enter campaign thumbnail" />
                            </div>
                            <div class="col-12 col-lg-4 col-md-6 mb-0">
                                <label for="banner" class="form-label optional">banner</label>
                                <input type="file" id="banner" class="form-control" name="banner"
                                    placeholder="Enter campaign banner" />
                            </div>
                            <div class="col-12 col-lg-4 col-md-6 mb-0">
                                <label for="campaign_type" class="form-label required">Type</label>
                                <select id="campaign_type" required class="form-select" name="type">
                                    <option value="quiz" @if ($campaign->type == 'quiz') selected @endif>Quiz</option>
                                    <option value="game" @if ($campaign->type == 'game') selected @endif>Game</option>
                                </select>
                            </div>
                            <div class="col-12 col-lg-4 col-md-6 mb-0 quiz_option @if ($campaign->type == 'game') d-none @endif">
                                <label for="total_time_limit" class="form-label required">Total Time Limit
                                    <small>(Min)</small></label>
                                <input type="number" id="total_time_limit" class="form-control"
                                    name="total_time_limit" placeholder="Enter total time limit" value="{{$campaign->total_time_limit}}"/>
                            </div>
                            {{-- total_questions --}}
                            <div class="col-12 col-lg-4 col-md-6 mb-0 quiz_option @if ($campaign->type == 'game') d-none @endif">
                                <label for="total_questions" class="form-label required">Total Questions</label>
                                <input type="number" id="total_questions" class="form-control"
                                    name="total_questions" placeholder="Enter total questions" value="{{$campaign->total_questions}}"/>
                            </div>
                            <div class="col-12 col-lg-4 col-md-6 mb-0 quiz_option @if ($campaign->type == 'game') d-none @endif">
                                <label for="per_question_score" class="form-label required">Per Question's Score</label>
                                <input type="number" id="per_question_score" class="form-control"
                                    name="per_question_score" placeholder="Enter per question's score" value="{{$campaign->per_question_score}}"/>
                            </div>
                            {{-- status --}}
                            <div class="col-12 col-lg-4 col-md-6 mb-0">
                                <label for="status" class="form-label required">Status</label>
                                <select id="status" required class="form-select" name="status">
                                    <option value="1" @if ($campaign->status == '1') selected @endif>Active</option>
                                    <option value="0" @if ($campaign->status == '0') selected @endif>Inactive</option>
                                </select>
                            </div>
                            {{-- description --}}
                            <div class="col-12 col-lg-4 col-md-6 mb-0">
                                <label for="description" class="form-label optional">Description</label>
                                <textarea id="description" class="form-control" name="description"
                                    placeholder="Enter campaign description"></textarea>
                            </div>


                            <div class="d-flex space-x-5 my-3">
                                <a href="{{ route('admin.campaigns.index') }}" class="btn btn-outline-secondary">
                                    Cancel
                                </a>
                                <button type="submit" class="btn btn-primary">Update</button>
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
        $('#campaign_type').on('change', function () {
            if (this.value === 'quiz') {
                $('.quiz_option').removeClass('d-none');
            } else {
                $('.quiz_option').addClass('d-none');
            }
        });
    });
</script>
@endpush
