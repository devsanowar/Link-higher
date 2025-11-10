<div class="col-12 col-xxl-5" id="profile">
                        <div class="card card-modern h-100">
                            <div class="card-header bg-transparent border-0">
                                <h5 class="mb-0">Profile</h5>
                            </div>
                            <div class="card-body">
                                <div class="d-flex align-items-center gap-3 mb-3">
                                    <div class="profile-image-wrapper">
                                        @if (empty(Auth::user()->image))
                                            <img class="rounded-4" id="profileImage"
                                                src="https://i.pravatar.cc/72?img=12" alt="Profile"
                                                class="profile-image" width="72" height="72">
                                        @else
                                            <img class="rounded-4" id="profileImage"
                                                src="{{ asset(Auth::user()->image) }}" alt="Profile"
                                                class="profile-image" width="72" height="72">
                                        @endif

                                        <button type="button" id="cameraBtn" class="camera-btn"
                                            title="Change photo">
                                            <i class="material-icons">photo_camera</i>
                                        </button>

                                        <!-- id now matches JS -->
                                        <input type="file" id="profileFile" class="d-none"
                                            accept="image/png,image/jpeg,image/jpg,image/webp">
                                    </div>

                                    <div>
                                        <div class="fw-bold fs-5">{{ Auth::user()->name ?? 'Customer' }}</div>
                                        <div class="text-secondary small">
                                            {{ Auth::user()->email ?? 'customer@gmail.com' }}</div>
                                    </div>
                                </div>
                                <form id="customerProfileUpdate" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="row g-3">
                                        <div class="col-12 col-md-6">
                                            <label class="form-label">Full Name</label>
                                            <input type="name" class="form-control" name="name"
                                                placeholder="Your name" value="{{ Auth::user()->name ?? '' }}" />
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <label class="form-label">Phone</label>
                                            <input type="text" class="form-control" placeholder="01XXXXXXXXX"
                                                name="phone" value="{{ Auth::user()->phone ?? '' }}" />
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <label class="form-label">Email</label>
                                            <input type="email" class="form-control"
                                                placeholder="example@gmail.com" name="email"
                                                value="{{ Auth::user()->email ?? '' }}" />
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <label class="form-label">Address</label>
                                            <input type="address" class="form-control" name="address"
                                                placeholder="House, Road, City"
                                                value="{{ Auth::user()->address ?? '' }}" />
                                        </div>
                                        <div class="col-12">
                                            <label class="form-label">About Customer</label>
                                            <textarea name="about" id="about" class="form-control" rows="4">{!! Auth::user()->about ?? '' !!}</textarea>
                                        </div>
                                        <div class="col-12 d-grid d-sm-flex gap-2">
                                            <button type="submit" class="btn btn-primary px-3 rounded-0"
                                                id="submitBtn">
                                                <span id="btnText">UPDATE PROFILE</span>
                                                <span id="btnSpinner"
                                                    class="spinner-border spinner-border-sm d-none ms-2"></span>
                                            </button>
                                            <a href="#settings" class="btn btn-outline-secondary">Account Settings</a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
