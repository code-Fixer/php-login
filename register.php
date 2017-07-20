<!DOCTYPE html>
<html>
<head>
	<title>Register user here</title>
	
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
  <h1>Registration</h1>

  <form id="reg_form" v-on:submit="handelSubmit($event);">
      <hr>
    <div class="accounttype">
      <input type="radio" value="3" id="radioOne" name="account" checked/>
      <label for="radioOne" class="radio" chec>Personal</label>
      <input type="radio" value="4" id="radioTwo" name="account" />
      <label for="radioTwo" class="radio">Company</label>
    </div>
  <hr>
  <label id="icon" for="email"><i class="icon-envelope "></i></label>
  <input type="text" name="email" id="name" placeholder="Email" required/>
  <label id="icon" for="name"><i class="icon-user"></i></label>
  <input type="text" name="name" id="name" placeholder="Name" required/>
  <label id="icon" for="password"><i class="icon-shield"></i></label>
  <input type="password" name="password" id="name" placeholder="Password" required/>
  <div class="gender">
    <input type="radio" value="2" id="male" name="gender" checked/>
    <label for="male" class="radio" chec>Male</label>
    <input type="radio" value="1" id="female" name="gender" />
    <label for="female" class="radio">Female</label>
   </div> 
   <p>By clicking Register, you agree on our <a href="#">terms and condition</a>.</p>
   <input type="submit" value="Register" href="#" class="button">
   <div class="msg">
   	{{msg}}
   </div>
  </form>
</div>

<script type="text/javascript">
	
	
		require(['jquery','vue'],function($,vue){
			reg_form = new vue({
				el : '#reg_form',
				data : {
					msg : ""
				},
				methods:{
					handelSubmit : function(e){
						e.preventDefault();
						var self = this;
						$.ajax({
							url : "./lib/r.php",
							data : $(e.target).serialize(),
							dataType: "JSON",
							method : "POST",
							success : function(e){
								self.msg = e.msg;
								if(e.status == true)
									window.location("http://localhost/youtube_login/");
							}
						})
						return false;
					}
				}
			})
		});


</script>

</body>
</html>
