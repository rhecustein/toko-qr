@extends('layouts.dashboard')

@section('title',trans('layout.custom_menu'))

@section('css')
    <link rel="stylesheet" href="{{asset('css/jQuery.drag-drop.css')}}">

@endsection

@section('main-content')
    <div class="row page-titles mx-0">
        <div class="col-sm-6 p-md-0">
            <div class="welcome-text">
                <h4>{{trans('layout.restaurant')}}</h4>
                <p class="mb-0">{{trans('layout.your_restaurant')}}</p>
            </div>
        </div>
        <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">{{trans('layout.home')}}</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">{{trans('layout.restaurants')}}</a></li>
            </ol>
        </div>
    </div>
    <!-- row -->

    <div class="row">
        <div class="col-lg-7">
            <form action="{{route('restaurant.custom-menu.store')}}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id" value="{{$restaurant->id}}">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">{{$restaurant->name}}</h4>
                    </div>
                    <div class="card-body">

                        <div id="accordion-six" class="accordion accordion-with-icon">
                            <div class="accordion__item">
                                <div class="accordion__header" data-toggle="collapse"
                                     data-target="#with-icon_collapseOne">
                                    <span class="fa fa-dashcube"></span>
                                    <span class="accordion__header--text">{{trans('Basic Info')}}</span>
                                    <span class="accordion__header--indicator indicator_bordered"></span>
                                </div>
                                <div id="with-icon_collapseOne" class="collapse accordion__body show"
                                     data-parent="#accordion-six">
                                    <div class="accordion__body--text">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="row">
                                                    <div class="col-lg-12 mb-2">
                                                        <div>
                                                            <h5>{{trans('layout.cover')}}</h5>
                                                            <div>
                                                                <div class="drag-drop">
                                                                    <div class="drag-drop-wrapper">
                                                                        <input type="file" name="header_image"
                                                                               accept="image/*">
                                                                        <div class="drop-area">
                                                                            <section class="dropPreview">
                                                                                <img class="dropped-img"
                                                                                     src="{{asset('uploads/'.$restaurant->cover_image)}}"
                                                                                     alt="image">
                                                                            </section>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label
                                                        class="col-sm-3 col-form-label">{{trans('layout.title')}}</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" value="{{$restaurant->name}}"
                                                               name="header_title" class="form-control"
                                                               placeholder="{{trans('layout.enter_title')}}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="form-group row">
                                                    <label
                                                        class="col-sm-3 col-form-label">{{trans('layout.description')}}</label>
                                                    <div class="col-sm-9">
                                        <textarea type="text" name="description" class="form-control"
                                                  placeholder="{{trans('layout.enter_description')}}">{!! clean($restaurant->description) !!}</textarea>
                                                        <span class="allow-html-text">{{trans('Html allowed')}}</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="form-group row">
                                                    <label
                                                        class="col-sm-3 col-form-label">{{trans('layout.footer')}}</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" name="footer" value="{{$restaurant->footer}}"
                                                               class="form-control"
                                                               placeholder="{{trans('layout.enter_footer')}}">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="accordion__item">
                                <div class="accordion__header collapsed" data-toggle="collapse"
                                     data-target="#with-icon_collapseTwo">
                                    <span class="fa fa-list"></span>
                                    <span class="accordion__header--text">{{trans('layout.custom_menu')}}</span>
                                    <span class="accordion__header--indicator indicator_bordered"></span>
                                </div>
                                <div id="with-icon_collapseTwo" class="collapse accordion__body"
                                     data-parent="#accordion-six">
                                    <div class="accordion__body--text">
                                        @if($restaurant->custom_menus->isNotEmpty())
                                            @foreach($restaurant->custom_menus as $key=>$menu)
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <div>
                                                            <div class="row-divider">Menu {{$key+1}}</div>
                                                            <h5>Upload PDF or image</h5>
                                                            <div class="pull-right delete-menu"><i
                                                                    class="fa fa-trash"></i></div>
                                                            <div>
                                                                <div class="drag-drop">
                                                                    <div class="drag-drop-wrapper">
                                                                        <input type="file" name="menu_files_pre[]"
                                                                               data-id="{{$key}}">
                                                                        <div class="drop-area">
                                                                            <section class="dropPreview">

                                                                                @php $tempArr=explode('.',$menu->image);
                                                                    $extension=end($tempArr) @endphp
                                                                                @if($extension=='pdf')
                                                                                    <embed class="dropped-pdf"
                                                                                           src="{{asset('uploads/'.$menu->image)}}">
                                                                                @else
                                                                                    <img class="dropped-img"
                                                                                         src="{{asset('uploads/'.$menu->image)}}"
                                                                                         alt="image">
                                                                                @endif
                                                                            </section>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="mt-4 mb-2">
                                                                <div class="form-group row">
                                                                    <label
                                                                        class="col-sm-3 col-form-label">{{trans('layout.name')}}</label>
                                                                    <div class="col-sm-9">
                                                                        <input id="pre_image_{{$key}}" type="hidden"
                                                                               name="pre_image[]"
                                                                               value="{{$menu->image}}">
                                                                        <input id="pre_title_{{$key}}"
                                                                               value="{{$menu->name}}" type="text"
                                                                               name="title_pre[]" class="form-control"
                                                                               placeholder="{{trans('layout.enter_name')}}">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row">
                                                                    <label
                                                                        class="col-sm-3 col-form-label">{{trans('layout.category')}}</label>
                                                                    <div class="col-sm-9">
                                                                        <select id="pre_category_{{$key}}"
                                                                                name="category_id_pre[]"
                                                                                class="form-control">
                                                                            @foreach($categories as $category)
                                                                                <option
                                                                                    {{isset($menu) && $menu->category_id==$category->id?'selected':''}} value="{{$category->id}}">{{$category->name}}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @else

                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div>
                                                        <div class="row-divider">Menu 1</div>
                                                        <h5>Upload PDF or image</h5>
                                                        <div>
                                                            <div class="drag-drop">
                                                                <div class="drag-drop-wrapper">
                                                                    <input type="file" name="menu_files[]">
                                                                    <div class="drop-area">
                                                                        <h3 class="drop-text">Drag &amp; Drop Image or
                                                                            PDF</h3>
                                                                        <section class="dropPreview">

                                                                        </section>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="mt-4 mb-2">
                                                            <div class="form-group row">
                                                                <label
                                                                    class="col-sm-3 col-form-label">{{trans('layout.name')}}</label>
                                                                <div class="col-sm-9">
                                                                    <input type="text" name="title[]"
                                                                           class="form-control"
                                                                           placeholder="{{trans('layout.enter_name')}}">
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label
                                                                    class="col-sm-3 col-form-label">{{trans('layout.category')}}</label>
                                                                <div class="col-sm-9">
                                                                    <select name="category_id[]" class="form-control">
                                                                        @foreach($categories as $category)
                                                                            <option
                                                                                {{isset($item) && $item->category_id==$category->id?'selected':''}} value="{{$category->id}}">{{$category->name}}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        @endif

                                        <div id="newMenuList">

                                        </div>

                                        <div class="mt-3">
                                            <button class="btn btn-primary btn-xs" id="addNewMenu"
                                                    type="button">{{trans('layout.add_menu')}}</button>
                                        </div>

                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary btn-xs">{{trans('layout.submit')}}</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-lg-4">
            <div class="screen-previewer">
                <iframe class="preview-frame"
                        src="{{route('show.restaurant',['slug'=>$restaurant->slug,'id'=>$restaurant->id,'type'=>'custom'])}}"
                        frameborder="0"></iframe>
            </div>
        </div>
    </div>

