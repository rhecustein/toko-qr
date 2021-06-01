(function($){
    $.fn.dragDrop = function(configs)
    {
        var settings = $.extend({
            url: null,
            data:[],
            method: 'POST',
            inputName: 'files',
            acceptType: null,
            class : null,
            xcsrftoken: null,
            tokenKey: null,
            label: 'Drag and Drop Images Here',
            uploadedFileUrl: null
        },configs);

        var dragDrop = this;
        let fileList=[];

        return this.each(function(){
            childs = $(dragDrop).find('.wrapper');
            if(!childs.length)
            {
                $(this).html('<div class="drag-drop-wrapper">'+
                    '<input type="file">'+
                    '<input type="hidden" name="' + settings.inputName + '">'+
                    '<div class="drop-area">'+
                    '<h3 class="drop-text">' + settings.label + '</h3>'+
                    '</div>'+
                    '</div>');
            }

            $(dragDrop).find('.drop-area').on('dragenter',function(e){
                e.preventDefault();
                $(this).css('background', '#BBD5B8');
            });

            $(dragDrop).find('.drop-area').on('dragover',function(e){
                e.preventDefault();
            });

            $(dragDrop).find('.drop-area').on('drop', function(e){
                $(this).css('background', '#FFF');
                e.preventDefault();
                var files = e.originalEvent.dataTransfer.files;
                createFormData(files);
            });

            $(dragDrop).find('.drop-area').on('click', function(){
                $(dragDrop).find('input[type="file"]').click();
            });

            $(dragDrop).find('input[type="file"]').on('change', function(e){
                fileList.push(this.files[0]);
                createFormData(this.files);
            });

            $(document).on('click', '.remove-file', function(){
                $(this).parents('.progress-bar-wrapper').remove();
            });


            function createFormData(files)
            {

                var fileForm = new FormData();
                numberOfFiles = files.length;
                let name = Date.now();

                for (var key in settings.data) {
                    console.log(settings.data[key].name);
                    if (settings.data.hasOwnProperty(key)) {
                        fileForm.append(settings.data[key].name,settings.data[key].value);
                    }
                }

                for(i=0; i < numberOfFiles; i++)
                {
                    fileForm.append('file',files[i]);
                    $fileName=files[i].name;
                    console.log(menutitle);
                    $(dragDrop).append('<input value='+$fileName+' type="hidden"  name="menu_files[menu'+menutitle+']" /><div class = "progress-bar-wrapper"><div class="progress  mt-3 d-inline-block" style = "width:calc(100% - 25px)" name="'+ (name+i) +'">'+
                        '<div class="progress-bar progress-bar-animated" role="progressbar" style="width: 0%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">0%</div>'+
                        '</div><span class="pull-right" style="margin-top: .7rem !important;"><a href="javascript:;" class = "remove-file"><i class="fa fa-times-circle text-danger"></i></a>  <input value='+$fileName+' type = "hidden"  name = "'+ settings.inputName + '[]" /></span> <span> '+ $fileName +'</span></div>');
                    uploadFormData(fileForm, (name+i));
                }
            }

            function uploadFormData(formData,fileName)
            {
                let ajaxSetup = $.ajaxSetup();
                if(typeof ajaxSetup.headers == 'undefined' || typeof ajaxSetup.headers['X-CSRF-TOKEN'] == 'undefined')
                {
                    if(!settings.xcsrftoken && !$('meta[name="csrf-token"]').attr('content'))
                    {
                        console.error('X-CSRF-TOKEN has not been set in ajaxSetup. Nor, xcsrftoken provided in initialization nor defined in meta tag. Please initialize csrftoken in <meta name="csrf-token" content="csrf_token_provided_server"/>');
                    }
                    else
                    {
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': ((settings.xcsrftoken) ? settings.xcsrftoken : $('meta[name="csrf-token"]').attr('content'))
                            }
                        });
                    }
                }

                $.ajax({
                    url: settings.url,
                    type: "POST",
                    data: formData,
                    contentType:false,
                    cache: false,
                    processData: false,
                    dataType: 'json',
                    // for progess bar in upload
                    xhr: function() {
                        var myXhr = $.ajaxSettings.xhr();
                        if(myXhr.upload){
                            myXhr.upload.addEventListener('progress',function(e){
                                if(e.lengthComputable){
                                    var max = e.total;
                                    var current = e.loaded;
                                    var Percentage = (current * 100)/max;
                                    bar = $('div.progress[name="'+fileName+'"]').find('.progress-bar');
                                    $(bar).css('width',Percentage+'%');
                                    $(bar).text(Percentage+'%');
                                    if(Percentage >= 100)
                                    {


                                    }
                                }
                            }, false);
                        }
                        return myXhr;
                    },
                    success: function(data){
                        keypattern = (settings.uploadedFileUrl) ? settings.uploadedFileUrl : 'value';

                        $('div[name="'+fileName+'"]').parents('.progress-bar-wrapper').find('input').val(objectMap(data,keypattern));
                    }
                });
            }

            function objectMap(object,keypattern = null)
            {
                keypattern = keypattern.toString();
                var returnableValue = object;
                keys = keypattern.split('.');
                keys.forEach(function(key){
                    if(returnableValue)
                    {
                        returnableValue = returnableValue[key];
                    }
                });
                return (returnableValue != null)? returnableValue : '';
            }
        });






    }

}(jQuery));
