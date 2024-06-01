@extends('admin.layouts.app')
@section('panel')
    <div class="row mb-none-30">
        <div class="col-xl-4 col-md-6 mb-30">
            <div class="card b-radius--10 overflow-hidden box--shadow1">
                <div class="card-body">
                    <h5 class="mb-10 text-muted">@lang('Job Details')</h5>
                    <h6 class="mb-20 text-muted"><a href="{{route('admin.job.details', $booking->biding->job_id)}}">{{__($booking->biding->job->title)}}</a></h6>
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
                            @lang('Employees')
                            <span class="font-weight-bold">
                                <a href="{{ route('admin.users.detail', $booking->biding->user_id) }}">{{ @$booking->biding->user->username }}</a>
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
                            <span class="font-weight-bold">{{diffforhumans($booking->created_at->addDays($booking->biding->job->delivery_time))}}</span>
                        </li>


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
                                <span class="badge badge--warning">@lang('Dispute')</span>
                                 <button class="btn-info btn-rounded text-white  badge disputeShow" data-dispute="{{$booking->dispute_report}}"><i class="fa fa-info"></i></button>
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
                            <div class="col-md-12 mt-2">
                                @foreach($booking->workFile as $value)
                                    <div class="card-title text-center font-weight-bold">
                                        <a href="{{route('admin.hire.work.file.download', $value->id)}}" class="icon-btn btn--primary"><i class="las la-download"></i>
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
                <h5 class="modal-title">@lang('Payment Confirmation')</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('admin.employ.payment')}}" method="POST">
                @csrf
                <input type="hidden" name="id">
                <input type="hidden" name="payment" value="seller">
                <div class="modal-body">
                    <p>@lang('Are you sure to pay these employees?')</p>
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
            <form action="{{route('admin.employ.payment')}}" method="POST">
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
            data-toggle="tooltip" data-id="{{$booking->id}}" data-original-title="@lang('Employees Payment')"><i class="fas fa-ban"></i>
        @lang('Employees Payment')
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
