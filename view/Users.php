
  <div class="loggedin">
		<nav class="navtop">
			<div>
				<h1>Hype Energy Drinks</h1>
				<a href="user/logout"><i class="fas fa-sign-out-alt"></i>Logout</a>
			</div>
		</nav>
		<div class="content">
		
		

    <table class="table">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Username</th>
          <th scope="col">Email</th>      
        </tr>
      </thead>
      <tbody>
        <?php
        $i=1;
        foreach($this->data['user'] as $user){
        ?>
                <tr>
                    <th scope="row"><?php echo $i++; ?></th>
                    <td><?php echo $user->username;?></td>
                    <td><?php echo $user->email; ?></td>
                </tr>
        <?php    } ?>
        
        
      </tbody>
    </table>
    </div>
  </div>
