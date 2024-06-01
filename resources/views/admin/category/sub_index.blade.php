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

                                    <th>@lang('Category')</th>

                                    <th>@lang('Last Update')</th>

                                    <th>@lang('Action')</th>

                                </tr>

                            </thead>

                            <tbody>

                            @forelse($subCategorys as $subCategory)

                                <tr>

                                     <td data-label="@lang('Gateway')">

                                        <div class="user">



                                            <div class="thumb"><img src="{{getImage(imagePath()['subcategory']['path'].'/'. $subCategory->image,imagePath()['subcategory']['size'])}}" alt="@lang('image')"></div>

                                            <span class="name">{{__($subCategory->name)}}</span>

                                        </div>

                                    </td>

                                    <td data-label="@lang('Category')">

                                        <span class="font-weight-bold">{{$subCategory->category->name}}</span>

                                    </td>

                                 

                                    <td data-label="@lang('Last Update')">

                                        {{ showDateTime($subCategory->updated_at) }} <br> {{ diffForHumans($subCategory->updated_at) }}

                                    </td>



                                    <td data-label="@lang('Action')">

                                        <a href="javascript:void(0)" class="icon-btn btn--primary ml-1 updateCategory"

                                            data-id="{{$subCategory->id}}" 

                                            data-name="{{$subCategory->name}}" 

                                            data-category_id="{{$subCategory->category_id}}" >

                                            <i class="las la-edit"></i>

                                        </a>

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

                    {{ paginateLinks($subCategorys) }}

                </div>

            </div>

        </div>

    </div>





    <div id="addModal" class="modal fade" tabindex="-1" role="dialog">

        <div class="modal-dialog" role="document">

            <div class="modal-content">

                <div class="modal-header">

                    <h5 class="modal-title">@lang('Add Sub Category')</h5>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                        <span aria-hidden="true">&times;</span>

                    </button>

                </div>

                <form action="{{ route('admin.category.subcategory.store') }}" method="POST" enctype="multipart/form-data">

                    @csrf

                    <div class="modal-body">
                        
                        <input type="hidden" name="type" value="{{$type}}">

                        <div class="form-group">

                            <label for="name" class="form-control-label font-weight-bold">@lang('Name')</label>

                            <input type="text" class="form-control form-control-lg" name="name" placeholder="@lang("Enter Name")"  maxlength="100" required="">

                        </div>



                        <div class="form-group">

                            <label for="category_id" class="form-control-label font-weight-bold">@lang('Select Category')</label>

                            <select name="category_id" id="category_id" class="form-control">

                                <option>@lang('Select Category')</option>

                                @foreach($categorys as $category)

                                    <option value="{{$category->id}}">{{__($category->name)}}</option>

                                @endforeach

                            </select>

                        </div>



                        <div class="form-group">

                            <label for="symbol" class="form-control-label font-weight-bold">@lang('Image')</label>

                            <div class="custom-file">

                              <input type="file" name="image" class="custom-file-input" id="customFileLangHTML">

                              <label class="custom-file-label" for="customFileLangHTML" data-browse="@lang('Choose Image')">@lang('Image')</label>

                            </div>

                        </div>



                    </div>

                    <div class="modal-footer">

                        <button type="button" class="btn btn--dark" data-dismiss="modal">@lang('Close')</button>

                        <button type="submit" class="btn btn--primary"><i class="fa fa-fw fa-paper-plane"></i>@lang('Submit')</button>

                    </div>

                </form>

            </div>

        </div>

    </div>





    <div id="updateCategoryModal" class="modal fade" tabindex="-1" role="dialog">

        <div class="modal-dialog" role="document">

            <div class="modal-content">

                <div class="modal-header">

                    <h5 class="modal-title">@lang('Update Category')</h5>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                        <span aria-hidden="true">&times;</span>

                    </button>

                </div>

                <form action="{{ route('admin.category.subcategory.update') }}" method="POST" enctype="multipart/form-data">

                    @csrf

                    <input type="hidden" name="id">
                    

                    <input type="hidden" name="type" value="{{$type}}">

                    <div class="modal-body">

                        <div class="form-group">

                            <label for="name" class="form-control-label font-weight-bold">@lang('Name')</label>

                            <input type="text" class="form-control form-control-lg" name="name" placeholder="@lang("Enter Name")"  maxlength="100" required="">

                        </div>



                        <div class="form-group">

                            <label for="category_id" class="form-control-label font-weight-bold">@lang('Select Category')</label>

                            <select name="category_id" id="category_id" class="form-control">

                                <option>@lang('Select Category')</option>

                                @foreach($categorys as $category)

                                    <option value="{{$category->id}}">{{__($category->name)}}</option>

                                @endforeach

                            </select>

                        </div>



                        <div class="form-group">

                            <label for="symbol" class="form-control-label font-weight-bold">@lang('Image')</label>

                            <div class="custom-file">

                              <input type="file" name="image" class="custom-file-input" id="customFileLangHTML">

                              <label class="custom-file-label" for="customFileLangHTML" data-browse="@lang('Choose Image')">@lang('Image')</label>

                            </div>

                        </div>



                    </div>

                    <div class="modal-footer">

                        <button type="button" class="btn btn--dark" data-dismiss="modal">@lang('Close')</button>

                        <button type="submit" class="btn btn--primary"><i class="fa fa-fw fa-paper-plane"></i>@lang('Update')</button>

                    </div>

                </form>

            </div>

        </div>

    </div>

@endsection



@push('breadcrumb-plugins')

    <a href="javascript:void(0)" class="btn btn-sm btn--primary box--shadow1 text--small addCategory" ><i class="las la-plus"></i>@lang('Add Sub Category')</a>

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

            modal.find('select[name=category_id]').val($(this).data('category_id'));

            modal.modal('show');

        });



         $(document).on("change",".custom-file-input",function(){

            var fileName = $(this).val().split("\\").pop();

            $(this).siblings(".custom-file-label").addClass("selected").html(fileName);

        });

    </script>

@endpush

