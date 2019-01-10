(function () {
    var url = "http://18.188.143.243/requests";
    var userEmail = $("#main-form input");
    var userEmailFooter = $("#footer-form input");
    
    function sendData(opt){
        
        var settings = {
          "async": true,
          "crossDomain": true,
          "url": "http://18.188.143.243/requests",
          "method": "POST",
          "dataType": "json",
          "headers": {
            "Cache-Control": "no-cache",
            "Access-Control-Allow-Origin": "http://18.188.143.243"
          },
          "processData": false,
          "data": JSON.stringify(opt)
        };

        $.ajax(settings).done(function (response) {
          console.log(response);
        });
        console.log(JSON.stringify(opt));
        
    };
    
    function emailSend(e) {
        e.preventDefault();
        if(userEmail.val() || userEmailFooter.val()) {
            sendData({
                content:"Sanchit S",
                email:"test@abc.com",
                mobileNumber:"1234567890"
            });
        }
        
        userEmail.val("");
        userEmailFooter.val("");
    }
    
    
    $("#main-form button").on("click", emailSend);
    $("#footer-form button").on("click", emailSend);
    
})();