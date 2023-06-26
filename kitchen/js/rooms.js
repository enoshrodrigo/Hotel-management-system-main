
console.log("rooms.js loaded");


var response;
// Path: Admin\js\rooms.js
document.getElementById("roomtype").addEventListener("input", function() {
    let roomtype = document.getElementById("roomtype").value;
      reqtochechroom(roomtype);
    
});

function reqtochechroom(froomtype){
    var xhttp = new XMLHttpRequest();
    // console.log("single");
    xhttp.onreadystatechange = function() {
  
      if (this.readyState == 4 && this.status == 200) {

        // document.getElementById("roomnumber").innerHTML = this.responseText;
           response = JSON.parse(xhttp.responseText);
         console.log(response);
          var secondSelect = document.getElementById("roomnumber");
          secondSelect.innerHTML = "";
       
          response.forEach(function(option) {
           var optionElement = document.createElement("option");
            optionElement.value = option.value;
            optionElement.text = option.text;
            secondSelect.appendChild(optionElement);
            // console.log(option.price);
          });



      }
    };


    xhttp.open("POST", "./js/avaliblerooms.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("value=" + froomtype);
    
}
// const elements = document.querySelectorAll("container-fluid");

document.getElementById("page-top").addEventListener("mousemove", function() {

  var selectedRoomNumber = document.getElementById("roomnumber").value;
  console.log(selectedRoomNumber);
  
  var selectedOption = response.filter(function(option) {
    // console.log(option.value);
    return option.value == selectedRoomNumber;
  });
console.log(selectedOption);
  if (selectedOption.length) {
    selectedOption = selectedOption[0];


    document.getElementById("price").value = selectedOption.price;
    document.getElementById("flexCheckDefaultac").checked = Boolean(Number(selectedOption.roomac));
    document.getElementById("flexCheckDefaultwifi").checked =Boolean(Number( selectedOption.roomwifi));
    document.getElementById("flexCheckDefaulttv").checked = Boolean(Number(selectedOption.roomtv));
    document.getElementById("flexCheckDefaultkitchen").checked = Boolean(Number(selectedOption.roomkitchen));
    document.getElementById("flexCheckDefaultfridge").checked =Boolean(Number( selectedOption.roomfridge));
                console.log(selectedOption.price);
                console.log(Boolean(Number(selectedOption.roomac)));
                console.log(selectedOption.roomac);
                console.log(Boolean(Number( selectedOption.roomwifi)));
                console.log(selectedOption.roomwifi);
                console.log(Boolean(Number(selectedOption.roomtv)));
                console.log(selectedOption.roomtv);
                console.log(Boolean(Number(selectedOption.roomkitchen)));
                console.log(selectedOption.roomkitchen);
                console.log(Boolean(Number( selectedOption.roomfridge)));
                console.log(selectedOption.roomfridge);
  }

});