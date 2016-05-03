 	<div id="wrapper-header">
        <header role="banner">	
			<div id="logo">
				<?php echo $this->Html->link($this->Html->image('wab_logo.png'), '/', array('escape' => false)); ?>
			</div>
			<div id="partenaires">
				<a href="http://www.goclecd.fr/?boblegob" target="_blank" class="partenaire"><?php echo $this->Html->image('GoclecdLogo.png', array('alt'=>'Partenaire Goclecd'));?></a>
				<a href="http://www.melty.fr/esport-club/" target="_blank" class="partenaire"><?php echo $this->Html->image('media.png', array('alt'=>'Partenaire Esport culb melty'));?></a>
				<a href="http://www.ouikos.com/fr/" target="_blank" class="partenaire"><?php echo $this->Html->image('ouikos-1433184643-1.png', array('alt'=>'Partenaire ouikos'));?></a>
				<a href="https://www.verygames.net/fr/" target="_blank" class="partenaire"><?php echo $this->Html->image('VeryGamesLogo.png', array('alt'=>'Partenaire VeryGames'));?></a>
			</div>
			
			<div id="login-wrapper">
				<ul class="login-box">
					<?php if($authUser!==null) {
						echo '<li class="login-signup">';
						echo $this->Html->link(
								'Déconnexion',
								['controller' => 'Users', 'action' => 'logout']
						);
						echo '</li>';
					} else {
						echo '<li class="login-signup">';
						echo $this->Html->link(
								'Inscription',
								['controller' => 'Users', 'action' => 'add']
						);
						echo '</li>';
						echo '<li class="login-signin">';
						echo $this->Html->link(
									'Connexion',
									['controller' => 'Users', 'action' => 'login']
							);}
					echo '</li>';
					?>
				 </ul>	
			</div>
		</header>	
		
		<nav role="main">  
            <ul id="navbar"> 
				<span id="navbar-left"></span>
					<li  id="select">
					<?php echo $this->Html->link($this->Html->image('menu/home.png'), '/', array('escape' => false)); ?>
					</li>
					<li class="menu1"><a href="programme.html">programme</a></li>
					<li class="menu1"><a href="replay.html">replay</a></li>
					<li class="menu1"><a href="emissions.html">émissions</a></li>
					<li class="menu1"><a href="streamers.html">streamers</a></li>
					<li class="menu1"><a href="videos.html">vidéos</a></li>
					<li class="menu1"><a href="forum.html">forum</a></li>
					<span id="navbar-right"></span>
					<li class="tab-social"><a href="#"><?php echo $this->Html->image('menu/mozilla-social.png', array('alt'=>'Reseau social mozilla'));?></a></li>	
					<li class="tab-social"><a href="#"><?php echo $this->Html->image('menu/chrome-social.png', array('alt'=>'Reseau social chrome'));?></a></li>	
					<li class="tab-social"><a href="#"><?php echo $this->Html->image('menu/twitter-social.png', array('alt'=>'Reseau social twitter'));?></a></li>
					<li class="tab-social"><a href="#"><?php echo $this->Html->image('menu/facebook-social.png', array('alt'=>'Reseau social facebook'));?></a></li>	
					<li class="tab-social"><a href="#"><?php echo $this->Html->image('menu/youtube-social.png', array('alt'=>'Reseau social youtube'));?></a></li>	
					<li class="tab-social"><a href="#"><?php echo $this->Html->image('menu/skype-social.png', array('alt'=>'Reseau social skype'));?></a></li>					
			</ul>			
		</nav>
	</div>