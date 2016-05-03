app.directive("scrollBottom", function(){
   	return {
        link: function(){
            var $id= document.getElementById("messages");
            document.getElementById("sendmessagebutton").onclick = function(){
              if ($id.scrollTop + $id.offsetHeight === $id.scrollHeight) {
                  setTimeout(function() { $id.scrollTop = $id.scrollHeight - $id.offsetHeight;}, 100);
              }
            };

        }
    }
});