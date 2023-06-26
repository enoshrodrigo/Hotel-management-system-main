console.log("loaded ajax");

function ajaxToUpdateData(roomNumber,price,ac,tv,wifi,kitchen,fridge){
    console.log(roomNumber);
    console.log(price);
    console.log(ac);
    console.log(tv);
    console.log(wifi);
    console.log(kitchen);
    console.log(fridge);
    ppp = parseFloat(price);
    if(ppp<=0){
        alert("Please enter price");
        window.location.href = "edit-rooms.php";
        
    }
    //if price is not a number
    else if(isNaN(ppp)){
        alert("Please enter a valid price");
        window.location.href = "edit-rooms.php";
    }
    else{

    UpdateRoomDetails(roomNumber,price,ac,tv,wifi,kitchen,fridge);
    }

}

function UpdateRoomDetails(AroomNumber,Aprice,Aac,Atv,Awifi,Akitchen,Afridge) {
                
                  
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
     
        if (this.readyState == 4 && this.status == 200) {
            // document.getElementById("customercheck").innerHTML = this.responseText;
           
 if(this.responseText==='updated'){
        alert("Succes fully updated");
      }else{
        
     
      }
            
        }
    };

    xhttp.open("POST", "js/ajaxEdit-rooms.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    var params = "Aroomnumber=" + AroomNumber +
    "&Aprice=" + Aprice +
    "&Aac=" + Aac +
    "&Atv=" + Atv +
    "&Awifi=" + Awifi +
    "&Akitchen=" + Akitchen +
    "&Afridge=" + Afridge;

    xhttp.send(params);
}