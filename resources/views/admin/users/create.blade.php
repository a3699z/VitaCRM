@extends('admin.layouts.app')
@section('panel')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <form action="{{ route('admin.employees.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method("POST")
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label for="name" class="font-weight-bold">@lang('Name') <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="name" maxlength="40"  value="{{old('name')}}" name="name" placeholder="@lang('Enter Name')" required>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label for="name" class="font-weight-bold">@lang('User Name') <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="username" maxlength="40"  value="{{old('name')}}" name="username" placeholder="@lang('Enter Name')" required>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label for="email" class="font-weight-bold">@lang('Email') <span class="text-danger">*</span></label>
                                        <input type="email" class="form-control" id="email" name="email" value="{{old('email')}}" placeholder="@lang('Enter Email')" required>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label for="password" class="font-weight-bold">@lang('Password') <span class="text-danger">*</span></label>
                                        <input type="password" class="form-control" id="password" name="password" placeholder="@lang('Enter Password')" required>
                                    </div>
                                </div>
                            </div>

                            <!-- select team -->
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group" >
                                        <label for="team_key" class="font-weight-bold">@lang('Team') <span class="text-danger">*</span></label>
                                        <select class="form-control select2-basic" name="team_key" id="team_key" required>
                                            <option value="">@lang('Select Team')</option>
                                            @foreach($teams as $team)
                                                <option value="{{$team['key']}}">{{$team['name']}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                        </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn--primary btn-block">@lang('Create Employee')</button>
                    </div>
            </form>
        </div>
    </div>
</div>
@endsection
