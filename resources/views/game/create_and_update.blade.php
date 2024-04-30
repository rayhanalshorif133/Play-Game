<div class="modal fade" id="createNewGame" tabindex="-1" aria-hidden="true" style="display: none;">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createNewGameTitle">
                    Add New Game
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <hr />
            <form action="{{route('admin.games.store')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">                    
                    <div class="row">
                        <div class="col mb-3">
                            <label for="title" class="form-label required">Title</label>
                            <input type="text" id="title" name="title" class="form-control" required
                                placeholder="Enter Title">
                        </div>
                        <div class="col mb-3">
                            <label for="keyword" class="form-label required">Keyword</label>
                            <input type="text" id="keyword" name="keyword" class="form-control" required
                                placeholder="Enter Keyword">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label for="url" class="form-label required">Url</label>
                            <input type="text" id="url" name="url" class="form-control"
                                placeholder="Enter Url">
                        </div>
                        <div class="col mb-3">
                            <label for="status" class="form-label optional">Status</label>
                            <select id="status" class="form-select">
                                <option value="1" selected>Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label for="banner" class="form-label optional">Banner</label>
                            <input type="file" id="banner" name="banner" class="form-control" accept="image/*">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label for="description" class="form-label optional">Description</label>
                            <textarea id="description" name="description" class="form-control" placeholder="Enter Description"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>



<div class="modal fade" id="update_game" tabindex="-1" aria-hidden="true" style="display: none;">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="update_gameTitle">
                    Update Game
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <hr />
            <form action="{{route('admin.games.update')}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-body" style="padding: 0 1.5rem 1.5rem 1.5rem">                    
                    <div class="row">
                        <input type="hidden" name="id" id="set_game_id"/>
                        <div class="col mb-3">
                            <label for="update_title" class="form-label required">Title</label>
                            <input type="text" id="update_title" name="title" class="form-control" required
                                placeholder="Enter Title">
                        </div>
                        <div class="col mb-3">
                            <label for="update_keyword" class="form-label required">Keyword</label>
                            <input type="text" id="update_keyword" name="keyword" class="form-control" required
                                placeholder="Enter Keyword">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label for="update_url" class="form-label required">Url</label>
                            <input type="text" id="update_url" name="url" class="form-control"
                                placeholder="Enter Url">
                        </div>
                        <div class="col mb-3">
                            <label for="update_status" class="form-label optional">Status</label>
                            <select id="update_status" name="status" class="form-select">
                                <option value="1" selected>Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label for="update_banner" class="form-label optional">Banner</label>
                            <input type="file" id="update_banner" name="banner" class="form-control" accept="image/*">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label for="update_description" class="form-label optional">Description</label>
                            <textarea id="update_description" name="description" class="form-control" placeholder="Enter Description"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
