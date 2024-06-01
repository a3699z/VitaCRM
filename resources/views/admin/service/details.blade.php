@extends('admin.layouts.app')
@section('panel')
    <div class="row mb-none-30">
        <div class="col-xl-3 col-lg-5 col-md-5 col-sm-12">
            <div class="card b-radius--10 overflow-hidden box--shadow1">
                <div class="card-body p-0">
                    <div class="p-3 bg--white">
                        <div>
                            <img src="{{ getImage('assets/images/service/'. $service->image)}}" alt="@lang('Service image')"
                                 class="b-radius--10 w-100">
                        </div>
                        <div class="mt-10">
                            <h4 class="">{{__($service->title)}}</h4>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card b-radius--10 overflow-hidden mt-30 box--shadow1">
                <div class="card-body">
                    <h5 class="mb-20 text-muted">@lang('Seller Information')</h5>
                    <ul class="list-group">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            @lang('Username')
                            <span class="font-weight-bold">{{__($service->user->username)}}</span>
                        </li>

                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            @lang('Status')
                            @if($service->user->status == 1)
                                <span class="badge badge-pill bg--success">@lang('Active')</span>
                            @elseif($service->user->status == 0)
                                <span class="badge badge-pill bg--danger">@lang('Banned')</span>
                            @endif
                        </li>

                         <li class="list-group-item d-flex justify-content-between align-items-center">
                            @lang('Balance')
                            <span class="font-weight-bold">{{getAmount($service->user->balance)}}  {{__($general->cur_text)}}</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="col-xl-9 col-lg-7 col-md-7 col-sm-12 mt-10">
            @if($service->optionalImage->count() != 0)
                <div class="row mb-30">
                    <div class="col-lg-12">
                        <div class="card border--dark">
                            <h5 class="card-header bg--dark">@lang('Optional Image')</h5>
                            <div class="card-body">
                                 <div class="row my-2">
                                    @foreach($service->optionalImage as $optional)
                                        <div class="col-lg-3 col-md-3 col-sm-6">
                                            <a href="{{ getImage('assets/images/optionalService/'. $optional->image)}}" target="_blank">
                                                <img src="{{ getImage('assets/images/optionalService/'. $optional->image)}}" class="b-radius--10 w-80 ml-2 my-3" alt="@lang('Optional Image')">
                                            </a>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            <div class="row mb-30">
                <div class="col-lg-6 mt-2">
                    <div class="card border--dark">
                        <h5 class="card-header bg--dark">@lang('Service Main Information')</h5>
                        <div class="card-body">
                            <ul class="list-group">
                                <li class="list-group-item d-flex justify-content-between align-items-center font-weight-bold">
                                  @lang('Category')
                                  <span>{{__($service->category->name)}}</span>
                                </li>
                                @if(!empty($service->sub_category_id))
                                    <li class="list-group-item d-flex justify-content-between align-items-center font-weight-bold">
                                      @lang('Sub Category')
                                      <span>{{__($service->subCategory->name)}}</span>
                                    </li>
                                @endif
                              
                                <li class="list-group-item d-flex justify-content-between align-items-center font-weight-bold">
                                  @lang('Service Price')
                                  <span>{{getAmount($service->price)}} {{$general->cur_text}}</span>
                                </li>

                                <li class="list-group-item d-flex justify-content-between align-items-center font-weight-bold">
                                  @lang('Delivery Time')
                                    <span>{{$service->delivery_time}} @lang('Days')</span>
                                </li>

                                <li class="list-group-item d-flex justify-content-between align-items-center font-weight-bold">
                                  @lang('Last Update')
                                  <span>{{diffforhumans($service->updated_at)}}</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 mt-2">
                    <div class="card border--dark">
                        <h5 class="card-header bg--dark">@lang('Service Other Information')</h5>
                        <div class="card-body">
                            <ul class="list-group">
                                <li class="list-group-item d-flex justify-content-between align-items-center font-weight-bold">
                                  @lang('Status')
                                    @if($service->status == 1)
                                        <span class="font-weight-normal badge--success badge--sm">@lang('Approved')</span>
                                    @elseif($service->status == 2)
                                        <span class="font-weight-normal badge--danger badge--sm">@lang('Cancel')</span>
                                    @else
                                        <span class="font-weight-normal badge--primary badge--sm">@lang('Pending')</span>
                                    @endif
                                </li>
                              
                                <li class="list-group-item d-flex justify-content-between align-items-center font-weight-bold">
                                  @lang('Featured Item')
                                    @if($service->featured == 0)
                                        <span class="font-weight-normal badge--warning badge--sm">@lang('Not Include')</span>
                                    @else
                                        <span class="font-weight-normal badge--primary badge--sm">@lang('Include')</span>
                                    @endif
                                </li>

                                 <li class="list-group-item d-flex justify-content-between align-items-center font-weight-bold">
                                  @lang('Rating')
                                  <span>{{getAmount($service->rating)}}</span>
                                </li>

                                <li class="list-group-item d-flex justify-content-between align-items-center font-weight-bold">
                                  @lang('Like')
                                  <span>{{$service->likes}}</span>
                                </li>

                                <li class="list-group-item d-flex justify-content-between align-items-center font-weight-bold">
                                  @lang('Dislike')
                                    <span>{{$service->dislike}}</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>


            <div class="row mb-30">
                <div class="col-lg-6 mt-2">
                    <div class="card border--dark">
                        <h5 class="card-header bg--dark">@lang('Features')</h5>
                        <div class="card-body">
                            <ul>
                                @foreach($service->featuresService as $features)
                                    <li class="font-weight-bold">{{$loop->iteration}}. {{__($features->name)}}</li>
                                @endforeach 
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 mt-2">
                    <div class="card border--dark">
                        <h5 class="card-header bg--dark">@lang('Tag')</h5>
                        <div class="card-body">
                            <ul>
                                @foreach($service->tag as $value)
                                    <li class="font-weight-bold">{{$loop->iteration}}. {{__($value)}}</li>
                                @endforeach 
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            @if($service->extraService->count() != 0)
                <div class="row mb-30">
                    <div class="col-lg-12">
                        <div class="card border--dark">
                            <h5 class="card-header bg--dark">@lang('Extra Service')</h5>
                            <div class="card-body">
                                <div class="table-responsive--md  table-responsive">
                                    <table class="table table--light style--two">
                                        <thead>
                                            <tr>
                                                <th scope="col">@lang('Title')</th>
                                                <th scope="col">@lang('Price')</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($service->extraService  as $extra_service)
                                                <tr>
                                                    <td data-label="@lang('Title')">
                                                        {{$extra_service->title}}
                                                    </td>
                                                    <td data-label="@lang('Price')">{{getAmount($extra_service->price)}} {{$general->cur_text}}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            <div class="row mb-30">
                <div class="col-lg-12">
                    <div class="card border--dark">
                        <h5 class="card-header bg--dark">@lang('Description')</h5>
                        <div class="card-body">
                            @php echo $service->description @endphp
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('breadcrumb-plugins')
    <a href="{{ route('admin.service.index') }}" class="btn btn-sm btn--primary box--shadow1 text--small"><i class="la la-fw la-backward"></i>@lang('Go Back')</a>
@endpush