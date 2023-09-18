M.AutoInit();

var source = new EventSource("server.php");
source.onmessage = function(event) {
   console.log(event)

    source.close()
};

var formData = new FormData();
formData.append('name','springlight')
formData.append('id','springlight')
function sendEvent() {
    axios.put('server.php',{name:'ttt'}).then(function (response) {
        console.log(response.data)
    })
}