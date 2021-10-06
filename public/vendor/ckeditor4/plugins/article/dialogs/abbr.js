CKEDITOR.dialog.add( 'abbrDialog', function( editor ) {
    return {
        title: 'แนะนำบทความเพิ่มเติม/อื่นๆ',
        minWidth: 600,
        minHeight: 450,
        contents: [
            {
                id: 'tab-basic',
                elements: [
                    {
                        type: 'text',
                        id: 'abbr',
                        label: 'ค้นหาจากชื่อบทความ',
                        onLoad : function(event) {

                            $('input.cke_dialog_ui_input_text').keyup(function() {

                                var keyword = $('input.cke_dialog_ui_input_text').val();
                                var trscxzc= keyword;

                                $.ajax({
                                    type: 'GET',
                                    url: '/setting/artlicle/search',
                                    data: { keyword: trscxzc  },
                                    dataType: 'json',
                                    success: function(data, textStatus, jqXHR) {

                                        $('.results').html('');

                                        if(data.length != 0){
                                            var artlice_display = [];
                                            $.each(data, function (index, item) {

                                                artlice_display += '<div class="hidden_Artlice" href="javascript:void(0);" onclick="showSymbols(this)" data-parmalink="'+item.art_parmalink+'" data-name="'+item.art_name+'" data-thumb="'+item.art_thumb+'" data-seo="'+item.art_seo_detail+'"><a class="" >'+item.art_name+'</a></div>';

                                            });

                                            $('.results').append(artlice_display);
                                        }else{

                                            $('.results').html('');
                                            $('.results').html('<br/><div style="text-align:center">ไม่พบข้อมูล</div>');
                                        }
                                    },
                                    error: function(jqXHR, textStatus, errorThrown) {
                                        console.log('ajax error ' + textStatus + ' ' + errorThrown);
                                    },
                                });

                            })

                        },
                    },
                    {
                        type: 'html',
                        id: 'showArticle',
                        html : '<div class="results"></div>',
                        onLoad: function() {
                            widget = this;

                            $.ajax({
                                type: 'GET',
                                url: '/setting/artlicle/random',
                                dataType: 'json',
                                success: function(data, textStatus, jqXHR) {

                                    var artlice_display = [];
                                    $.each(data, function (index, item) {

                                        artlice_display += '<div class="hidden_Artlice" href="javascript:void(0);" onclick="showSymbols(this)" data-parmalink="'+item.art_parmalink+'" data-name="'+item.art_name+'" data-thumb="'+item.art_thumb+'" data-seo="'+item.art_seo_detail+'"><a class="" >'+item.art_name+'</a></div>';

                                    });

                                    $('.results').append(artlice_display);
                                },
                                error: function(jqXHR, textStatus, errorThrown) {
                                    console.log('ajax error ' + textStatus + ' ' + errorThrown);
                                },
                            });
                        },
                    },
                ]
            }
        ],
        buttons: [ editor.cancelButton, editor.okButton ]
    };

});

function showSymbols(e){
    var parmalink       = $(e).data('parmalink');
    var name            = $(e).data('name');
    var thumb           = $(e).data('thumb');
    var seo             = $(e).data('seo');

    var showArticle = '<div style="box-shadow: 1px 1px 5px 2px #eee; margin-top:20px; margin-bottom:20px; overflow: auto;">';
    showArticle += '<div">';
    showArticle += '<div style="float: left; max-width: 300px; margin: 10px;"><a href="'+parmalink+'"><img style="width:100%!important; height: auto; text-align: center;" alt="'+name+'" src="'+thumb+'" /></a></div>';
    showArticle += '<div style="font-size:14px; margin: 10px;"><a href="'+parmalink+'" style="color: #0782C1;text-decoration: underline !important;">'+name+'</a><br>'+seo+'</div>';
    showArticle += '</div>';
    showArticle += '</div>';

    CKEDITOR.instances['editor'].insertHtml(showArticle);
    CKEDITOR.dialog.getCurrent().hide()

}

