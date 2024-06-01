@extends('admin.layouts.app')

@section('panel')

    <div class="row">

        <div class="col-lg-12">

            <div class="card b-radius--10 ">

                <div class="card-body p-0">

                    <div class="table-responsive--sm table-responsive">

                        <table class="table table--light style--two">

                            <thead>

                                <tr>

                                    <th>@lang('Name')</th>

                                    <th>@lang('Last Update')</th>

                                    <th>@lang('Action')</th>

                                </tr>

                            </thead>

                            <tbody>

                            @forelse($featuredCategorys as $featuredCategory)

                                <tr>

                                    <td data-label="@lang('Name')"><span class="font-weight-bold">{{__($featuredCategory->name)}}</span></td>

                                    
									
                                    <td data-label="@lang('Last Update')">
                                        {{ showDateTime($featuredCategory->updated_at) }} <br> {{ diffForHumans($featuredCategory->updated_at) }}
                                    </td>
									
                                    <td data-label="@lang('Action')">

                                        <!--a href="javascript:void(0)" class="icon-btn btn--danger ml-1 updateCategory"

                                            data-id="{{$featuredCategory->id}}" 

                                            data-name="{{$featuredCategory->name}}">

                                            <i class="las la-trash"></i>

                                        </a-->
										<button class="icon-btn btn--danger ml-1 closed" data-toggle="tooltip" title="" data-original-title="@lang('Delete')" data-id="{{$featuredCategory->id}}"><i class="las la-trash"></i></button>

                                    </td>
									
									

                                </tr>

                            @empty

                                <tr>

                                    <td class="text-muted text-center" colspan="100%">{{__($emptyMessage) }}</td>

                                </tr>

                            @endforelse



                            </tbody>

                        </table>

                    </div>

                </div>

                <div class="card-footer py-4">

                    {{ paginateLinks($categorys) }}

                </div>

            </div>

        </div>

    </div>





    <div id="addModal" class="modal fade" tabindex="-1" role="dialog">

        <div class="modal-dialog" role="document">

            <div class="modal-content">

                <div class="modal-header">

                    <h5 class="modal-title">@lang('Add Featured Category')</h5>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                        <span aria-hidden="true">&times;</span>

                    </button>

                </div>

                <form action="{{ route('admin.featured.category.store') }}" method="POST">

                    @csrf

                    <div class="modal-body">

                        <div class="form-group">

                            <label for="name" class="form-control-label font-weight-bold">@lang('Name')</label>

                           	<select class="form-control form-control-lg" name="name"   required="">
							<option value="">Select the category</option>
								@forelse($categorys as $category)
								<option value="{{$category->name}}-{{$category->id}}">{{$category->name}}</option>
								 @empty
								@endforelse
							</select>
                        </div>



                        <!--div class="form-group">

                            <label class="form-control-label font-weight-bold">@lang('Status') </label>

                            <input type="checkbox" data-width="100%" data-onstyle="-success" data-offstyle="-danger"

                                data-toggle="toggle" data-on="@lang('Enable')" data-off="@lang('Disabled')" name="status">

                        </div-->



                    </div>

                    <div class="modal-footer">

                        <button type="button" class="btn btn--dark" data-dismiss="modal">@lang('Close')</button>

                        <button type="submit" class="btn btn--primary"><i class="fa fa-fw fa-paper-plane"></i>@lang('Submit')</button>

                    </div>

                </form>

            </div>

        </div>

    </div>



<div class="modal fade" id="closedBy" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="" lass="modal-title" id="exampleModalLabel">@lang('Delete Confirmation')</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>
            
            <form action="{{ route('admin.featured.category.delete') }}" method="POST">
                @csrf
                @method('POST')
                <input type="hidden" name="id">
                <div class="modal-body">
                    <p>@lang('Are you sure to delete this featured category?')</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn--secondary" data-dismiss="modal">@lang('Close')</button>
                    <button type="submit" class="btn btn--success">@lang('Confirm')</button>
                </div>
            </form>
        </div>
    </div>
</div>


   

@endsection



@push('breadcrumb-plugins')

    <a href="javascript:void(0)" class="btn btn-sm btn--primary box--shadow1 text--small addCategory" ><i class="las la-plus"></i>@lang('Add Featured Category')</a>

@endpush



@push('script')

    <script>

        "use strict";

        $('.addCategory').on('click', function() {

            $('#addModal').modal('show');

        });



        $('.updateCategory').on('click', function () {

            var modal = $('#updateCategoryModal');

            modal.find('input[name=id]').val($(this).data('id'));

            modal.find('input[name=name]').val($(this).data('name'));

            var data = $(this).data('status');

            if(data == 1){

                modal.find('input[name=status]').bootstrapToggle('on');

            }else{

                modal.find('input[name=status]').bootstrapToggle('off');

            }

            modal.modal('show');

        });
		
			$('.closed').on('click', function () {
				var modal = $('#closedBy');
				modal.find('input[name=id]').val($(this).data('id'))
				modal.modal('show');
			});

    </script>

@endpush

