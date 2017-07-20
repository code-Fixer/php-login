<!DOCTYPE html>
<html>
<head>
	<title>Welcome</title>

	<script type="text/javascript" src="./js/require.js"></script>
	<script typte="text/javascript">
		requirejs.config({baseUrl: 'http://localhost/youtube_login/js/'});
	</script>

</head>
<body>

<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600' rel='stylesheet' type='text/css'>
<link href="//netdna.bootstrapcdn.com/font-awesome/3.1.1/css/font-awesome.css" rel="stylesheet">
<link href="./css/main.css" rel="stylesheet">

<div class="testbox">
  <h1>Login</h1>
  <div id="login_form">
	  <div v-if="!loggedIn">
		  <form v-on:submit="handelLogin($event)" action="">
		  <hr>
		  <label id="icon" for="email"><i class="icon-envelope "></i></label>
		  <input type="text" name="email"  placeholder="Email" required/>
		  <label id="icon" for="password"><i class="icon-shield"></i></label>
		  <input type="password" name="password"  placeholder="Password" required/>
		  <input type="submit" value="Login" href="#" class="button">
		  <div class="msg">
		   	{{msg}}
		   </div>
		  </form>
		 </div>
		 <div v-else class="df">
	  		Hello {{userData.name}}
	  	</div>
	  </div>
</div>

</body>

<script type="text/javascript">
	
	(function(a){
		require(['jquery','vue'],function($,vue){
			login_form = new vue({
				el : "#login_form",
				data : {
					msg : "",
					loggedIn : false,
					userData : {}
				},
				methods : {
					handelLogin : function(e){
						e.preventDefault();
						var self = this;
						$.ajax({
							url : "./lib/login.php",
							data : $(e.target).serialize(),
							dataType: "JSON",
							method : "POST",
							success : function(e){
								self.msg = e.msg;
								if(e.status == true){
									self.loggedIn = true;
									self.userData = e.data;
								}
							}
						})
						return false;
					}
				}
			})
		});
	})(this);

</script>

</html>