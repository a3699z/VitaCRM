@extends('admin.layouts.app')

@section('panel')
    <div class="row mb-none-30">
        <div class="col-xl-3 col-lg-5 col-md-5 mb-30">

            <div class="card b-radius--10 overflow-hidden box--shadow1">
                <div class="card-body p-0">
                    <div class="p-3 bg--white">
                        <div class="">
                            <img src="" alt="@lang('Profile Image')" class="b-radius--10 w-100">
                        </div>
                        <div class="mt-15">
                            <h4 class="">{{$user->name}}</h4>
                            <span class="text--small">@lang('Joined At') <strong></strong></span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card b-radius--10 overflow-hidden mt-30 box--shadow1">
                <div class="card-body">
                    <h5 class="mb-20 text-muted">@lang('User information')</h5>
                    <ul class="list-group">

                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            @lang('Username')
                            <span class="font-weight-bold">{{$user->username}}</span>
                        </li>



                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            @lang('User Type')
                            <span class="font-weight-bold">{{ $user->user_type== 'employee' ? 'Employee' : 'Patient' }}</span>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="card b-radius--10 overflow-hidden mt-30 box--shadow1">
                <div class="card-body">
                    <h5 class="mb-20 text-muted">@lang('User action')</h5>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <form action="{{route('admin.users.delete', $user->uid)}}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn--danger btn-block">@lang('Delete')</button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="col-xl-9 col-lg-7 col-md-7 mb-30">

            <div class="row mb-none-30">
                <div class="col-xl-3 col-lg-6 col-sm-6 mb-30">
                    <div class="dashboard-w1 bg--18 b-radius--10 box-shadow has--link">
                        <a href="{{route('admin.users.reservations', $user->uid)}}" class="item--link"></a>
                        <div class="icon">
                            <i class="las la-shopping-cart"></i>
                        </div>
                        <div class="details">
                            <div class="desciption">
                                <span>@lang('User Reservations')</span>
                            </div>
                        </div>
                    </div>
                </div><!-- dashboard-w1 end -->


            </div>


            <div class="card mt-50">
                <div class="card-body">
                    <h5 class="card-title border-bottom pb-2">@lang('Information of') {{$user->name}}</h5>

                    <form action="{{route('admin.users.update',[$user->uid])}}" method="POST"
                          enctype="multipart/form-data">
                        @csrf

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group ">
                                    <label class="form-control-label font-weight-bold">@lang('Name')<span class="text-danger">*</span></label>
                                    <input class="form-control" type="text" name="name" value="{{$user->name}}">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-control-label  font-weight-bold">@lang('User Name') <span class="text-danger">*</span></label>
                                    <input class="form-control" type="text" name="username" value="{{$user->username}}">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group ">
                                    <label class="form-control-label font-weight-bold">@lang('Email') <span class="text-danger">*</span></label>
                                    <input class="form-control" type="email" name="email" value="{{$user->email}}">
                                </div>
                            </div>

                        </div>

                        <!-- select from teams -->
                        @if ($user->user_type == 'employee')
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-control-label font-weight-bold">@lang('Team') <span class="text-danger">*</span></label>
                                        <select class="form-control" name="team_key">
                                            <option value="">@lang('Select Team')</option>
                                            @foreach($teams as $team)
                                                <option value="{{$team['key']}}" @if(isset($user->team_key) && $user->team_key == $team['key']) selected @endif>{{$team['name']}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        @endif

                        <div class="row">

                            <div class="form-group  col-xl-4 col-md-6  col-sm-3 col-12">
                                <label class="form-control-label font-weight-bold">@lang('Email Verification') </label>
                                <input type="checkbox" data-width="100%" data-onstyle="-success" data-offstyle="-danger"
                                       data-toggle="toggle" data-on="@lang('Verified')" data-off="@lang('Unverified')" name="email_verified"
                                       @if($user->emailVerified) checked @endif>

                            </div>
                        </div>


                        <div class="row mt-4">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <button type="submit" class="btn btn--primary btn-block btn-lg">@lang('Save Changes')
                                    </button>
                                </div>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>



@endsection
