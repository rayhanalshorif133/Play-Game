<div class="modal fade" id="showDetailsCampaign" tabindex="-1" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel3">
                    Campaign Details
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="line"></div>
            <div class="modal-body">
                <div class="row">
                    {{-- thumbnail --}}
                    <div class="col-12 col-md-6 mb-3">
                        <h4 class="text-base text-bolder">Thumbnail:</h4>
                        <span id="campaign-thumbnail"></span>
                    </div>
                    <div class="col-12 col-md-6 mb-3">
                        <h4 class="text-base text-bolder">Banner:</h4>
                        <span id="campaign-banner"></span>
                    </div>
                    <div class="col-12 col-lg-4 col-md-6 mb-1">
                        <h4 class="text-base" id="campaign-title"></h4>
                    </div>
                    <div class="col-12 col-lg-4 col-md-6 mb-1">
                        <h4 class="text-base" id="campaign-type"></h4>
                    </div>
                    <div class="col-12 col-lg-4 col-md-6 mb-1">
                        <span id="campaign-status"></span>
                    </div>
                    <div class="col-12 col-lg-4 col-md-6 mb-1 d-none" id="campaign-per_question_score">
                        <h4 class="text-base"></h4>
                    </div>
                    <div class="col-12 col-lg-4 col-md-6 mb-1 d-none" id="campaign-total_questions">
                        <h4 class="text-base"></h4>
                    </div>
                    <div class="col-12 col-lg-4 col-md-6 mb-1 d-none" id="campaign-total_time_limit">
                        <h4 class="text-base"></h4>
                    </div>
                    <div class="col-12 col-lg-4 col-md-6 mb-1">
                        <h4 class="text-base" id="campaign-createdBy"></h4>
                    </div>
                    <div class="col-12 col-lg-4 col-md-6 mb-1">
                        <h4 class="text-base" id="campaign-updatedBy"></h4>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
