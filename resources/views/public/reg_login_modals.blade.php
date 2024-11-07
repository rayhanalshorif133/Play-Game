<div class="modal fade" id="insertUserModal" tabindex="-1" aria-labelledby="insertUserModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content tournament_rules">
            <div class="modal-header">
                <h5 class="modal-title" id="tournamentModalLabel">User Information</h5>
            </div>
            <div class="modal-body">
                <div class="nav_container">
                    <div class="nav_item" id="login-tab">
                        <button class="active btn">Login</button>
                    </div>
                    <div class="nav_item" id="reg-tab">
                        <button class="btn">Register</button>
                    </div>
                </div>
                <div style="text-align: center;padding: 5px;background: #5d2e903b;margin: 5px 0;">
                    <span class="success_msg"></span>
                </div>
                <div class="login_container">
                    <label class="my-1">Phone Number</label>
                    <input type="text" class="form-control" id="login_user_msisdn"/>
                    <label class="my-1">Password</label>
                    <input type="password" class="form-control" id="login_user_password"/>
                    <span class="login_error_msg error_msg"></span>
                    <div class="my-3 w-full" id="loginBtn">
                        <button class="btn btn-sm btn-reg w-full">Login</button>
                    </div>
                </div>
                <div class="reg_container d-none">
                    <label class="my-1">Name</label>
                    <input type="text" class="form-control" id="reg_user_name" />
                    <label class="my-1">Phone Number</label>
                    <input type="text" class="form-control" id="reg_user_msisdn"  />
                    <label class="my-1">Password</label>
                    <input type="password" class="form-control" id="reg_user_password" />
                    <span class="reg_error_msg error_msg"></span>
                    <div class="my-3 w-full" id="registerBtn">
                        <button class="btn btn-sm btn-reg w-full">Register</button>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
