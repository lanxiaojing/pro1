$.ajax({//加载index时发请求判断登录否
	url:"#"+"?tm=" + Math.random(),
	type:"post",
	success:function(data){
		if(data!=""){//返回“”为未登录，返回用户名则已登录
			welcome(data);//data格式：data=["username":"xx","favorite":14,"follow":4,"message":5]
		}
	}
});
function welcome(data){//已登录则修改navbar
	$('.navbar-right>li').remove();
	$('.navbar-right').append("<div class='navbar-brand pull-right'><a href='#'>"+'欢迎你！'+data.username+"</a></div>");
	$('#userInfoList>div').remove();
	$('#userInfoList').append("<a href='#' class='list-group-item'>我的收藏<span class='badge'>"+data.favorite+"</span></a>" +//a链接地址为用户信息界面，未完成
		                      "<a href='#' class='list-group-item'>我关注的人<span class='badge'>"+data.follow+"</span></a>" +//届时data应加url键
		                      "<a href='#' class='list-group-item'>我的粉丝<span class='badge'>"+data.fance+"</span> </a>" +
		                      "<a href='#' class='list-group-item'>私信<span class='badge'>"+data.message+"</span></a>")
}

$("#hottab").click(function(){//热门的tab点击时发请求
	tabAjax('hot',#)//#代表请求地址
});
$("#friendtab").click(function(){//好友tab
	tabAjax('friend',##)//##与#是两个不同的phpurl
});
function tabAjax(tabContainerId,PHPUrl){
	$.ajax({
		url: PHPUrl+"?tm="+Math.random(),
		type:"post",
		data: tabContainerId,
		success:function(data){//data格式为：若为空，则：data=[""];若不为空，则：data=["username":["X","XX","XXXX"],"imgurl":["X,XXX,XXX,XXXX","S,SSS,SS",""],"word":["AAA","QQQQ","WWW"]]
			var json=eval('('+data+')');//此处还有user头像问题未解决
			if(json ==""){
				$("#"+id).append("<div class='alert alert-info' role='alert'>这里什么也没有╮(╯▽╰)╭</div>");
			}
			else {
				tabinner(tabContainerId, json);
			}
		}
	})
}
function tabinner(tabContainerId,data){
	var btnName = '';
	if(tabContainerId == 'hot'){
		btnName = "<button type='button' class='btn btn-xs btn-danger pull-right'>"+'加关注'+"</button>";//若非好友动态可将此人加关注
	}
	else{
		btnName =  "<button type='button' class='btn btn-xs btn-info pull-right'>"+'取消关注'+"</button>";//好友可取关
	}
	for(i=0;i<data.username.length;i++){
		html += "<div class='media' style='margin: 20px;'>"
			+ "<div class='media-left'>"
			+ "	<a href='#'><img class='img-circle img-responsive' style='width: 50px;height: 50px' src=''></a>"//用户头像问题未解决
			+ "</div>"
			+ "<div class='media-body'>"
			+ "<div class='media-heading'><a href='#'>" +data.username[i] + "</a>" //点击用户名跳转至好友主页功能：是否在data中加入userurl键？
			+ btnName
			+ "</div>"
			+ "<p>"+data.word[i]+"</p>"
			+ "<div class='center-block'>"
			+ imgoutput(i)
			+ "</div>"
			+ "</div>"
			+ "</div>"
			+ "<div class='parting-line'></div>";
	}
	function imgoutput(i){
		var p='';
		if(data.imgurl[i]!='')
			if (data.imgurl[i].indexOf(",") >= 0) {
				var imgUrlArr = [];
				imgUrlArr =data.imgurl[i].split(",");
				for (var j = 0; j < imgUrlArr.length; j++) {
					p += "<img style='width: 30%;height:auto;' src='imgUrlArr[j]'>";//对img显示的样式还可完善，裁图问题待讨论
				}
				return p;
			}
			else {
				return p;
			}
		else return p;
	}
	document.getElementById(tabContainerId).append(html);
};
