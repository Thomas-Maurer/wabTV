	<div ng-controller="ChatController" id="chat">
		<div class="titre">
			<h1>
				<a href="">
					<span>Discussion instantanée</span>
					<?php echo $this->Html->image('menu_blocs/mini-bob-menu.png', array('alt'=>"Minibob"));?>
				</a>
			</h1>
		</div>

		<div id="chatarea">
			<ul class="messages">
				<!-- add a class to message to apply a specific style .yourmessage : a message you posted .quotemessage : a message containing your pseudo -->
				<li class="message" ng-repeat="message in messages">
					<span class="time">{{message.date}}<br/>
						<?php
						echo $this->Html->image('chat/whisper.jpg', array('class' => 'whisperbutton','alt'=>'whisper'));
						echo $this->Html->image('chat/block.jpg', array('class' => 'blockbutton','alt'=>'block', 'ng-click'=>'userMute(message.userName)'));
						echo"\n";
						?>
					</span>
					<span class="pseudo" style="color:red;">{{message.userName}}</span>
					<span class="message-text" ng-show="message.trusted === false">{{message.message}}</span>
					<span class="message-text" ng-show="message.trusted" ng-bind-html="trustAsHtml(message)"></span>
				</li>
			</ul>

			<div id="footerchat">
				<?php if(isset($loggedIn)) {
					echo '<form ng-submit="sendMessage()">
				<input id="sendmessage" type="text" ng-model="textMessage" placeholder="Your text here" autocomplete="off"/>';
					echo $this->Form->submit("chat/send.png", array("value"=>"Submit", "id"=>"sendmessagebutton"));
					echo "</form>"."\n";
				}else { ?>
				<textarea disabled="disabled" id="sendmessage_tint" ng-model="textMessage" placeholder="Vous devez vous connectez pour accéder au chat !"/></textarea>
				<?php
				echo $this->Html->link($this->Html->image('chat/connect.png'), '/user/login', array('id'=>'sendmessagebutton', 'escape' => false));
				?>
				<?php } ?>
				<?php echo $this->Html->image('chat/smiley.jpg', array('id' => 'smileys','alt'=>'smileys'));
				echo $this->Html->image('chat/settings.png', array('id' => 'chatsettings','alt'=>'chatsettings', 'ng-click'=>'chatPopup = chatPopup === "parameter" ? "" : "parameter";'));
				echo $this->Html->image('chat/message.png', array('id' => 'chatmessage','alt'=>'chatmessage', 'ng-click'=>'chatPopup = chatPopup === "whisp" ? "" : "whisp";')); ?>
			</div>
			<div id="chatParameters" ng-show="chatPopup === 'parameter'">
				<?php echo $this->Html->image('chat/close.png', array('class' => 'close', 'ng-click' => 'chatPopup = "";')); ?>		
				<h2>Paramètres</h2>
				<hr/>
				<span class="chatParameter">
					couleur du pseudo
					<input id="colorChoice" colorpicker="rgb" ng-model="rgbPicker.color" type="text" ng-style="{color:rgbPicker.color}"/>
				</span>
				<span class="chatParameter">
					débloquer
					<select id="blockedUsers">
						<option ng-repeat="option in mutedUsers" value="{{option.id}}">{{option.username_muted}}</option>
					</select>
					<button ng-click="userUnmute(option.username_muted)">ok</button>
				</span>
			</div>
			<div id="chatWhisp" ng-show="chatPopup === 'whisp'">
				<?php echo $this->Html->image('chat/close.png', array('class' => 'close', 'ng-click' => 'chatPopup = "";')); ?>
				<h2>Messsages privés</h2>
				<hr/>
				<ul id="whisperList">
					<li class="whisperSummary" ng-click="showCurrentPM($index)" ng-repeat="privateMessage in privateMessages track by $index">
						<span class="pseudo" style="color:red;">{{privateMessage.nameconversation}}</span>
						<span class="lastMessage">{{privateMesage.conversation[privateMessage.conversation.length-1].message}}</span>
						<?php
						echo $this->Html->image('chat/delete.png', array('class' => 'deleteWhisp','alt'=>'delete', 'ng-click'=>'deletePrivateMessages($index);'));
						?>
					</li>
				</ul>
			</div>
		</div>
	
		<div id="chatPM" ng-show="showPM">
			<?php echo $this->Html->image('chat/close.png', array('class' => 'close', 'ng-click' => 'showPM = false;')); ?>		
			<h2 id="pseudoPM">{{privateMessagesCurrent.nameconversation}}</h2>
			<hr/>
			<div id="chatAreaPM">
			<ul class="messages">
				<li class="message" ng-repeat="conversation in privateMessagesCurrent.conversation track by $index">
					<span class="time">{{conversation.date}}<br/>
					</span>
					<span class="pseudo" style="color:red;">{{conversation.username}}</span>
					<span class="message-text">{{conversation.message}}</span>
					
				</li>
			</ul>
			<div id="footerChatPM">
				<?php if(isset($loggedIn)) {
						echo '<form ng-submit="sendPrivateMessage()">
						<input id="sendmessage" type="text" ng-model="textMessage" placeholder="Your text here" autocomplete="off"/>';
					echo $this->Form->submit("chat/send.png", array("value"=>"Submit", "id"=>"sendmessagebutton"));
						echo "</form>"."\n";
					}else {
						echo '<form ng-submit="sendMessage()">
						<input disabled="disabled" id="sendmessage" type="text" ng-model="textMessage" placeholder="Your text here"/>';
						echo "</form>"."\n";
					} 
				?>
				<?php echo $this->Html->image('chat/smiley.jpg', array('id' => 'smileys','alt'=>'smileys')); ?>
			</div>
			</div>
		</div>
	</div>

