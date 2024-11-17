
@extends('layouts.recruiter')
  @section('content')

      <!-- Dashboard Content -->
      <div class="container-fluid p-0">
          <!-- Stats Row -->
          <div class="row g-4 mb-4">
              <div class="col-12 col-sm-6 col-xl-3">
                  <div class="card">
                      <div class="card-body">
                          <div class="d-flex align-items-center">
                              <div class="flex-shrink-0">
                                  <div class="rounded-circle p-3 bg-primary bg-opacity-10 text-primary">
                                      <i class="fas fa-briefcase fa-fw fa-lg"></i>
                                  </div>
                              </div>
                              <div class="flex-grow-1 ms-3">
                                  <h6 class="mb-1">Active Jobs</h6>
                                  <h3 class="mb-0"><a href=""></a></h3>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
              <div class="col-12 col-sm-6 col-xl-3">
                <div class="card">
                  <div class="card-body">
                      <div class="d-flex align-items-center">
                          <div class="flex-shrink-0">
                              <div class="rounded-circle p-3 bg-success bg-opacity-10 text-success">
                                  <i class="fas fa-users fa-fw fa-lg"></i>
                              </div>
                          </div>
                          <div class="flex-grow-1 ms-3">
                              <h6 class="mb-1">Applications</h6>
                              <h3 class="mb-0"><a href=""></a></h3>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
          <div class="col-12 col-sm-6 col-xl-3">
              <div class="card">
                  <div class="card-body">
                      <div class="d-flex align-items-center">
                          <div class="flex-shrink-0">
                              <div class="rounded-circle p-3 bg-warning bg-opacity-10 text-warning">
                                  <i class="fas fa-clock fa-fw fa-lg"></i>
                              </div>
                          </div>
                          <div class="flex-grow-1 ms-3">
                              <h6 class="mb-1">Pending Review</h6>
                              <h3 class="mb-0"><a href=""></a></h3>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
          <div class="col-12 col-sm-6 col-xl-3">
              <div class="card">
                  <div class="card-body">
                      <div class="d-flex align-items-center">
                          <div class="flex-shrink-0">
                              <div class="rounded-circle p-3 bg-info bg-opacity-10 text-info">
                                  <i class="fas fa-check-circle fa-fw fa-lg"></i>
                              </div>
                          </div>
                          <div class="flex-grow-1 ms-3">
                              <h6 class="mb-1">Approved</h6>
                              <h3 class="mb-0">{{ \App\Models\Job::where('status', 'approved')->count() }}</h3>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>

      <!-- Recent Applications -->
      <div class="row">
          <div class="col-12 col-xxl-8 mb-4">
              <div class="card">
                  <div class="card-header">
                      <div class="d-flex align-items-center justify-content-between">
                          <h5 class="card-title mb-0">Recent Applications</h5>
                          <button class="btn btn-primary btn-sm">View All</button>
                      </div>
                  </div>
                  <div class="card-body p-0">
                      <div class="table-responsive">
                          <table class="table">
                              <thead>
                                  <tr>
                                      <th>Candidate</th>
                                      <th>Position</th>
                                      <th>Applied Date</th>
                                      <th>Status</th>
                                      <th>Actions</th>
                                  </tr>
                              </thead>
                              <tbody>
                                  <tr>
                                      <td>
                                          <div class="d-flex align-items-center">
                                              <img src="/api/placeholder/40/40" class="rounded-circle me-2" alt="Avatar">
                                              <div>
                                                  <h6 class="mb-0">John Smith</h6>
                                                  <small class="text-muted">john.smith@email.com</small>
                                              </div>
                                          </div>
                                      </td>
                                      <td>Senior Developer</td>
                                      <td>Oct 24, 2023</td>
                                      <td><span class="status-badge status-pending">Pending</span></td>
                                      <td>
                                          <div class="btn-group">
                                              <button class="btn btn-light btn-sm" title="View"><i class="fas fa-eye"></i></button>
                                              <button class="btn btn-light btn-sm" title="Download CV"><i class="fas fa-download"></i></button>
                                              <button class="btn btn-light btn-sm" title="Delete"><i class="fas fa-trash"></i></button>
                                          </div>
                                      </td>
                                  </tr>
                                  <tr>
                                      <td>
                                          <div class="d-flex align-items-center">
                                              <img src="/api/placeholder/40/40" class="rounded-circle me-2" alt="Avatar">
                                              <div>
                                                  <h6 class="mb-0">Sarah Johnson</h6>
                                                  <small class="text-muted">sarah.j@email.com</small>
                                              </div>
                                          </div>
                                      </td>
                                      <td>UI/UX Designer</td>
                                      <td>Oct 23, 2023</td>
                                      <td><span class="status-badge status-approved">Approved</span></td>
                                      <td>
                                          <div class="btn-group">
                                              <button class="btn btn-light btn-sm" title="View"><i class="fas fa-eye"></i></button>
                                              <button class="btn btn-light btn-sm" title="Download CV"><i class="fas fa-download"></i></button>
                                              <button class="btn btn-light btn-sm" title="Delete"><i class="fas fa-trash"></i></button>
                                          </div>
                                      </td>
                                  </tr>
                                  <tr>
                                      <td>
                                          <div class="d-flex align-items-center">
                                              <img src="/api/placeholder/40/40" class="rounded-circle me-2" alt="Avatar">
                                              <div>
                                                  <h6 class="mb-0">Michael Brown</h6>
                                                  <small class="text-muted">m.brown@email.com</small>
                                              </div>
                                          </div>
                                      </td>
                                      <td>Product Manager</td>
                                      <td>Oct 22, 2023</td>
                                      <td><span class="status-badge status-rejected">Rejected</span></td>
                                      <td>
                                          <div class="btn-group">
                                              <button class="btn btn-light btn-sm" title="View"><i class="fas fa-eye"></i></button>
                                              <button class="btn btn-light btn-sm" title="Download CV"><i class="fas fa-download"></i></button>
                                              <button class="btn btn-light btn-sm" title="Delete"><i class="fas fa-trash"></i></button>
                                          </div>
                                      </td>
                                  </tr>
                              </tbody>
                          </table>
                      </div>
                  </div>
              </div>
          </div>

          <!-- Upcoming Interviews -->
          <div class="col-12 col-xxl-4 mb-4">
              <div class="card">
                  <div class="card-header">
                      <div class="d-flex align-items-center justify-content-between">
                          <h5 class="card-title mb-0">Upcoming Interviews</h5>
                          <button class="btn btn-primary btn-sm">View Calendar</button>
                      </div>
                  </div>
                  <div class="card-body">
                      <div class="interview-list">
                          <div class="interview-item p-3 mb-3 bg-light rounded-3">
                              <div class="d-flex align-items-center mb-2">
                                  <img src="/api/placeholder/32/32" class="rounded-circle me-2" alt="Avatar">
                                  <div>
                                      <h6 class="mb-0">David Wilson</h6>
                                      <small class="text-muted">Frontend Developer</small>
                                  </div>
                              </div>
                              <div class="d-flex align-items-center text-muted">
                                  <i class="fas fa-calendar-alt me-2"></i>
                                  <span>Today, 2:00 PM</span>
                              </div>
                          </div>

                          <div class="interview-item p-3 mb-3 bg-light rounded-3">
                              <div class="d-flex align-items-center mb-2">
                                  <img src="/api/placeholder/32/32" class="rounded-circle me-2" alt="Avatar">
                                  <div>
                                      <h6 class="mb-0">Emma Davis</h6>
                                      <small class="text-muted">Marketing Manager</small>
                                  </div>
                              </div>
                              <div class="d-flex align-items-center text-muted">
                                  <i class="fas fa-calendar-alt me-2"></i>
                                  <span>Tomorrow, 10:30 AM</span>
                              </div>
                          </div>

                          <div class="interview-item p-3 bg-light rounded-3">
                              <div class="d-flex align-items-center mb-2">
                                  <img src="/api/placeholder/32/32" class="rounded-circle me-2" alt="Avatar">
                                  <div>
                                      <h6 class="mb-0">Alex Thompson</h6>
                                      <small class="text-muted">DevOps Engineer</small>
                                  </div>
                              </div>
                              <div class="d-flex align-items-center text-muted">
                                  <i class="fas fa-calendar-alt me-2"></i>
                                  <span>Oct 25, 3:15 PM</span>
                              </div>

                            </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>
@endSection
