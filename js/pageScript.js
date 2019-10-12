

function fbox(url,tit,tipe)
{
    if(tipe == "") tipe = "ajax";
    $.fancybox.open({
        href:url,
        title:tit,
        padding:10,
        fitToView:false,
        autoCenter:false,
        helpers:  {
            title : {
                type : 'inside'
            },
            overlay : {
                showEarly : false
            }
        },
        type:tipe,
        afterClose:function() { $.cookie("fconnect","false",{	path: '/',domain: '.tribunnews.com'});$.cookie("auth",null,{	path: '/',domain: '.tribunnews.com'});}
    });
}
