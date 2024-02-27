<div class="modal fade" id="createNewUserinfo" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Create New User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{route('user.store')}}" method="POST">
                @method('POST')
                @csrf
                <div class="modal-body">
                    <div class="row g-1">
                        <div class="col-12 col-md-6 mb-0">
                            <label for="user_name" class="form-label required">Name</label>
                            <input type="text" id="user_name" required class="form-control" name="name" placeholder="Enter Name"/>
                        </div>
                        <div class="col-12 col-md-6 mb-0">
                            <label for="email" class="form-label required">Email</label>
                            <input type="email" id="user_email" required class="form-control" name="email" placeholder="Enter Email" />
                        </div>
                    </div>
                    <div class="row g-1">
                        <div class="col-12 col-md-6 mb-0">
                            <label for="password" class="form-label required">Password</label>
                            <input type="password" id="password" class="form-control" required name="password" placeholder="Enter Password" />
                        </div>
                        <div class="col-12 col-md-6 mb-0">
                            <label for="confirmPassword" class="form-label required">Confirm Password</label>
                            <input type="password" id="confirmPassword" required class="form-control" name="password_confirmation"
                                placeholder="Enter Confirm Password" />
                        </div>
                    </div>
                    {{-- role --}}
                    <div class="row g-2">
                        <div class="col-12 col-md-6 mb-0">
                            <label for="role" class="form-label required">Role</label>
                            <select id="update_user_role" required class="form-select" name="role">
                                <option value="" disabled selected>
                                    Select a Role
                                </option>
                                <option value="super-admin">Super Admin</option>
                                <option value="admin">Admin</option>
                            </select>
                        </div>
                        <div class="col-12 col-md-6 mb-0">
                            <label for="update_user_status" class="form-label required">Status</label>
                            <select id="update_user_status" required class="form-select" name="status">
                                <option value="" disabled selected>
                                    Select a Status
                                </option>
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        Close
                    </button>
                    <button type="submit" class="btn btn-primary">Create</button>
                </div>
            </form>
        </div>
    </div>
</div>
