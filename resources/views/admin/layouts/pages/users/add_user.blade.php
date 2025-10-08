<!-- Add User Modal -->
<div class="modal fade" id="addUserModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title m-0">Add New User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>

            <form id="addUserForm" method="POST">
                @csrf

                <div class="modal-body">
                    {{-- Full Name --}}
                    <div class="row clearfix">
                        <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                            <label for="au_name">Full Name</label>
                        </div>
                        <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" id="au_name" name="name" class="form-control"
                                        placeholder="Enter full name" required>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Email --}}
                    <div class="row clearfix">
                        <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                            <label for="au_email">Email</label>
                        </div>
                        <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="email" id="au_email" name="email" class="form-control"
                                        placeholder="name@example.com" required>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Password --}}
                    <div class="row clearfix">
                        <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                            <label for="au_password">Password</label>
                        </div>
                        <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                            <div class="form-group">
                                <div class="form-line position-relative">
                                    <input type="password" id="au_password" name="password" class="form-control"
                                        placeholder="Min 8 characters" minlength="8" required>
                                </div>
                                <small class="text-muted">Use upper/lowercase, number & symbol for a strong
                                    password.</small>
                            </div>
                        </div>
                    </div>

                    {{-- Confirm Password --}}
                    <div class="row clearfix">
                        <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                            <label for="au_password_confirmation">Confirm Password</label>
                        </div>
                        <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="password" id="au_password_confirmation" name="password_confirmation"
                                        class="form-control" placeholder="Re-type password" required>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Role --}}
                    <div class="row clearfix">
                        <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                            <label for="au_role">Role</label>
                        </div>
                        <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                            <div class="form-group">
                                <div class="form-line">
                                    {{-- ব্যাকএন্ডে যেটা এক্সপেক্ট করছেন, সেই name ব্যবহার করুন: role / system_admin --}}
                                    <select id="au_role" name="role" class="form-control show-tick">
                                        <option value="user">User</option>
                                        <option value="admin">Admin</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Phone --}}
                    <div class="row clearfix">
                        <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                            <label for="au_phone">Phone (optional)</label>
                        </div>
                        <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" id="au_phone" name="phone" class="form-control"
                                        placeholder="017XXXXXXXX">
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- (উদাহরণ) YouTube URL / Social field — আপনার দেওয়া স্টাইলে --}}
                    <div class="row clearfix">
                        <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                            <label for="youtube_url">YouTube URL</label>
                        </div>
                        <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="url" id="youtube_url" name="youtube_url" class="form-control"
                                        placeholder="Enter YouTube URL" value="{{ old('youtube_url') }}">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Footer buttons --}}
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
                    <button id="auSubmitBtn" type="submit" class="btn btn-primary">
                        <span id="auBtnSpinner" class="d-none spinner-border spinner-border-sm" role="status"
                            aria-hidden="true"></span>
                        <span id="auBtnText">Create User</span>
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>
