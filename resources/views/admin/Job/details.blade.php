@extends('admin.layouts.app')
@section('panel')
<div class="row mb-none-30">
    <div class="col-xl-3 col-lg-5 col-md-5 col-sm-12">
        <div class="card b-radius--10 overflow-hidden box--shadow1">
            <div class="card-body p-0">
                <div class="p-3 bg--white">
                    <div>
                        <img src="{{ getImage('assets/images/job/'. $job->image, '590x300')}}" alt="@lang('Job image')"
                             class="b-radius--10 w-100">
                    </div>
                    <div class="mt-10">
                        <h4 class="">{{__($job->title)}}</h4>
                    </div>
                </div>
            </div>
        </div>

        <div class="card b-radius--10 overflow-hidden mt-30 box--shadow1">
            <div class="card-body">
                <h5 class="mb-20 text-muted">@lang('Buyer Information')</h5>
                <ul class="list-group">
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        @lang('Username')
                        <span class="font-weight-bold">{{__($job->user->username)}}</span>
                    </li>

                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        @lang('Status')
                        @if($job->user->status == 1)
                            <span class="badge badge-pill bg--success">@lang('Active')</span>
                        @elseif($job->user->status == 0)
                            <span class="badge badge-pill bg--danger">@lang('Banned')</span>
                        @endif
                    </li>

                     <li class="list-group-item d-flex justify-content-between align-items-center">
                        @lang('Balance')
                        <span class="font-weight-bold">{{getAmount($job->user->balance)}}  {{__($general->cur_text)}}</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <div class="col-xl-9 col-lg-7 col-md-7 col-sm-12">

        <div class="row mb-30">
            <div class="col-lg-6 mt-2">
                <div class="card border--dark">
                    <h5 class="card-header bg--dark">@lang('Job Information')</h5>
                    <div class="card-body">
                        <ul class="list-group">
                            <li class="list-group-item d-flex justify-content-between align-items-center font-weight-bold">
                              @lang('Category')
                              <span>{{__($job->category->name)}}</span>
                            </li>
                            @if(!empty($job->sub_category_id))
                                <li class="list-group-item d-flex justify-content-between align-items-center font-weight-bold">
                                  @lang('Sub Category')
                                  <span>{{__($job->subCategory->name)}}</span>
                                </li>
                            @endif
                          
                            <li class="list-group-item d-flex justify-content-between align-items-center font-weight-bold">
                              @lang('Budget')
                              <span>{{getAmount($job->amount)}} {{$general->cur_text}}</span>
                            </li>

                            <li class="list-group-item d-flex justify-content-between align-items-center font-weight-bold">
                              @lang('Delivery Time')
                                <span>{{$job->delivery_time}} @lang('Days')</span>
                            </li>

                            <li class="list-group-item d-flex justify-content-between align-items-center font-weight-bold">
                              @lang('Last Update')
                              <span>{{diffforhumans($job->updated_at)}}</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

             <div class="col-lg-6 mt-2">
                <div class="card border--dark">
                    <h5 class="card-header bg--dark">@lang('Skill')</h5>
                    <div class="card-body">
                        <ul>
                            @foreach($job->skill as $value)
                                <li class="font-weight-bold">{{$loop->iteration}}. {{__($value)}}</li>
                            @endforeach 
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mb-30">
            <div class="col-lg-12">
                <div class="card border--dark">
                    <h5 class="card-header bg--dark">@lang('Description')</h5>
                    <div class="card-body">
                        @php echo $job->description @endphp
                    </div>
                </div>
            </div>
        </div>

        <div class="row mb-30">
            <div class="col-lg-12">
                <div class="card border--dark">
                    <h5 class="card-header bg--dark">@lang('Requirements')</h5>
                    <div class="card-body">
                        @php echo $job->requirements @endphp
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('breadcrumb-plugins')
    <a href="{{ route('admin.job.index') }}" class="btn btn-sm btn--primary box--shadow1 text--small"><i class="la la-fw la-backward"></i>@lang('Go Back')</a>
@endpush