@endsection

@section('js')
    <script src="{{asset('vendor/summernote/js/summernote.min.js')}}"></script>
    <script !src="">
        let menutitle = {{$restaurant->custom_menus->count()}};

        $(document).on('click', '#addNewMenu', function (e) {
            e.preventDefault();
            menutitle++;
            let html = `<div class="row">
                            <div class="col-lg-12">
                                <div>
                                    <div class="row-divider">Menu ${menutitle}</div>
                                    <h5>Upload PDF or image</h5>
                                     <div class="pull-right delete-menu"><i class="fa fa-trash"></i></div>
                                    <div>
                                        <div class="drag-drop">
                                            <div class="drag-drop-wrapper">
                                                <input type="file" name="menu_files[]">
                                                <div class="drop-area">
                                                    <h3 class="drop-text">Drag &amp; Drop Image or PDF</h3>
                                                    <section class="dropPreview">

                                                    </section>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mt-4 mb-2">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">{{trans('layout.name')}}</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="title[]" class="form-control"
                                                       placeholder="{{trans('layout.enter_name')}}">
                                            </div>
                                        </div>

                                    </div>
                                    <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">{{trans('layout.category')}}</label>
                                            <div class="col-sm-9">
                                                <select name="category_id[]" class="form-control">
                                                        @foreach($categories as $category)
            <option {{isset($item) && $item->category_id==$category->id?'selected':''}} value="{{$category->id}}">{{$category->name}}</option>
                                                        @endforeach
            </select>
       </div>
</div>
</div>
</div>
</div>`;
            $('#newMenuList').append(html);

        });

        $(document).on('click', '.drop-area', function (e) {

            const fileElement = $(this).parent().find('input[type="file"]');
            const fileName = fileElement.attr('name');
            if (fileName != 'header_image') {
                fileElement.attr('name', 'menu_files[]');
                const id = $(this).parent().find('input[type="file"]').first().attr('data-id');
                $('#pre_category_' + id).attr('name', 'category_id[]');
                $('#pre_title_' + id).attr('name', 'title[]');
                $('#pre_image_' + id).remove();
            }
            $(this).parent().find('input[type="file"]').click();
        });

        $(document).on('dragenter', '.drop-area', function (e) {
            e.preventDefault();
            $(this).css('background', '#BBD5B8');
        });

        $(document).on('dragleave', '.drop-area', function (e) {
            e.preventDefault();

            if ($(this).closest("." + e.target.className).length <= 0) {
                $(this).css('background', '#fff');
            }

        });

        $(document).on('dragover', '.drop-area', function (e) {
            e.preventDefault();
        });

        $(document).on('drop', '.drop-area', function (e) {
            $('.drop-area').css('background', '#FFF');
            e.preventDefault();
            $(this).find('.drop-text').remove();
            var files = e.originalEvent.dataTransfer.files;
            $(this).parent().find('input[type="file"]').first()
                .prop("files", files);

            const id = $(this).parent().find('input[type="file"]').first().attr('data-id');
            if (id) {
                $(this).parent().find('input[type="file"]').attr('name', 'menu_files[]');
                $('#pre_category_' + id).attr('name', 'category_id[]');
                $('#pre_title_' + id).attr('name', 'title[]');
                $('#pre_image_' + id).remove();
            }


            let extension = files[0].name.split('.').pop();
            let html = '';
            if (extension == 'pdf') {
                const src = URL.createObjectURL(files[0]);
                html = `<embed class="dropped-pdf" src="${src}">`;
                $(html).onload = function () {
                    URL.revokeObjectURL(src) // free memory
                }

            } else {
                const src = URL.createObjectURL(files[0]);
                html = `<img src="${src}" class="dropped-img" alt="image">`;
                $(html).onload = function () {
                    URL.revokeObjectURL(src) // free memory
                };

            }
            $(this).find('.dropPreview').html(html);
        });

        $(document).on('change', 'input[type="file"]', function (e) {
            var files = this.files;
            $(this).parent().find('.drop-text').remove();
            let extension = files[0].name.split('.').pop();
            let html = '';
            if (extension == 'pdf') {
                const src = URL.createObjectURL(files[0]);
                html = `<embed class="dropped-pdf" src="${src}">`;
                $(html).onload = function () {
                    URL.revokeObjectURL(src) // free memory
                }

            } else {
                const src = URL.createObjectURL(files[0]);
                html = `<img src="${src}" class="dropped-img" alt="image">`;
                $(html).onload = function () {
                    URL.revokeObjectURL(src) // free memory
                };

            }
            $(this).parent().find('.dropPreview').html(html);

        });

        $(document).on('click', '.delete-menu', function (e) {
            e.preventDefault();
            $(this).closest('.row').remove();
        });


    </script>

@endsection
