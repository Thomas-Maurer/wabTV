
app.controller('ChatController', ['$scope', 'socket', '$http', '$q', 'serverUrl', '$sce', function($scope, socket, $http, $q, serverUrl, $sce) {
// Socket listeners

  $scope.chatPopup = "";
  $scope.showPM = false;
  $scope.smileyInMessage = false;

  $scope.ConnectedUser = '';
  $scope.textMessage = '';
  $scope.privateMessagesCurrent = {};
  $scope.privateMessages = [];
  //Todo maybe add dynamic max chat messages ?
  $scope.maxChatMessages = 144;
  $scope.globalBannedUsers = [];
  $scope.connectedUsers = [];
  $scope.smileysAvailable = [];
  $scope.mutedUsers = [];
  $scope.messages = [
    {date: '05:53', userIcon: '' ,userName: 'boblegob', message: 'test Chat History who occupy 3 lines hahahahaha   ahahahahahahha ahahhaha', trusted: false },
    {date: '05:55', userIcon: '' ,userName: 'Robert', message: 'test Chat History2', trusted: false },
    {date: '05:59', userIcon: '' ,userName: 'Jean-michel', message: 'test Chat History3 who occupy 2 lines hahaha', trusted: false },
    {date: '05:59', userIcon: '' ,userName: 'Jackie', message: 'test Chat History4', trusted: false }
  ];
  
  //Update our chat History if we receive a new message
  socket.on('newMessageToChat', function (data) {
    if (!$scope.checkBannedLocal(data)) {
	  var isScrolledBottom = [];
	  $(".messages").each(function(index) {
  	    isScrolledBottom[index] = (this.scrollTop + this.offsetHeight >= this.scrollHeight);
	  });
      if ($scope.messages.length < $scope.maxChatMessages) {
        $scope.messages.push(data);
        $scope.$apply($scope.messages);
      } else {
        $scope.messages.splice(0,1);
        $scope.messages.push(data);
        $scope.$apply($scope.messages);
      }
	  $(".messages").each(function(index) {
	  if (isScrolledBottom[index]) {
		  this.scrollTop = this.scrollHeight - this.offsetHeight;
		}
	  });
    }
  });

  socket.on('newUserToChat', function (data) {
    $scope.connectedUsers = data;

    $("#sendmessage").asuggest($scope.connectedUsers, {
      'delimiters': '@:, /w :',
      'minChunkSize': 2
    });
  });

  socket.on('whisperToUser', function (data) {
    console.log(data);
    $scope.receivePm(data);
  });
  socket.on('sendWhisperToUser', function (data) {
    console.log(data);
    $scope.sendPm(data);
  });


  //Load All data we need before load other function
  $scope.init = function () {
    var defer = $q.defer();
    $scope.getConnectedUserInfo().then(function (data) {
      $scope.ConnectedUser = data.data;
      if ($scope.ConnectedUser.muted_users !== undefined) {
        $scope.mutedUsers = $scope.ConnectedUser.muted_users;
      }
      if ($scope.ConnectedUser.private_messages_users !== undefined) {
        $scope.privateMessages = $scope.ConnectedUser.private_messages_users;

      }
      if ($scope.ConnectedUser.smileys_user !== null && $scope.ConnectedUser.smileys_user !== undefined) {
        $scope.smileysAvailable = angular.fromJson($scope.ConnectedUser.smileys_user.smileys_available)
      }
      defer.resolve(true);
  });
    return defer.promise;
  };

  //Return user information
  $scope.getConnectedUserInfo = function () {
    var defer = $q.defer();
    $http({
      method: 'GET',
      url: serverUrl +'/users/getCurrentUser'
    }).then(function successCallback(response) {
      defer.resolve(response);
    }, function errorCallback(response) {
      defer.resolve(response);
    });
    return defer.promise;
  };


  //After we load all the data we can call Sendmessage
  $scope.init().then(function (data) {
    if (data == true) {
      //Function to send a message to the server then broadcast it to other in chatRoom
      //Params : message, user, date
      $scope.sendMessage = function () {
        var message,
          date;
        message = "";
        date = new Date();
        if ($scope.textMessage !== "") {
          $scope.checkIfallowToUseSmiley();
          message = $scope.textMessage;
            socket.emit('sendMessageToChat', {
              date: date.getHours() + ':' + date.getMinutes(),
              userIcon: '' ,
              userName: $scope.ConnectedUser.username,
              message: message,
              trusted: $scope.smileyInMessage
            });
          //todo waiting for real avatar system
        }
        $scope.smileyInMessage = false;
        $scope.textMessage = '';
      };
      //When a user connect to the chat send a notification to the server
      socket.emit('newUserToChat', $scope.ConnectedUser.username);
    }

  });

  $scope.receivePm = function (newMessage) {
    var result = {},
        foundPrivateMessage,
        idFoundPrivateMessage,
        currentConversation;
    result.user_from_pm = newMessage.username;
    result.new_message = newMessage.message;
    result.user_to_pm = $scope.ConnectedUser.id;

    foundPrivateMessage = _.findWhere($scope.privateMessages, {
      'user_id': $scope.ConnectedUser.id,
      'nameconversation': newMessage.username }
    );


    if(foundPrivateMessage !== undefined){
      idFoundPrivateMessage = _.findIndex($scope.privateMessages, foundPrivateMessage);
      currentConversation = $scope.privateMessages[idFoundPrivateMessage].conversation;

      currentConversation.push({
        'username': newMessage.username,
        'message': newMessage.message
      });

      $scope.privateMessages[idFoundPrivateMessage].conversation = currentConversation;
    } else {
      $scope.privateMessages.push({
        'nameconversation': result.user_from_pm,
        'user_id': $scope.ConnectedUser.id,
        'user_to_pm': $scope.ConnectedUser.id,
        'user_from_pm': newMessage.username,
        'conversation': [{
          'username' : newMessage.username,
          'message' : newMessage.message
        }]
      });
    }


    $http({
      method: 'POST',
      url: serverUrl +'/users/receivepm',
      data: result
      //todo add Flash message for success and failure !
    }).then(function successCallback(response) {
      console.log('user Successully pm');
      console.log(response);
    }, function errorCallback(response) {
      console.log('user failed pm');
      console.log(response);
    });
  };

  $scope.sendPm = function (newMessage) {
    var result = {},
        foundPrivateMessage,
        idFoundPrivateMessage,
        currentConversation;
    result.user_from_pm = $scope.ConnectedUser.id;
    result.new_message = newMessage.message;
    result.user_to_pm = newMessage.username;

    foundPrivateMessage = _.findWhere($scope.privateMessages, {
      'user_id': $scope.ConnectedUser.id,
      'user_to_pm': newMessage.username }
    );


    if(foundPrivateMessage !== undefined){


    } else {
      $scope.privateMessages.push({
        'nameconversation': newMessage.username,
        'user_to_pm': newMessage.username,
        'user_id': $scope.ConnectedUser.id,
        'conversation': [{
          'username' : $scope.ConnectedUser.username,
          'message' : newMessage.message
        }]
      });
    }


    $http({
      method: 'POST',
      url: serverUrl +'/users/pmuser',
      data: result
      //todo add Flash message for success and failure !
    }).then(function successCallback(response) {
      console.log('user Successully pm');
      console.log(response);
    }, function errorCallback(response) {
      console.log('user failed pm');
      console.log(response);
    });
  };

  $scope.deletePrivateMessages = function (index) {
    $scope.privateMessagesCurrent = $scope.privateMessages[index];
    $scope.privateMessages.splice(index, 1);

    $http({
      method: 'POST',
      url: serverUrl +'/users/deletepm',
      data: $scope.privateMessagesCurrent
      //todo add Flash message for success and failure !
    }).then(function successCallback(response) {
      console.log('user Successully pm');
      console.log(response);
    }, function errorCallback(response) {
      console.log('user failed pm');
      console.log(response);
    });



  };

  $scope.showCurrentPM = function (index) {
    $scope.showPM = true;
    $scope.privateMessagesCurrent = $scope.privateMessages[index];
    $scope.privateMessagesCurrent.conversation = angular.fromJson($scope.privateMessagesCurrent.conversation);
  };

  $scope.sendPrivateMessage = function () {
    var message,
        date,
        currentConv,
        messageInfo;
    message = "/w " + $scope.privateMessagesCurrent.nameconversation + " " + $scope.textMessage;
    date = new Date();
    if (message !== "") {
      messageInfo = {
        date: date.getHours() + ':' + date.getMinutes(),
        userIcon: '' ,
        userName: $scope.ConnectedUser.username,
        message: message
      };
      socket.emit('sendMessageToChat', messageInfo);
      currentConv = angular.fromJson($scope.privateMessagesCurrent.conversation);
      currentConv.push({'username': $scope.ConnectedUser.username, 'message' :$scope.textMessage });
      $scope.privateMessagesCurrent.conversation = currentConv;
      //todo waiting for real avatar system
    }
    $scope.textMessage = '';
  };


  //Get the rank of the user to know if he is Mod or other
  $scope.checkRank = function (user) {

  };

  //Check if the current user can use this smiley
  $scope.checkIfallowToUseSmiley = function () {
    angular.forEach($scope.smileysAvailable, function(smiley, index) {
      angular.forEach(smiley, function(value, key) {
        var img = "<img src='" + serverUrl + "/img/" + $scope.smileysAvailable[index].url + "' >";

        if ($scope.textMessage.search(value) !== -1 && key === "name") {
          $scope.smileyInMessage = true;
          var re = new RegExp(value,"g");
          $scope.textMessage = $scope.textMessage.replace(re, img);
        }
      })
    });

  };

  $scope.trustAsHtml = function (message) {
    return $sce.trustAsHtml(message.message);
  };


  //check if a user is banned from the chat user
  $scope.checkBannedLocal = function (data) {
    return _.findWhere($scope.mutedUsers, {'username_muted': data.userName }) !== undefined;
  };

  //User command to mute someone in chat
  $scope.userMute = function (user) {

    $scope.mutedUsers.push({ 'username_muted': user});

    $http({
      method: 'POST',
      url: serverUrl +'/users/addMutedUsers',
      data: {'username_muted': user}
      //todo add Flash message for success and failure !
    }).then(function successCallback(response) {
      console.log('user Successully mute');
    }, function errorCallback(response) {
      console.log('user failed mute');
    });
  };

  //User command to unmute someone in chat
  $scope.userUnmute = function (userToUnmute) {
    $scope.mutedUsers = _.without($scope.mutedUsers, _.findWhere($scope.mutedUsers, {iusername_mutedd: userToUnmute}));

    $http({
      method: 'POST',
      url: serverUrl +'/users/deleteMutedUser',
      data: {'username_muted': userToUnmute}
      //todo add Flash message for success and failure !
    }).then(function successCallback(response) {
      console.log('user Successully unmute');
      console.log($scope.mutedUsers);
    }, function errorCallback(response) {
      console.log('user failed to unmute');
    });
  };

  //User command to get people muted from a user
  $scope.listUserMute = function () {
    return $scope.mutedUsers;
  };

  //Moderator command to ban someone from the chat
  $scope.modBan = function (user, time, reason, moderator) {

  };
  //Moderator Command to unban someone
  $scope.modUnban = function (user, moderator) {

  }



}]);