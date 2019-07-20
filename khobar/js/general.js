var $ = jQuery.noConflict();
function home_slider() {

	$("#bx-pager a").hover(function(){
		slider.goToSlide($(this).attr("data-slide-index"));
		$("#bx-pager a").removeClass("active");
		$(this).addClass("active");
	})

    var slider = $('#slideshow').bxSlider({
		mode: 'fade',
		controls:false,
		auto: false,
		pause: 10000,
		speed: 200,
		pagerCustom: '#bx-pager',
		autoHover: true,
		autoControlsCombine:true,
		autoHover: true,
		pagerEvent:'mousemove',
	});
    $('#bx-pager').bxSlider({
		auto: true,
		pause: 50000,
		pager:false,
		controls:true,
   	 	slideWidth: 250,
    	minSlides: 4,
    	maxSlides: 4,
    	slideMargin: 0,
  		infiniteLoop: false,
  		hideControlOnEnd: true,
		nextText: '<i class="fa fa-chevron-right"></i>',
		prevText: '<i class="fa fa-chevron-left"></i>'
	});
	
}

jQuery(document).ready(function($) { 
	/*jQuery(document).on('mouseover','.art-list',function($){
		var t = $(this).find(".sharecot");
		var ctop = $(this).find(".foot").position().top;
		var cwleft = $(this).find(".foot").position().left;
		var cwidth = $(this).find(".foot").width();
		var wpfoot = $(this).find(".foot").parent().width();
		if (t.is(':empty')) {
			var url = t.attr("data-href");
			var title = t.attr("data-title");
			var via = t.attr("data-via");
			if(via == "" || via == null ) via = "tribunnews";
			html = '<div class="fl mr10 pos_rel sncount"><a href="javascript:void(0)" onclick="window.open(\'https://www.facebook.com/sharer/sharer.php?u='+url+'&t='+title+'\',\'popUpWindow\',\'height=350,width=550,resizable=no,scrollbars=no,toolbar=no,menubar=no,location=no,directories=no,status=no\')"><span class="fbshare"><i class="fa fa-facebook-official"></i>Share</span></a></div><div class="fl pos_rel sncount"><a href="javascript:void(0)" onclick="window.open(\'https://twitter.com/intent/tweet?original_referer='+url+'&text='+title+'&tw_p=tweetbutton&url='+url+'&via='+via+'\',\'popUpWindow\',\'height=350,width=550,resizable=no,scrollbars=no,toolbar=no,menubar=no,location=no,directories=no,status=no\')"><span class="twshare"><i class="fa fa-twitter"></i>Tweet</span></a></div>';
			t.html(html);
		} else {
			t.show();
		}
		t.css("top",ctop);
		if(wpfoot > 300) {
			$(this).find(".foot").parent().children().show();
			t.css("left",cwidth + cwleft  + 15);
		} else {
			$(this).find(".foot").parent().children().hide();
			$(this).find(".foot").parent().css({display:'block',height:'18px'});
			t.css("height", $(this).find(".foot").parent().height());
			t.css("left", 0);
		}
	}).live('mouseout','.art-list',function(){
		$(this).find(".sharecot").hide();
		$(this).find(".foot").parent().children().show();
	});*/


	var ontop = function(){
		var st = $(window).scrollTop();		
		if(st < $(window).height())	
			$(".ontop").hide();
		else
			$(".ontop").show();
	}
	$(window).scroll(ontop);
	$(".ontop").click(function(){
      $('html, body').animate({scrollTop:0}, 'normal');
        return false;
	});

	$("#qsearch").submit(function(){
		if($("#searchbox").val() == $("#searchbox").attr("placeholder")) {
			$("#searchbox").val("");
			$("#searchbox").focus();
			return false;		
		}
	})
	$(".plh").focus(function(){
		if($(this).val() == $(this).attr("placeholder")) {
			$(this).val("");
		}

	});
	$(".plh").keypress(function(){
		if($(this).val() == $(this).attr("placeholder")) {
			$(this).val("");
		}
	
	});

	

});
	
	function ajaxload(url,result,loaded,cache)
	{
		var url = url.replace('/#','/');
		var url = url.replace('#','/');
		if (!re) var re = false;
		if (loaded) $(loaded).show('slow');
		$.ajax({
			url : url,
			cache: cache,
			dataType: "html",
			success: function(data) {
				$(result).html(data);
				if (loaded) $(loaded).hide('slow');
			}
		});
	}

	function ajaxload2(url,result)
	{
		$(result).show();
		$(result).load(url);
		return false;
	}

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
	};

	function fbox_close()
	{
		$.fancybox.close();
	};

