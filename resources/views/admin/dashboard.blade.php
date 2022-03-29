@extends('admin.master')

@section('content')
<div class="row">
  <div class="col-lg-3 col-md-6 col-sm-6">
  <a href="{{ route('admin-users') }}">
    <div class="card card-stats">
      <div class="card-header card-header-warning card-header-icon">
        <div class="card-icon">
          <i class="material-icons">supervisor_account</i>
        </div>
        <p class="card-category">Users</p>
        <h3 class="card-title">{{ $userCount }}
          <small></small>
        </h3>
      </div>
      <div class="card-footer">
        <div class="stats">
          <i class="material-icons text-success">star_rate</i>
          In Total
        </div>
      </div>
    </div>
	</a>
  </div>
  <div class="col-lg-3 col-md-6 col-sm-6">
  <a href="{{route('admin-main-services')}}">
    <div class="card card-stats">
      <div class="card-header card-header-success card-header-icon">
        <div class="card-icon">
            <i class="material-icons">home_repair_service</i>
        </div>
        <p class="card-category">Services</p>
        <h3 class="card-title">{{ $mCatCount }}</h3>
      </div>
      <div class="card-footer">
        <div class="stats">
          <i class="material-icons">date_range</i>In Total
        </div>
      </div>
    </div>
	</a>
  </div>
  <!--<div class="col-lg-3 col-md-6 col-sm-6">
    <div class="card card-stats">
      <div class="card-header card-header-danger card-header-icon">
        <div class="card-icon">
          <i class="material-icons">info_outline</i>
        </div>
        <p class="card-category">Fixed Issues</p>
        <h3 class="card-title">75</h3>
      </div>
      <div class="card-footer">
        <div class="stats">
          <i class="material-icons">local_offer</i> Tracked from Github
        </div>
      </div>
    </div>
  </div>
  <div class="col-lg-3 col-md-6 col-sm-6">
    <div class="card card-stats">
      <div class="card-header card-header-info card-header-icon">
        <div class="card-icon">
          <i class="fa fa-twitter"></i>
        </div>
        <p class="card-category">Followers</p>
        <h3 class="card-title">+245</h3>
      </div>
      <div class="card-footer">
        <div class="stats">
          <i class="material-icons">update</i> Just Updated
        </div>
      </div>
    </div>
  </div>----->
</div>

@endsection
