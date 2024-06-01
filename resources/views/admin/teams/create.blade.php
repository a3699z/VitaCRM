@extends('admin.layouts.app')
@section('panel')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <form action="{{ route('admin.teams.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method("POST")
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label for="name" class="font-weight-bold">@lang('Team Name') <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="name" maxlength="40"  value="{{old('name')}}" name="name" placeholder="@lang('Enter Name')" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn--primary btn-block">@lang('Create Team')</button>
                    </div>
            </form>
        </div>
    </div>
</div>
@endsection
