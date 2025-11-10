<div class="row g-3 g-lg-4 mt-1" id="settings">
                    <div class="col-12">
                        <div class="card card-modern">
                            <div class="card-header bg-transparent border-0">
                                <h5 class="mb-0">Account Settings</h5>
                            </div>
                            <div class="card-body">

                                <div class="row g-4">
                                    <div class="col-12 col-lg-6">
                                        <h6 class="fw-semibold">Security</h6>
                                        <p class="text-secondary small mb-3">Manage password and 2‑factor
                                            authentication to keep your account secure.</p>
                                        <!-- Trigger Button -->
                                        <button class="btn btn-outline-primary w-100 mb-2" data-bs-toggle="modal"
                                            data-bs-target="#changePasswordModal">
                                            <i class="bi bi-key me-2"></i>Change Password
                                        </button>
                                    </div>

                                    <div class="col-12 col-lg-6">
                                        <h6 class="fw-semibold">Danger Zone</h6>
                                        <p class="text-secondary small mb-2">Delete your account and all associated
                                            data.</p>

                                        <form action="{{ route('customer.destroy', Auth::user()->id) }}"
                                            method="POST" style="display:inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn btn-outline-danger w-100 deleteBtn"
                                                data-id="{{ Auth::user()->id }}">
                                                <i class="bi bi-trash me-2"></i>Delete Account
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
