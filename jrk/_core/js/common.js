
 
$(document).ready(function () {
    slides_main();
	language_chk();
	indexBannerHeight();
	mainMenu();

});
 
function slides_main() {  
    var visual = $('.brandVisual > ul > li');
    var button = $('.buttonList > li');
    var current = 0;
    var setIntervalId;    
    button.on({
        click:function(){
            var tg = $(this);
            var i = tg.index();
            button.removeClass('on');
            tg.addClass('on');
            move(i);
        }
    });   
	/*$('.main_visual').on({
        mouseover:function(){
            clearInterval(setIntervalId);
        },
        mouseout:function(){
            timer();
        }
    });*/
	/*
	chk = $('#chk_1').val();
	if(chk==0){
		$('#chk_1').val('1');
		timer();
	}else{
	}
	
	*/
	
    function timer(){
        setIntervalId = setInterval(function(){
            var n = current + 1;
            if(n == visual.size()){
                n = 0;
            }
            button.eq(n).trigger('click');
        }, 5000);
		return setIntervalId;
		
    }    
	//console.log(setIntervalId)
	
	
    function move(i){
        if(current == i) return;        
        var currentEl = visual.eq(current);
        var nextEl = visual.eq(i);        
        currentEl.css({left:0}).stop().animate({left:'-100%'},2000);
        nextEl.css({left:'100%'}).stop().animate({left:0},2000);
        current = i;
    }

	chk = $('#chk_1').val();//0

	if(chk==0){
		timer();
		$('#chk_1').val('2');
	}else{
		clearInterval(setIntervalId);
	}

	$('.visual_btn .start').click(function(){
			chk2 = $('#chk_1').val();
			if(chk2==2){			
				
			}else{	
				timer();
				$('#chk_1').val('2');
				
			}

	});
	$('.visual_btn .stop').click(function(){
				clearInterval(setIntervalId);
				$('#chk_1').val('1');
	});

	//
	
	/*chk = $('#chk_1').val(); //1
	
	if( chk== 0 ){
		$('.visual_btn .start').click(function(){
			timer();
			$('#chk_1').val('1');
			//chk = 1;
			//console.log("chk = "+chk)
		});
	}else{
		$('.visual_btn .stop').click(function(){
			clearInterval(setIntervalId);
			$('#chk_1').val('0');
			//chk = 0;
			//console.log("chk = "+chk)
		});
	};
	*/
	
};
function language_chk(){
	$('.chk').click(function(){
		if( $('.language_chk > ul').css("display")=="none"){
			$('.language_chk > ul').css("display","block");
		}else{
			$('.language_chk > ul').css("display","none");
		}
	});
};
function indexBannerHeight(){
	var height = $('.top_banner').height();
	$('.line_banner').css("top",(height-2) +"px")
};

function mainMenu(){
	$('.top_menu > li').hover(function(){
		$('.2depth', this).slideDown(100); //fadeIn() or slideDown()
	},function(){
		$('.2depth', this).fadeOut(200); //fadeOut() or slideUp()
	});
	$('.2depth > li.sub0202').hover(function(){
		$('.sub0202-menu', this).slideDown(100); //fadeIn() or slideDown()
	},function(){
		$('.sub0202-menu', this).fadeOut(200); //fadeOut() or slideUp()
	});


};