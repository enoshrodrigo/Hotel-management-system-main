var toggel=true;
                document.getElementById("addcustomer").addEventListener("click", function click() {
                  var spec = document.getElementById("formContainer");
                  // document.getElementById("demo").innerHTML="Close";
                   if(toggel){
                    spec.style.display = "block";
                    spec.style.transition = "1s";
                    
                 
                    
                   }else{
                    spec.style.transition = "all 1s ease-in-out";
                    spec.style.display = "none";
                   }
                     toggel=!toggel;
                });



                document.getElementById("customernic").addEventListener("input", function() {
                  // event.preventDefault();
                  var inputValue = document.getElementById("customernic").value;
                  //    document.getElementById("ddd").innerHTML = inputValue;
                 
                  ccheckInDB(inputValue);
            
                  

                  

            


      
              });
      
              function ccheckInDB(inputValue) {
                
                  
                  var xhttp = new XMLHttpRequest();
                  xhttp.onreadystatechange = function() {
                    if(this.responseText==='already exists user.'){

                      document.getElementById('csubmit').style.backgroundColor="red";
                      document.getElementById('csubmit').disabled=true;
                    }else{

                     
                      document.getElementById("customercheck").innerHTML ='';
                      if (!/^\d+(V?)$/.test(inputValue)) {
                     
                        document.getElementById('csubmit').style.backgroundColor="red";
                        document.getElementById('csubmit').disabled=true;
                      }
                      else{
                        document.getElementById('csubmit').style.backgroundColor="#6662e0";
                        document.getElementById('csubmit').disabled=false;
                      }
                     
                    
                      // Check if 'V' is in the middle of the ID
                      if (id.indexOf('V') !== id.length - 1) {
                        document.getElementById('csubmit').style.backgroundColor="red";
                        document.getElementById('csubmit').disabled=true;
                      } else{
                        document.getElementById('csubmit').style.backgroundColor="#6662e0";
                        document.getElementById('csubmit').disabled=false;
                      }
                   
                    }
                      if (this.readyState == 4 && this.status == 200) {
                          document.getElementById("customercheck").innerHTML = this.responseText;
                          
                      }
                  };
      
                  xhttp.open("POST", "./verifyKitchen/cverify.php", true);
                  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                  xhttp.send("cvalue=" + inputValue);
              }



    