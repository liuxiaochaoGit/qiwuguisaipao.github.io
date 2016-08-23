//加载完毕再执行
$(document).ready(mainFn);
//主函数
function mainFn(){
	//页眉的点击事件
	$('#navSlider').on('click',function(){
		$('#navA').toggle(1000);
	});
	//以下是页脚
	//鼠标移入email事件
	$('footer a img:even').each(overFn);
	function overFn(){
		$(this).on('mousemove',function(){
			$(this).hide().siblings().show(0,outFn);
		});
	}
	//鼠标移出事件
	function outFn(){
		$(this).on('mouseout',function(){
			$(this).hide().siblings().show();
		});
	}

}