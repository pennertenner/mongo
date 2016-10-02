var postTemp="<div id=\"post\" class=\"col-md-12\">\
<div id=\"posthead\" style=\"width: 100%; float:left; height: 60px; background-color: #87CEEB;\">\
<img src=\"{{user.0.picture}}\" style=\"width 60px; height: 60px; float: left\"/>\
<div style=\"height: 50%; color: blue; font-size: 13pt; margin-left: 5px\">{{user.0.name}}</div>\
<div style=\"height: 50%; font-size: 10pt; color:grey\">{{date}}</div>\
</div>\
<div id=\"content\" style=\"width:100%; float:left; font-size:15pt; margin-bottom: 5px\">\
{{inhalt}}\
</div>\
<div id=\"tags\" style=\"color: grey; font-size: 9pt; width: 100%; float:left; margin-bottom: 5px\">\
{{#each tags}}<a style=\"color: grey\" href=\"http://192.168.120.1/mongo/ajax-mongo.php?action=getpostsbytag&tag={{this}}\" onclick=\"tagClick(this);return false;\"> {{this}} </a> {{/each}}\
<hr></hr>\
</div>\
</div>";


var ServerIp = "192.168.120.1";

var template = Handlebars.compile(postTemp);

var tagClick = function(el){
	//alert(el.href);
	$.ajax({
			url:el.href,
			success:function(res){
				//posts div leeren und mit neuem inhalt fuellen
				$("#posts").empty();
				var count = 0;

				$.each(JSON.parse(res), function(i, item){
					item.date = convertDate(item);
					var newtemp = template(item);
					var newpost = document.createElement("div");
					newpost.innerHTML = newtemp;
					$("#posts").append(newpost);
					count++;
				});
				if(count == 0){
					$("#posts").html("Leider keine Posts vorhanden");
				}
				window.scrollTo(0,0);
			},
			error:function(){
				$("#posts").html("Fehler beim laden der Posts");
			}
	});
}

var newPost = function(el){
	var newname = $("#newname").val();
	var newpost = $("#newcontent").val();
	var newtags = $("#newtags").val();

	$.post("http://"+ ServerIp + "/mongo/ajax-mongo.php?action=createPost",
		{
			name:newname,
			content:newpost,
			tags:newtags
		},
		function(data, status){
			alert("Neuen Post angelegt");
			$("#newname").val("");
			$("#newcontent").val("");
			$("#newtags").val("");
			allPosts();

		}
	);
}

var searchPost = function(el){
	var search = $("#search").val();
	$.get("http://"+ ServerIp + "/mongo/ajax-mongo.php?action=getPostsByContent",
		{
			content:search
		},
		function(data, status){
			$("#posts").empty();
			var count = 0;
			$.each(JSON.parse(data), function(i, item){
				item.date = convertDate(item);
				var newtmp = template(item);
				var newpost = document.createElement("div");
				newpost.innerHTML = newtmp;
				$("#posts").append(newpost);
				count++;
			});
			if(count == 0){
				$("#posts").html("Leider keine Posts vorhanden");
			}
			window.scrollTo(0,0);
		}
	);
}


var allPosts = function(){
	$.ajax({
		url:"http://"+ ServerIp + "/mongo/ajax-mongo.php?action=getPosts",
		success:function(res){
			//alert(res);
			$("#posts").empty();
			$.each(JSON.parse(res), function(i, item){
				item.date = convertDate(item);

				var newres = template(item);
				var newpost = document.createElement("div");
				newpost.innerHTML = newres;
				$("#posts").append(newpost);
			});
			window.scrollTo(0,0);
		}
	});
}


$(document).ready(function(){
	allPosts();
});

var convertDate = function(item){
	var date = new Date(item.date * 1000);
	var day = "0" + date.getDate();
	var month = "0" + (date.getMonth()+1);
	var year = date.getFullYear();
	var hours = date.getHours();
	var minutes = "0" +  date.getMinutes();
	return day.substr(-2) + "." + month.substr(-2) + "." + year + " " + hours + ":" + minutes.substr(-2);
}