function moveScroller3() {
	    var move3 = function() {
	        var s3 = $("#wideskyscraper");
	        var st3 = $(window).scrollTop();
	        var ot3 = $("#fixads").offset().top - 105;
	        var bt3 = $("#fixsharebottom").offset().top - s3.height() - 133;	
	        if(st3 > ot3) {
				var vtop = 65;
				if($(".main-menu").css("opacity") == "1") vtop = 65 + $(".main-menu").height();
	            s3.css({
	                position: "fixed",
	                top: vtop,	
	            });	
	        } 
	
			if(st3 > bt3 ) {
	            s3.css({
	                position: "absolute",
					top: "inherit",
					bottom	: "5px",
	            });
	        }
	
			if(st3 < ot3) {
	            s3.css({
	                position: "relative",
	                top: "0px",
	            });
	       	}
	    };
	    $(window).scroll(move3);
	    move3();
	}

function moveScroller2() {
		var move2 = function() {
			var s2 = $("#share");
			var st2 = $(window).scrollTop();
			var ot2 = $("#fixsharetop").offset().top - 105;
			var bt2 = $("#fixsharebottom").offset().top - s2.height() - 124;
	
			if(st2 > ot2) {
				var vtop = 65;
				if($(".main-menu").css("opacity") == "1") vtop = 65 + $(".main-menu").height();
				s2.css({
					position: "fixed",
					top: vtop,
	
				});	
			} 
	
			if(st2 > bt2 ) {
				s2.css({
					position: "absolute",
					top: "inherit",
					bottom	: "15px",
				});
			}
	
			if(st2 < ot2) {
				s2.css({
					position: "relative",
					top: "0px",
				});
			}
	
		};
		$(window).scroll(move2);
		move2();
	}


//menu scroll
function moveScroller_menu() {
    var movemenu = function() {
        var st = $(window).scrollTop();
        var ot = $("#fixposmenu").offset().top - 30;
        var s = $(".main-menu");
        if(st > ot) {
			if(window.innerHeight < 700) {		
				var heo = 0;
			}else {
				var heo = 1;
			}
            s.css({
                "position": "fixed",
                "top": "50px",
				"left": "0",
				"margin-top": "0",
				"z-index":"9",
				"opacity":heo,
				"width":"100%",
				"background":"rgba(1,111,186,.95)"
            });
			$(".main-menu > div > ul > li:first-child").css("border-left","1px solid rgba(0,0,0,.1)");
			$(".main-menu > div > ul > li:last-child").css("border-right","1px solid rgba(0,0,0,.1)");
			$(".theader").hover(function(){
				s.css({
					"opacity":"1",
				});
				if($( "#share" ).css( "top" ) == '60px') {
					$("#share").css({
						"top":"95px",
					});
				}
			});
			$("#fixposmenu").html("&nbsp");	
        } else {
            if(st <= ot) {
                s.css({
                    "position": "relative",
                    "top": "",
					"opacity":"1",
					"margin-top": "20px",
					"background":"rgba(1,111,186,1)"
                });
				$(".main-menu > div > ul > li:first-child").css("border-left","none");
				$(".main-menu > div > ul > li:last-child").css("border-right","none");
				$("#fixposmenu").html("");
       	     }
        }
    };
    $(window).scroll(movemenu);
    movemenu();
}



//sidebar left

