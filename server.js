var express        = require('express');
var app            = express();
var httpServer = require("http").Server(app);
var io=require('socket.io')(httpServer);
var connectedUsers = {};

app.get('/', function(req, res){
res.send('');
});

io.on('connect', function(socket){
  console.log('a user connected');

  socket.on('newUserToChat', function (data) {
    if (data in connectedUsers || data === null) {
    } else{
      socket.nickname = data;
      connectedUsers[socket.nickname] = socket;
      updateConnectedUsers();
    }
  });

  socket.on('sendMessageToChat', function(user){
    console.log(user.date, user.userName, user.message);
    if (user.message.substring(0,3) === '/w ') {
      var message,
        indice,
        name;
      user.message = user.message.substring(3);
      name = user.message.split(" ")[0];
      indice = user.message.indexOf(' ');
      message = user.message.substring(indice+1);
      if (name in connectedUsers) {
        connectedUsers[name].emit('whisperToUser', {username: socket.nickname, message: message});
        connectedUsers[user.userName].emit('sendWhisperToUser', {username: name, message: message});
      }

    } else {
      io.emit('newMessageToChat', user);
    }
  });

  socket.on('disconnect', function(data){
    if(!socket.nickname) return;
    delete connectedUsers[socket.nickname];
    updateConnectedUsers();
  });


  function updateConnectedUsers () {
    io.emit('newUserToChat', Object.keys(connectedUsers));
  }
});

httpServer.listen(3000, function(){
  console.log('listening on *:3000');
});
