<script language="javascript" src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
<script>
  window.fbAsyncInit = function() {
    FB.init({
      appId      : '1801393373482924',
      xfbml      : true,
      version    : 'v2.8',
	  status	: true
    });
    FB.AppEvents.logPageView();
  };

  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "//connect.facebook.net/en_US/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));
   
$( document ).ready(function() {

});

function getPost(){
	postid = $("#postid").val().trim();
	limit = $("#limit").val().trim();
	if (postid && limit){
		FB.getLoginStatus(function(response) {
	
		  if (response.status === 'connected') {
				   FB.api(
					  '/'+postid+'/reactions',
					  'GET',
					  {"limit":limit},
					  function(response) {
						  
						  var csv = ConvertToCSV(response.data) 
							var downloadLink = document.createElement("a");
							var blob = new Blob(["\ufeff", csv],{encoding:"UTF-8",type:"text/plain;charset=UTF-8"});
							var url = URL.createObjectURL(blob);
							downloadLink.href = url;
							downloadLink.download = "reactions.csv";
						
							document.body.appendChild(downloadLink);
							downloadLink.click();
							document.body.removeChild(downloadLink);
						 // window.open("data:text/csv;charset=utf-8," + output);
					  }
					);
					
					FB.api(
					  '/'+postid+'/comments',
					  'GET',
					  {"limit":limit},
					  function(response) {
						  
						  var csv = ConvertToCSV(response.data) 
							var downloadLink = document.createElement("a");
							var blob = new Blob(["\ufeff", csv],{encoding:"UTF-8",type:"text/plain;charset=UTF-8"});
							var url = URL.createObjectURL(blob);
							downloadLink.href = url;
							downloadLink.download = "comments.csv";
						
							document.body.appendChild(downloadLink);
							downloadLink.click();
							document.body.removeChild(downloadLink);
						 // window.open("data:text/csv;charset=utf-8," + output);
					  }
					);
	
		  }
		  else {
			FB.login();
		  }
		});
	}

}


 function ConvertToCSV(objArray) {
            var array = typeof objArray != 'object' ? JSON.parse(objArray) : objArray;
            var str = '';

            for (var i = 0; i < array.length; i++) {
                var line = '';
                for (var index in array[i]) {
                    if (line != '') line += ','

                    line += array[i][index];
                }

                str += line + '\r\n';
            }

            return str;
        }
</script>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
   
    <title>Post Summary</title>
  </head>
  <body>      
	<div>
    ตย. Link Post นี้ https://www.facebook.com/HearthstoneTH/photos/a.1584013521914103.1073741828.1577581089224013/<font color="#FF0000">1722750501373737</font>/?type=3&theater 
    <br/> 
    Post ID คือ <font color="#FF0000">1722750501373737</font> :     <br/>
    </br>
    หมายเลข PostID   <input type="text" name ="postid" id="postid">    
    <br/>    จำนวนคนที่ต้องการดึง ( ใส่เผื่อๆไปสัก 10000 ก็ได้) <input type="text" name="limit" id="limit">
    <br/>    

	<input type="button" onClick="getPost();" value="Download Data">
		<div id="result"></div>
    </div>	

  </body>
</html>
