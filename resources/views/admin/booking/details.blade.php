@extends('admin.layouts.app')
@section('panel')
    <div class="row mb-none-30">
        <div class="col-xl-4 col-md-6 mb-30">
            <div class="card b-radius--10 overflow-hidden box--shadow1">
                <div class="card-body">
                    <h5 class="mb-10 text-muted">@lang('Service Details')</h5>
                    <h6 class="mb-20 text-muted"><a href="{{route('admin.service.details', $booking->service_id)}}">{{__($booking->service->title)}}</a></h6>
                    <ul class="list-group">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            @lang('Date')
                            <span class="font-weight-bold">{{ showDateTime($booking->created_at) }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            @lang('Order Number')
                            <span class="font-weight-bold">{{ $booking->order_number }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            @lang('Seller')
                            <span class="font-weight-bold">
                                <a href="{{ route('admin.users.detail', $booking->service->user_id) }}">{{ @$booking->service->user->username }}</a>
                            </span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            @lang('Buyer')
                            <span class="font-weight-bold">
                                <a href="{{ route('admin.users.detail', $booking->user_id) }}">{{ @$booking->user->username }}</a>
                            </span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            @lang('Delivery Data')
                            <span class="font-weight-bold">{{showDateTime($booking->created_at->addDays($booking->service->delivery_time), 'd M Y')}}</span>
                        </li>

                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            @lang('Service Price')
                            <span class="font-weight-bold">{{getAmount($booking->service->price)}} {{$general->cur_text}}</span>
                          </li>

                         <li class="list-group-item d-flex justify-content-between align-items-center">
                            @lang('Quantity')
                            <span class="font-weight-bold">{{__($booking->qty)}}</span>
                          </li>

                        @if($booking->extra_service != null)
                          <li class="list-group-item d-flex justify-content-between align-items-center">
                            @lang('Extra Price')
                            <span class="font-weight-bold">{{__($general->cur_sym)}}{{$extraPrice}}</span>
                          </li>
                        @endif

                        @if($booking->discount != 0)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                @lang('Discount')
                                <span class="font-weight-bold">{{__($general->cur_sym)}}{{showAmount($booking->discount)}}</span>
                            </li>
                        @endif

                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            @lang('Amount')
                            <span class="font-weight-bold">{{ getAmount($booking->amount ) }} {{ __($general->cur_text) }}</span>
                        </li>

                         <li class="list-group-item d-flex justify-content-between align-items-center">
                            @lang('Working Status')
                            @if($booking->working_status == 0)
                                <span class="badge badge--primary">@lang('Pending')</span>
                            @elseif($booking->working_status == 1)
                                <span class="badge badge--success">@lang('Completed')</span>
                            @elseif($booking->working_status == 2)
                                <span class="badge badge--secondary">@lang('Delivered')</span>
                            @elseif($booking->working_status == 3)
                                <span class="badge badge--danger">@lang('Cancel')</span>
                            @elseif($booking->working_status == 4)
                                <span class="badge badge--dark">@lang('In Progress')</span>
                            @elseif($booking->working_status == 5)
                                <span class="badge badge--danger">@lang('Expired')</span>
                            @elseif($booking->working_status == 6)
                                <div>
                                    <span class="badge badge--warning">@lang('Dispute')</span>
                                     <button class="btn-info btn-rounded text-white  badge disputeShow" data-dispute="{{$booking->dispute_report}}"><i class="fa fa-info"></i></button>
                                </div>
                            @endif
                        </li>

                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            @lang('Status')
                           @if($booking->status == 1)
                                <span class="badge badge--primary">@lang('Running')</span>
                            @elseif($booking->status == 2)
                                <span class="badge badge--warning">@lang('Payable Both')</span>
                            @elseif($booking->status == 3)
                                <span class="badge badge--success">@lang('Paid')</span>
                            @elseif($booking->status == 4)
                                <span class="badge badge--success">@lang('Refund')</span>
                            @endif
                        </li>
                    </ul>
                </div>
            </div>
        </div>


        <div class="col-xl-8 col-md-6 mb-30">
            <div class="card b-radius--10 overflow-hidden box--shadow1">
                <div class="card-body">
                    <h5 class="card-title border-bottom pb-2 text-right">@lang('Other Information')</h5>
                        <div class="row mt-2 text-center">

                            @if($booking->extra_service)
                                <div class="col-md-12">
                                    <h5 class="card-title">@lang('Extra Service')</h5>
                                   <div class="table-responsive--md  table-responsive">
                                        <table class="table table--light style--two">
                                            <thead>
                                                <tr>
                                                    <th scope="col">@lang('Title')</th>
                                                    <th scope="col">@lang('Price')</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach(explode(",",$booking->extra_service) as $value)
                                                    @php $extraService = App\Models\ExtraService::find($value) @endphp    
                                                    <tr>
                                                        <td data-label="@lang('Title')">{{__($extraService->title)}}</td>
                                                        <td data-label="@lang('Price')"><span class="font-weight-bold">{{$general->cur_sym}}{{showAmount($extraService->price)}}</span></td>
                                                    </tr>
                                                @endforeach 
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            @endif


                            <div class="col-md-12 mt-2">
                                @foreach($booking->workFile as $value)
                                    <div class="card-title text-center font-weight-bold">
                                        <a href="{{route('admin.work.delivery.download', encrypt($value->id))}}" class="icon-btn btn--primary"><i class="las la-download"></i>
                                        </a>
                                    </div>
                                    <div class="card-title text-center">@lang('Delivery Details')</div>
                                    <p class="card-text">{{__($value->details)}}</p>
                                @endforeach
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    
<div id="approveModal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">@lang('Seller Payment')</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('admin.booking.service.payment')}}" method="POST">
                @csrf
                <input type="hidden" name="id">
                <input type="hidden" name="payment" value="seller">
                <div class="modal-body">
                    <p>@lang('Are you sure to pay this service seller?')</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn--dark" data-dismiss="modal">@lang('Close')</button>
                    <button type="submit" class="btn btn--success">@lang('Confirm')</button>
                </div>
            </form>
        </div>
    </div>
