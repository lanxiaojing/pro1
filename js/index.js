$.ajax({//����indexʱ�������жϵ�¼��
	url:"#"+"?tm=" + Math.random(),
	type:"post",
	success:function(data){
		if(data!=""){//���ء���Ϊδ��¼�������û������ѵ�¼
			welcome(data);//data��ʽ��data=["username":"xx","favorite":14,"follow":4,"message":5]
		}
	}
});
function welcome(data){//�ѵ�¼���޸�navbar
	$('.navbar-right>li').remove();
	$('.navbar-right').append("<div class='navbar-brand pull-right'><a href='#'>"+'��ӭ�㣡'+data.username+"</a></div>");
	$('#userInfoList>div').remove();
	$('#userInfoList').append("<a href='#' class='list-group-item'>�ҵ��ղ�<span class='badge'>"+data.favorite+"</span></a>" +//a���ӵ�ַΪ�û���Ϣ���棬δ���
		                      "<a href='#' class='list-group-item'>�ҹ�ע����<span class='badge'>"+data.follow+"</span></a>" +//��ʱdataӦ��url��
		                      "<a href='#' class='list-group-item'>�ҵķ�˿<span class='badge'>"+data.fance+"</span> </a>" +
		                      "<a href='#' class='list-group-item'>˽��<span class='badge'>"+data.message+"</span></a>")
}

$("#hottab").click(function(){//���ŵ�tab���ʱ������
	tabAjax('hot',#)//#���������ַ
});
$("#friendtab").click(function(){//����tab
	tabAjax('friend',##)//##��#��������ͬ��phpurl
});
function tabAjax(tabContainerId,PHPUrl){
	$.ajax({
		url: PHPUrl+"?tm="+Math.random(),
		type:"post",
		data: tabContainerId,
		success:function(data){//data��ʽΪ����Ϊ�գ���data=[""];����Ϊ�գ���data=["username":["X","XX","XXXX"],"imgurl":["X,XXX,XXX,XXXX","S,SSS,SS",""],"word":["AAA","QQQQ","WWW"]]
			var json=eval('('+data+')');//�˴�����userͷ������δ���
			if(json ==""){
				$("#"+id).append("<div class='alert alert-info' role='alert'>����ʲôҲû�Шr(�s���t)�q</div>");
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
		btnName = "<button type='button' class='btn btn-xs btn-danger pull-right'>"+'�ӹ�ע'+"</button>";//���Ǻ��Ѷ�̬�ɽ����˼ӹ�ע
	}
	else{
		btnName =  "<button type='button' class='btn btn-xs btn-info pull-right'>"+'ȡ����ע'+"</button>";//���ѿ�ȡ��
	}
	for(i=0;i<data.username.length;i++){
		html += "<div class='media' style='margin: 20px;'>"
			+ "<div class='media-left'>"
			+ "	<a href='#'><img class='img-circle img-responsive' style='width: 50px;height: 50px' src=''></a>"//�û�ͷ������δ���
			+ "</div>"
			+ "<div class='media-body'>"
			+ "<div class='media-heading'><a href='#'>" +data.username[i] + "</a>" //����û�����ת��������ҳ���ܣ��Ƿ���data�м���userurl����
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
					p += "<img style='width: 30%;height:auto;' src='imgUrlArr[j]'>";//��img��ʾ����ʽ�������ƣ���ͼ���������
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
