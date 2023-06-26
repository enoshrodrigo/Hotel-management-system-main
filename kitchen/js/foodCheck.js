var response;
var MessureResponse;
var Globaloption;
var count = 0;
var clicks = 0;
var g = 0;

document.getElementById("add_option").addEventListener("click", function () {
  count++;
  clicks++;
  var foodMessure = document.createElement("input");
  foodMessure.setAttribute("type", "number");
  foodMessure.setAttribute("step", "any");
  foodMessure.setAttribute("class", "form-control");
  foodMessure.setAttribute("name", "Messure[]");
  foodMessure.setAttribute("id", "Messure" + count);
  foodMessure.setAttribute("required", true);
  foodMessure.setAttribute("min", "1");

  document.getElementById("messure").appendChild(foodMessure);

  var foodselect = document.createElement("select");
  foodselect.setAttribute("class", "form-control");
  foodselect.setAttribute("name", "select_food[]");
  foodselect.setAttribute("id", "select_food" + count);
  var foodSelectID = "select_food" + count;
  var foodMessure = "size" + count;
  foodselect.setAttribute("onchange", "change("+foodSelectID+","+foodMessure+")");

  var size = document.createElement("input");
  size.setAttribute("type", "text");
  size.setAttribute("class", "form-control");
  size.setAttribute("name", "select_size[]");
  size.setAttribute("id", "size" + count);
  
  size.setAttribute("readonly", true);

  document.getElementById("size").appendChild(size);

  checkFoods(foodselect);
});

function checkFoods(foodselect) {
  var xhttp = new XMLHttpRequest();
   
  xhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
       
      response = JSON.parse(xhttp.responseText);
      // console.log(response);
      

      response.forEach(function (option) {
        if (g == 0) {
          var k = document.getElementById("size" + count);
          k.setAttribute("value", option.food_measurement);
        }
        g++;
      });
      response.forEach(function (option) {
        g = 0;
         Globaloption = this.option;
        var foodDiv = document.createElement("option");
        foodselect.appendChild(foodDiv);
        foodDiv.setAttribute("value",option.food_id);
        // foodDiv.setAttribute("data-value2", option.food_measurement);

        var div = document.createElement("div");
      
            // div.setAttribute("value",option.food_name);

        div.innerHTML = option.food_name;
        foodDiv.appendChild(div);
        document.getElementById("selectDiv").appendChild(foodselect);
      
 
      });
    }
  };

  xhttp.open("POST", "./js/foodCheck.php", true);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhttp.send("value=" + 1);
  
}
 
 
 
function change(food_name_id,food_size_id){
//  console.log(food_name_id.id.option);
 

  var select = document.getElementById(food_name_id.id);
  
  var size = document.getElementById(food_size_id.id);
 
  // size.value=select.value;
   
checkMessure(select.value,size);


}
function checkMessure(selectValue,Msize) {
  var xhttps = new XMLHttpRequest();
  // console.log("single");

  xhttps.onreadystatechange = function () {
    
    if (this.readyState == 4 && this.status == 200) {
      // var  MessureResponse = [];
     MessureResponse = JSON.parse(xhttps.responseText);
      // console.log(selectValue);
    

      
      MessureResponse.forEach( function (Messure) {
        // console.log(Messure.food_id);
        console.log(Messure.food_measurement);
        Msize.value=Messure.food_measurement;
        // return (Messure.food_measurement);
        
      });
    }
  };

  xhttps.open("POST", "./js/FoodCheck.php", true);
  xhttps.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhttps.send("check=" + selectValue);
}