function moveScroller_sec() {
    var movesec = function() {
        var ssec = $("#popsec");
        var stsec = $(window).scrollTop();
        //var otsecb = $("#fixpos_secb").offset().top - ssec.height() - 120;
	 	//var otsecb = $("#fixpos_secb").offset().top - $(window).height();
       /* if(stsec > otsecb) {
			var vtop = 65;
			if($(".main-menu").css("opacity") == "1") vtop = 65 + $(".main-menu").height();
            ssec.css({
                position: "fixed",
                bottom: "0px",
            });
			$("#fixposc").height(ssec.height());
			$("#fixpos_sec").html("&nbsp;");
			ssec.attr("class","w160");
        } 
		else {
            ssec.css({
               	position: "relative",
        		top: ""
            });
			$("#fixposc").height(0);
			$("#fixpos_sec").html("&nbsp;");
			ssec.attr("class","w160");
        }
    */
       
    	
	};
    $(window).scroll(movesec);
    movesec();
}

//right sidebar
/*
function moveScroller_boxright() {
    var moveright = function() {
        var wct = $(window).scrollTop();
	    var brfc = $("#boxright_fixc").offset().top - $(window).height();
        var brf = $("#boxright_fix");
		var wbr = $("#boxright").width();
        if(wct > brfc) {
            brf.css({
                position: "fixed",
                bottom: "0px",
				width: wbr
            });
			$("#boxright_fixb").height(brf.height());
        } 
		else {
        	brf.css({
                position: "relative",
           		bottom: "",
				width: wbr
            });
			$("#boxright_fixb").height(0);
        }
    };
    $(window).scroll(moveright);
    moveright();
}
jQuery(document).ready(function($){
	moveScroller_boxright();
});
*/

jQuery.browser = {};
(function () {
    jQuery.browser.msie = false;
    jQuery.browser.version = 0;
    if (navigator.userAgent.match(/MSIE ([0-9]+)\./)) {
        jQuery.browser.msie = true;
        jQuery.browser.version = RegExp.$1;
    }
})();

jQuery.fn.exists = function(callback) {
  var args = [].slice.call(arguments, 1);
  if (this.length) {
    callback.call(this, args);
  }
  return this;
};


/*----------------------------------------------------
/* Responsive Menu
/*--------------------------------------------------*/
jQuery(document).ready(function($) {
    $('.slideout-menu-toggle').on('click', function(event){
    	event.preventDefault();
    	// create menu variables
    	var slideoutMenu = $('.slideout-menu');
    	var slideoutMenuWidth = $('.slideout-menu').width();
    	
    	// toggle open class
    	slideoutMenu.toggleClass("open");
    	
    	// slide menu
    	if (slideoutMenu.hasClass("open")) {
	    	slideoutMenu.animate({
		    	left: "0px"
	    	});	
    	} else {
	    	slideoutMenu.animate({
		    	left: -slideoutMenuWidth
	    	}, 250);	
    	}
    });
});

jQuery.cookie=function(name,value,options){if(typeof value!='undefined'){options=options||{};if(value===null){value='';options=$.extend({},options);options.expires=-1;}var expires='';if(options.expires&&(typeof options.expires=='number'||options.expires.toUTCString)){var date;if(typeof options.expires=='number'){date=new Date();date.setTime(date.getTime()+(options.expires*24*60*60*1000));}else{date=options.expires;}expires='; expires='+date.toUTCString();}var path=options.path?'; path='+(options.path):'';var domain=options.domain?'; domain='+(options.domain):'';var secure=options.secure?'; secure':'';document.cookie=[name,'=',encodeURIComponent(value),expires,path,domain,secure].join('');}else{var cookieValue=null;if(document.cookie&&document.cookie!=''){var cookies=document.cookie.split(';');for(var i=0;i<cookies.length;i++){var cookie=jQuery.trim(cookies[i]);if(cookie.substring(0,name.length+1)==(name+'=')){cookieValue=decodeURIComponent(cookie.substring(name.length+1));break;}}}return cookieValue;}};


$(document).ready(function() {
    
	$(window).scroll(function() {
        var s = $(window).scrollTop(),
            t = $(".header").outerHeight();
        $(".nav").outerHeight();
        s > t + 20 ? ($(".header").addClass("header--sticky"), $(".nav").addClass("nav--sticky"), $(".js-nav-offset").css({
            "padding-top": "47px"
        }), $(".js-kcm-stick").addClass("kcm__stick--sticky")) : ($(".header").removeClass("header--sticky"), $(".nav").removeClass("nav--sticky"), $(".js-nav-offset").removeAttr("style"), $(".js-kcm-stick").removeClass("kcm__stick--sticky"))
    })
});