</div>


<div id="refundModel" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">@lang('Refund Money')</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('admin.booking.service.payment')}}" method="POST">
                @csrf
                <input type="hidden" name="id">
                <input type="hidden" name="payment" value="buyer">
                <div class="modal-body">
                     <p>@lang('Are you sure to refund money to this buyer?')</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn--dark" data-dismiss="modal">@lang('Close')</button>
                    <button type="submit" class="btn btn--success">@lang('Confirm')</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="disputeModalShow" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="" lass="modal-title" id="exampleModalLabel">@lang('Dispute Report')</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>
            <div class="modal-body">
                <div class="dispute-detail">

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn--secondary" data-dismiss="modal">@lang('Close')</button>
            </div>
        </div>
    </div>
</div>

@endsection


@push('breadcrumb-plugins')
 @if($booking->status == 2)
    <button class="btn btn--success ml-1 approveBtn"
            data-toggle="tooltip" data-id="{{$booking->id}}" data-original-title="@lang('Seller Payment')"><i class="fas fa-ban"></i>
        @lang('Seller Payment')
    </button>

    <button class="btn btn--info ml-1 refundBtn"
            data-toggle="tooltip" data-id="{{$booking->id}}" data-original-title="@lang('Buyer Payment')"><i class="fas fa-ban"></i>
        @lang('Buyer Payment')
    </button>
@endif
@endpush

@push('script')
    <script>
        "use strict";
        $('.approveBtn').on('click', function () {
            var modal = $('#approveModal');
            modal.find('input[name=id]').val($(this).data('id'));
            modal.modal('show');
        });

        $('.refundBtn').on('click', function () {
            var modal = $('#refundModel');
            modal.find('input[name=id]').val($(this).data('id'));
            modal.modal('show');
        });

        $('.disputeShow').on('click', function () {
            var modal = $('#disputeModalShow');
            var feedback = $(this).data('dispute');
            modal.find('.dispute-detail').html(`<p> ${feedback} </p>`);
            modal.modal('show');
        });
    </script>
@endpush
