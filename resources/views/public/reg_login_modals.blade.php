<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<!-- Optional: Bootstrap Icons -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
<div class="modal fade" id="insertUserModal" tabindex="-1" aria-labelledby="insertUserModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content tournament_rules">
            <div class="modal-header">
                <h5 class="modal-title" id="tournamentModalLabel">User Information</h5>
            </div>
            <div class="modal-body auth_continer">
                <div class="nav_container">
                    <div class="nav_item" id="login-tab">
                        <button class="active btn">Login</button>
                    </div>
                    <div class="nav_item reg-tab" id="reg-tab">
                        <button class="btn">Register</button>
                    </div>
                </div>
                <div class="d-none success_msg_container"
                    style="text-align: center;padding: 5px;background: #5d2e903b;margin: 5px 0;">
                    <span class="success_msg"></span>
                </div>
                <div class="login_container">
                    <label class="my-1">Phone Number</label>
                    <input type="number" class="form-control" id="login_user_msisdn" />
                    <label class="my-1">Password</label>

                    <span class="password_container">
                        <input type="password" id="login_user_password" class="password form-control">
                        <button class="icon togglePassword">
                            <i class="bi bi-eye-slash"></i>
                        </button>
                    </span>
                    <span class="login_error_msg error_msg"></span>

                    <div class="my-3 w-full" id="loginBtn">
                        <button class="btn btn-sm btn-reg w-full">Login</button>
                    </div>
                    <button class="btn forgot_passBtn">Forgot password?</button>
                </div>
                <div class="reg_container d-none">
                    <label class="my-1">Name</label>
                    <input type="text" class="form-control" id="reg_user_name" />
                    <label class="my-1">Phone Number</label>
                    <input type="number" class="form-control" id="reg_user_msisdn" />
                    <label class="my-1">Password</label>
                    <span class="password_container">
                        <input type="password" id="reg_user_password" class="password form-control">
                        <button class="icon togglePassword">
                            <i class="bi bi-eye-slash"></i>
                        </button>
                    </span>
                    <span class="reg_error_msg error_msg"></span>
                    <div class="my-3 w-full" id="registerBtn">
                        <button class="btn btn-sm btn-reg w-full">Register</button>
                    </div>
                </div>
            </div>
            <div class="modal-body forgot_pass_container d-none">
                <div class="nav_container">
                    <div class="nav_item" id="login-tab">
                        <button class="active btn">Forgot Password</button>
                    </div>
                </div>
                <span class="forgot_pass_error_msg"></span>
                <div>
                    <label class="my-1">Phone Number</label>
                    <input type="number" class="form-control" id="forgot_pass_user_msisdn" />
                    <label class="my-1">New Password</label>
                    <input type="password" class="form-control" id="forgot_pass_user_pass" />
                    <div class="my-3 w-full d-flex">
                        <button class="btn btn-sm btn_forgot_cancel w-full">Cancel</button>
                        <button class="btn btn-sm btn-reg w-full" id="forGot_pass_submitBtn">Submit</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<style>

    .password_container{
        position: relative;
    }
    .password_container button {
        position: absolute;
        bottom: 6px;
        border: none;
        padding: 0;
        margin: 0;
        background: transparent;
        right: 10px;
    }
    
</style>
