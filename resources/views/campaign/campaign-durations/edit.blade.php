<div class="modal fade" id="editcampaignDuration" tabindex="-1" aria-hidden="true" style="display: none;">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    Update Campaign Duration
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="line"></div>
            <form class="form" action="{{route('campaign-durations.update')}}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <h5 class="text-base"><span class="text-bolder">Select Campaign: <span id="selected_campaign" style="color: #7c7c7c"></span></span></h5>
                    <input type="hidden" id="campaign_id" name="campaign_id">
                    <div class="row g-2 mb-2">
                        <div class="col-12 col-md-6 mb-0">
                            <label for="name" class="form-label required">Name</label>
                            <input type="text" id="name" name="name" required class="form-control"
                                placeholder="Enter Name">
                        </div>
                        <div class="col-12 col-md-6 mb-0">
                            <label for="status" class="form-label required">Status</label>
                            <select class="form-select" name="status" id="status" required>
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                            </select>
                        </div>
                        <div class="col-12 col-md-6 mb-0">
                            <label for="start_date" class="form-label required">Start Date</label>
                            <input type="date" name="start_date" id="start_date" required class="form-control">
                        </div>
                        <div class="col-12 col-md-6 mb-0">
                            <label for="end_date" class="form-label required">End Date</label>
                            <input type="date" name="end_date" id="end_date" required class="form-control">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
