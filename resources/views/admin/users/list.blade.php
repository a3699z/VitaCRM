@extends('admin.layouts.app')
@section('panel')
    <div class="row">
        <div class="col-lg-12">
            <div class="card b-radius--10 ">
                <div class="card-body p-0">
                    <div class="table-responsive--md  table-responsive">
                        <table class="table table--light style--two">
                            <thead>
                            <tr>
                                <th>@lang('User')</th>
                                <th>@lang('Email')</th>
                                <th>@lang('Action')</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($users as $user)
                            <tr>
                                <td data-label="@lang('User')">
                                    <span class="font-weight-bold">{{$user['name']}}</span>
                                    <br>
                                    <span class="small">
                                    <a href="{{ route('admin.users.show', $user['uid']) }}"><span>@</span>{{ $user['username'] }}</a>
                                    </span>
                                </td>


                                <td data-label="@lang('Email')">
                                    {{ $user['email'] }}
                                </td>





                                <td data-label="@lang('Action')">
                                    <a href="{{ route('admin.users.show', $user['uid']) }}" class="icon-btn" data-toggle="tooltip" title="" data-original-title="@lang('Details')">
                                        <i class="las la-desktop text--shadow"></i>
                                    </a>
                                </td>
                            </tr>
                            @empty
                                <tr>
                                    <td class="text-muted text-center" colspan="100%">{{ __($emptyMessage) }}</td>
                                </tr>
                            @endforelse

                            </tbody>
                        </table><!-- table end -->
                    </div>
                </div>
                <div class="card-footer py-4">
                </div>
            </div>
        </div>


    </div>
@endsection
