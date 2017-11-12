<!--Tab过去遮罩-->

		        function shade() {
		            var date_time = new Date();
		            if (date_time > new Date("2046/10/1 11:00:00")) {
		                document.getElementById("shande_1").className = "cp_shade1";
		                document.getElementById("btn1").className = "cp_btn_js";
		                document.getElementById("btn1").innerHTML = "<a href='http://smzdqiang.com/dataoke/' target='_blank'>&nbsp;<span id='times' style='display:none;'>1</span></a>";
		            }
		            if (date_time > new Date("2046/10/1 15:00:00")) {
		                document.getElementById("shande_2").className = "cp_shade2";
		                document.getElementById("btn2").className = "cp_btn_js";
		                document.getElementById("btn2").innerHTML = "<a href='http://smzdqiang.com/dataoke/' target='_blank'>&nbsp;<span id='times1' style='display:none;'>1</span></a>";
		
		            }
		            if (date_time > new Date("2046/10/1 21:00:00")) {
		                document.getElementById("shande_3").className = "cp_shade3";
		                document.getElementById("btn3").className = "cp_btn_js";
		                document.getElementById("btn3").innerHTML = "<a href='http://smzdqiang.com/dataoke/' target='_blank'>&nbsp;<span id='times2' style='display:none;'>1</span></a>";
		            }
		        }

		 <!--倒计时-->

	        function fresh() {
	            var endtime = new Date();
	            var endcount = document.getElementsByTagName('abbr').length;
	            for (var s = 0; s < endcount; s++) {
	                endtime[s] = new Date(document.getElementsByTagName('abbr')[s].innerHTML);
	            }
	            var nowtime = new Date();
	            var leftsecond = new Date();
	            for (var i = 0; i < endcount; i++) {
	                leftsecond[i] = parseInt((endtime[i].getTime() - nowtime.getTime()) / 1000);
	            }
	            var d = new Array();
	            var h = new Array();
	            var m = new Array();
	            var s = new Array();
	            for (var j = 0; j < endcount; j++) {
	                d[j] = parseInt(leftsecond[j] / 3600 / 24);
	                h[j] = parseInt((leftsecond[j] / 3600) % 24);
	                m[j] = parseInt((leftsecond[j] / 60) % 60);
	                s[j] = parseInt(leftsecond[j] % 60);
	            }
	            //document.getElementById("times").innerHTML=__h+"小时"+__m+"分"+__s+"秒";
	            for (var k = 0; k < endcount; k++) {
	                if (d[k] == 0) {
	                    if (k == 0) {
	                        document.getElementById("times").innerHTML = h[k] + "小时" + m[k] + "分" + s[k] + "秒";
	                    }
	                    else {
	                        document.getElementById("times" + k).innerHTML = h[k] + "小时" + m[k] + "分" + s[k] + "秒";
	                    }
	                }
	                else {
	                    if (k == 0) {
	                        document.getElementById("times").innerHTML = d[k] + "天" + h[k] + "小时" + m[k] + "分" + s[k] + "秒";
	                    }
	                    else {
	                        document.getElementById("times" + k).innerHTML = d[k] + "天" + h[k] + "小时" + m[k] + "分" + s[k] + "秒";
	                    }
	                }
	            }
	            for (var l = 0; l < endcount; l++) {
	                if (leftsecond[l] <= 0) {
	                    if (l == 0) {
	                        document.getElementById("btn1").className = "cp_btn_ks";
	                        document.getElementById("btn1").innerHTML = "<a href='http://www.smzdqiang.com/' target='_blank'>&nbsp;<span id='times' style='display:none;'>1</span></a>";
	                    }
	                    else if (l == 1) {
	                        document.getElementById("btn2").className = "cp_btn_ks";
	                        document.getElementById("btn2").innerHTML = "<a href='http://www.smzdqiang.com/' target='_blank'>&nbsp;<span id='times1' style='display:none;'>1</span></a>";
	                    }
	                    else if (l == 2) {
	                        document.getElementById("btn3").className = "cp_btn_ks";
	                        document.getElementById("btn3").innerHTML = "<a href='http://www.smzdqiang.com/' target='_blank'>&nbsp;<span id='times2' style='display:none;'>1</span></a>";
	                    }
	                }
	            }
	            shade();
	        }
	        fresh();
	        var sh;
	        sh = setInterval(fresh, 1000);
