
	<body>
	<nav class="navtop">
        <div>
            <h1>Hype Energy Drinks</h1>
            <a href="user/register"><i class="fas fa-user-plus"></i>Register</a>
        </div>
	</nav>


		<div class="login">
			<h1>Login</h1>
			<?php if(!empty($this->data['error'])) { ?>            
				<div class="alert alert-danger">
				<?php foreach($this->data['error'] as $error){
						echo $error;
				} ?>
				</div>
    		<?php } ?>
			<form action="user/login" method="post">
				<input type="hidden" name="token" value="<?=$_SESSION['csrf_token']?>"/>
				<label for="username">
					<i class="fas fa-user"></i>
				</label>
				<input type="text" name="username" placeholder="Username" id="username" required>
				<label for="password">
					<i class="fas fa-lock"></i>
				</label>
				<input type="password" name="password" placeholder="Password" id="password" required>
				<input type="submit" value="Login">	
			</form>			
		</div>
