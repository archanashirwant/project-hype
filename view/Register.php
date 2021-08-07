<nav class="navtop">
        <div>
            <h1>Hype Energy Drinks</h1>
            <a href="user/login"><i class="fas fa-sign-in-alt"></i>Login</a>
        </div>
</nav>


<div class="register">    

    <h1>Register</h1>
    <?php if(!empty($this->data['error'])) { ?>
            
            <div class="alert alert-danger">
            <?php foreach($this->data['error'] as $error){
                    echo $error;
             } ?>
            </div>
    <?php } ?>
    <form action="user/register" id="registrationForm" method="post" autocomplete="off" >
        <input type="hidden" name="token" value="<?= $_SESSION['csrf_token']; ?>"/>
        <label for="username">
            <i class="fas fa-user"></i>
        </label>
        <input type="text" name="username" placeholder="Username" id="username" required>
        <label for="password">
            <i class="fas fa-lock"></i>
        </label>
        <input type="password" name="password" placeholder="Password" id="password" required pattern="(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{6,}" 
        title="Password must contain at least one number, one lowercase and one uppercase letter
               must be  atleast six characters long">
        <label for="confirm_password">
            <i class="fas fa-lock"></i>
        </label>
        <input type="password" name="confirm_password" placeholder="Confirm Password" id="confirm_password" required class="form-control form-control-sm"  onkeyup= "validatePassword();">          
        <label for="email">
            <i class="fas fa-envelope"></i>
        </label>
        <input type="email" name="email" placeholder="Email" id="email" required>
        <input type="submit" value="Register">
            
    </form>

</div>
