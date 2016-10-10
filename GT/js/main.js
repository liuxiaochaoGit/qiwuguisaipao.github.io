// 加载完毕在执行
$(document).ready(function() {
	// 调用 FullPege 插件
	$('#fullpage').fullpage({
		 anchors:['page1','page2','page3','page4','page5','page6','page7','page8','page9'],
		'verticalCentered': false,
		// 'navigation': true,
		'afterLoad': function(anchorLink, index){
			// page1
			if(index == 1){
				// 初始化page2
				pageSecond();
				// 首页隐藏manu菜单
				$('.manuCon').fadeOut(200);
			}else{
				// 显示manu菜单
				$('.manuCon').fadeIn(200);
			}

			// 当加载到第二页时
			if(index == 2){
				$('.titleImg').animate({
					top:'7%',
					opacity:'1'
				});
				$('.boxFirst').animate({
					top:'0'
				},500,function(){
					$('.boxSecond').animate({
						top:'0'
					},500,function(){
						$('.boxThird').animate({
							top:'0'
						},500);
					});
				});

				// 初始化page3
				pageThird();

				//

			}

			// page3
			if(index == 3){
				$('.pageThirdTitle').animate({
					top:'7%',
					opacity:'1'
				},1000,function(){
					$('.pageThirdCon').animate({
						top:'26%',
						opacity:'1'
					},1000);
				});

				// 初始化page2
				pageSecond();

				// 初始化 page4
				pageForth();

			}

			// page4
			if(index == 4){
				$('.pageForthTitle').animate({
					top:'7%',
					opacity:'1'
				},1000);
				$('.pageFourthCon').css({
					transform:'translateX(0) rotateZ(0deg)',
					opacity:'1'
				});

				// 初始化page3
				pageThird();
				// 初始化 page5
				pageFifth();
			}

			// page5
			if(index == 5){
				$('.pageFifthTitle').animate({
					top:'7%',
					opacity:'1'
				},1000);
				$('.fifthText').css({
					transform:'translateX(0) rotateZ(0deg)',
					opacity:'1'
				});
				setTimeout(function(){
					$('.fifthImg').css({
						transform:'translateX(0) rotateZ(0deg)',
						opacity:'1'
					});
				},1000);

				// 初始化page4
				pageForth();
				// 初始化page6
				pageSixth();
			}

			// page6
			if(index == 6){
				$('.pageSixthTitle').animate({
					top:'7%',
					opacity:'1'
				},1000);
				setTimeout(function(){
					$('.sixCon').css({
						transform:'translateY(0px) rotateZ(0deg)',
						opacity:'1'
					});
				},1000);

				// 初始化 page5
				pageFifth();
				// 初始化 page7
				pageSeventh()

			}

			// page7
			if(index == 7){
				$('.pageSeventhTitle').animate({
					top:'7%',
					opacity:'1'
				},1000);
				setTimeout(function(){
					$('.seventhCon').css({
						transform:'rotateZ(0deg)',
						opacity:'1'
					});
				},1000);

				// 初始化page6
				pageSixth();
				// 初始化 page8
				pageEighth();
			}

			// page8
			if(index == 8){
				$('.pageEighthTitle').animate({
					top:'7%',
					opacity:'1'
				},1000);
				setTimeout(function(){
					$('.formCon').animate({
						left:'0',
						opacity:'1'
					},1000,function(){
						$('.eighthCon').animate({
							left:'0',
							opacity:'1'
						},1000);
					});
				},1000);

				// 初始化 page7
				pageSeventh();
				// 初始化 page9
				pageNineth();
			}
			// page9
			if(index == 9){
				$('.pageNinethTitle').animate({
					top:'7%',
					opacity:'1'
				},1000);

				// 初始化 page8
				pageEighth();
			}

			// 调用菜单颜色变化的函数
			manuBgColorChange(index);


		},
	});
	// 调用 swiper 插件
	var mySwiper = new Swiper('.swiper-container',{
		autoplay : 4000,//可选选项，自动滑动
		autoplayDisableOnInteraction : false,
		loop : true,//可选选项，开启循环
		pagination : '.pagination',//分页器
		paginationClickable :true,// 分页器点击
	})

	// 初始化 page2 函数
	function pageSecond(){
		// 初始化page2
		$('.titleImg').animate({
			top:'0%',
			opacity:'0'
		},0);
		$('.boxFirst').animate({
			top:'900'
		},0,function(){
			$('.boxSecond').animate({
				top:'900'
			},0,function(){
				$('.boxThird').animate({
					top:'900'
				},0);
			});
		});
	}

	// 初始化 page3 函数
	function pageThird(){
		// 初始化page3
		$('.pageThirdTitle').animate({
			top:'0%',
			opacity:'0'
		},0,function(){
			$('.pageThirdCon').animate({
				top:'100%',
				opacity:'0'
			});
		});
	}
	// 初始化 page4 函数
	function pageForth(){
		// 初始化 page4
		$('.pageForthTitle').animate({
			top:'0%',
			opacity:'0'
		});
		$('.pageFourthCon').css({
			transform:'translateX(-1000px) rotateZ(-135deg)',
			opacity:'0'
		});
	}
	// 初始化 page5 函数
	function pageFifth(){
		$('.pageFifthTitle').animate({
			top:'0%',
			opacity:'0'
		});
		$('.fifthText').css({
			transform:'translateX(-700px) rotateZ(-135deg)',
			opacity:'0'
		});
		$('.fifthImg').css({
			transform:'translateX(800px) rotateZ(135deg)',
			opacity:'0'
		});
	}
	// 初始化 page6 函数
	function pageSixth(){
		$('.pageSixthTitle').animate({
			top:'0%',
			opacity:'0'
		});
		$('.sixCon').css({
			transform:'translateY(-800px) rotateZ(135deg)',
			opacity:'0'
		});
	}
	// 初始化page7 函数
	function pageSeventh(){
		$('.pageSeventhTitle').animate({
			top:'0%',
			opacity:'0'
		});
		$('.seventhCon').css({
			transform:'rotateZ(-180deg)',
			opacity:'0'
		});
	}
	// 初始化 page8
	function pageEighth(){
		$('.pageEighthTitle').css({
			top:'0%',
			opacity:'0'
		});
		$('.formCon').css({
			left:'-500px',
			opacity:'0'
		});
		$('.eighthCon').css({
			left:'500px',
			opacity:'0'
		});
	}
	// 初始化 page9
	function pageNineth(){
		$('.pageNinethTitle').css({
			top:'0%',
			opacity:'0'
		});
	}

	// page3 图片的 mouseover 事件
	function pageThirdMouse(){
		$('.conBox').on('mouseover',function(){
			$(this).css('width','486px').siblings().css('width','147px');
			$(this).children('.textB').show().siblings().hide();
			$(this).siblings().children('.textA').show().siblings().hide();

		});
	}
	// 调用函数
	pageThirdMouse();

	// page4 图片的 mouseover 事件
	function pageForthMouse(){
		$('.pageFourthCon a').on('mouseover',function(){
			$(this).find('.forthCon').css('bottom','0px');
		});
		$('.pageFourthCon a').on('mouseout',function(){
			$(this).find('.forthCon').css('bottom','-70%');
		});
	}
	pageForthMouse();

	// page6 的点击事件
	function pageSixClick(){
		var num = 0;
		var width = 930;
		// 左点击
		$('.leftBtn').on('click',function(){
			num--;
			if(num < 0){
				num = 2;
			}
			$('.sixthBox').css('left',-num * width + 'px');
		});
		// 右点击
		$('.rightBtn').on('click',function(){
			num++;
			if(num >= 3){
				num = 0;
			}
			$('.sixthBox').css('left',-num * width + 'px');
		});
	}
	pageSixClick();

	// page9 select选择变换
	function selectFn(){

		$('.placeSelect').change(function(){
			var sss = $('.placeSelect option:selected').text();
			if(sss == '济南'){
				$('.jinan').show();
				$('.weifang').hide();
			}else if(sss == '潍坊'){
				$('.weifang').show();
				$('.jinan').hide();
			}
		});

	}
	selectFn();

	// 处理右边的菜单点击事件
	function menuClickFn(){
		$('.arrowRight').on('click',function(){
			$('.manuCon').animate({
				right:'-108px'
			},500);
			$(this).hide().siblings().show();
		});
		$('.arrowLeft').on('click',function(){
			$('.manuCon').animate({
				right:'0'
			},500);
			$(this).hide().siblings().show();
		});
	}
	menuClickFn();

	// 菜单颜色变化
	function manuBgColorChange(index){
		// 获取 li 的长度
		var liLength = $('.manu li').length;
		// 初始化 li 的背景
		for(var i = 0;i < liLength;i++){
			$('.manu li').eq(i).css('background','none');
		}
		// 改变背景颜色
		$('.manu li').eq(index-1).css('background','rgb(222,205,175)');
		// li 的 mouse事件
		$('.manu li').on('mouseover',function(){
			$(this).css('background','rgb(222,205,175)');
		});
		$('.manu li').on('mouseout',function(){
			// 获取当前的 li 的index值
			var liIndex = $(this).index();
			if(liIndex != index-1){
				$(this).css('background','none');
			}else{
				$(this).css('background','rgb(222,205,175)');
			}

		});
	}

	// 处理分页变化
	function skipFn(){
		// 界面的跳转
		$('.GTSkip').on('click',function(){
			// 获取当前的 skip的下标
			var skipIndex = $(this).index();
			// 当前页面隐藏
			$('.pageCon').hide();
			// 跳转界面出现
			$('.skipCon').eq(skipIndex).show();
		});
	}
	skipFn();

});




















