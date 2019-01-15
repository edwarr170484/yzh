String.prototype.translit = (function(){
    var L = {
'А':'A','а':'a','Б':'B','б':'b','В':'V','в':'v','Г':'G','г':'g',
'Д':'D','д':'d','Е':'E','е':'e','Ё':'Yo','ё':'yo','Ж':'Zh','ж':'zh',
'З':'Z','з':'z','И':'I','и':'i','Й':'Y','й':'y','К':'K','к':'k',
'Л':'L','л':'l','М':'M','м':'m','Н':'N','н':'n','О':'O','о':'o',
'П':'P','п':'p','Р':'R','р':'r','С':'S','с':'s','Т':'T','т':'t',
'У':'U','у':'u','Ф':'F','ф':'f','Х':'Kh','х':'kh','Ц':'Ts','ц':'ts',
'Ч':'Ch','ч':'ch','Ш':'Sh','ш':'sh','Щ':'Sch','щ':'sch','Ъ':'','ъ':'',
'Ы':'Y','ы':'y','Ь':'','ь':'','Э':'E','э':'e','Ю':'Yu','ю':'yu',
'Я':'Ya','я':'ya','_':'-',',':'',' ':'-','\/':'-'
        },
        r = '',
        k;
    for (k in L) r += k;
    r = new RegExp('[' + r + ']', 'g');
    k = function(a){
        return a in L ? L[a] : '';
    };
    return function(){
        return this.replace(r, k);
    };
})();

function generateTranslit(from, to)
{
    var value = from.val();
    to.val(value.translit());
}

$(document).ready(function(){
    $(".selectAllItems").click(function(){
            var checked = $(this).prop("checked");
            var parent = $(this).closest("table");
            parent.find(".checkbox-item").each(function(){
               
               if( checked == false)
               {
                   $(this).prop("checked", false);
               }
               else
               {
                   $(this).prop("checked", true);
               }
                
            });
        });
    
    $(".product-foto-ispreview").click(function(){
       
       if($(this).prop("checked") === true)
       {
           $(".product-foto-ispreview").prop("checked",false);
           $(this).prop("checked",true);
       }
        
    });
    $("#add-gallery-image").click(function(){
        
        var prototype = $("#gallery_items").data("prototype");
        var count = $(".table-gallery-items tbody tr").length;
        var newForm = prototype.replace(/__name__/g, count);
        
        $(".table-gallery-items tbody").append(newForm);
        
         tinymce.init({
                    language: "ru",
                    valid_elements : "*[*]",
                    cleanup : false,
                    height:"300",
            verify_html : false,
            cleanup_on_startup : false,
            forced_root_block : "",
            validate_children : false,
            remove_redundant_brs : false,
            remove_linebreaks : false,
            force_p_newlines : false,
            force_br_newlines : false,
            valid_children : "+a[div|p|img|br|strong],+ol[p|img|br|strong],+ul[p|img|br|strong]",
            validate: false,
            fix_table_elements : false,
            fix_list_elements:false,
            image_advtab: true,
                    selector: "textarea.tinyeditor",
                    plugins: "advlist autolink lists link image charmap print preview anchor searchreplace visualblocks code fullscreen insertdatetime media table contextmenu paste textcolor filemanager",
                    toolbar: "insertfile undo redo | styleselect | bold italic | forecolor | backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | filemanager"
            });
    });
    
    $("#add-page-block").click(function(){
        
        var prototype = $("#page_blocks").data("prototype");
        var count = $(".table-page-blocks tbody tr").length;
        var newForm = prototype.replace(/__name__/g, count);
        
        $(".table-page-blocks tbody").append(newForm);
        
         tinymce.init({
            language: "ru",
            valid_elements : "*[*]",
            cleanup : false,
            height:"300",
            verify_html : false,
            cleanup_on_startup : false,
            forced_root_block : "",
            validate_children : false,
            remove_redundant_brs : false,
            remove_linebreaks : false,
            force_p_newlines : false,
            force_br_newlines : false,
            valid_children : "+a[div|p|img|br|strong],+ol[p|img|br|strong],+ul[p|img|br|strong]",
            validate: false,
            fix_table_elements : false,
            fix_list_elements:false,
            image_advtab: true,
            selector: "textarea.tinyeditor",
            plugins: "advlist autolink lists link image charmap print preview anchor searchreplace visualblocks code fullscreen insertdatetime media table contextmenu paste textcolor filemanager",
            toolbar: "insertfile undo redo | styleselect | bold italic | forecolor | backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | filemanager"
            });
    });
    
    $("#add-menu-item-block").click(function(){
        var prototype = $(this).next("#menu_items").data("prototype");
        var count = $(this).parent().find(".table-menu-items-blocks tbody tr").length;
        var newForm = prototype.replace(/__name__/g, count);
        $(this).parent().find(".table-menu-items-blocks tbody").append(newForm);
    });
    
    $("#add-portfolio-image").click(function(){
        var prototype = $(this).next("#portfolioItem_portfolioImages").data("prototype");
        var count = $(this).parent().find(".table-portfolio-images tbody tr").length;
        var newForm = prototype.replace(/__name__/g, count);
        $(this).parent().find(".table-portfolio-images tbody").append(newForm);
    });
});


function itemUp(element)
{
    var parentTr = element.closest("tr");
    var upperTr = parentTr.prev("tr");
    var table = element.closest("table");
        
    if(upperTr.html() !== undefined)
    {
        var parentTrHtml = parentTr.html();
        var upperTrHtml = upperTr.html();
            
        parentTr.html(upperTrHtml);
        upperTr.html(parentTrHtml);
            
        var i = 1;
        table.find(".item-sortorder").each(function(){
                
            $(this).val(i);
            i++;
        });
    }
}

function itemDown(element)
{
    var parentTr = element.closest("tr");
    var lowerTr = parentTr.next("tr");
    var table = element.closest("table");
        
    if(lowerTr.html() !== undefined)
    {
        var parentTrHtml = parentTr.html();
        var lowerTrHtml = lowerTr.html();
            
        parentTr.html(lowerTrHtml);
        lowerTr.html(parentTrHtml);
            
        var i = 1;
        table.find(".item-sortorder").each(function(){
                
            $(this).val(i);
            i++;
        });
    }
}