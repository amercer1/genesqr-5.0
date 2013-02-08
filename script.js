function loadFiles(){

    var data= JSON.parse(getSession());
 
    var username= data.login;
    var token= data.password;

    var fileData = JSON.parse(getFiles());
    addValuesToSelectors(fileData);
}

function getSession(){

   var xhr = new XMLHttpRequest();
   xhr.open('GET','getsession.php',false);
   xhr.send();
   if (xhr.status ==200){
      return xhr.responseText;
   }


}

function getFiles(){

   var xhr = new XMLHttpRequest();
   xhr.open('GET','getfiles.php',false);
   xhr.send();
   if (xhr.status ==200){
      return xhr.responseText;
   }
   if (xhr.status ==401){
      return 1;
   }

  
   return 0;
}

function addValuesToSelectors(fileData){

   var selector = document.getElementById("libfname"); //grab selector
   var secondSelector = document.getElementById("estSeq");
   
   for(i in fileData){
      var option=document.createElement("option");
      option.text=(fileData[i].path);
      selector.add(option,selector.options[null]);
   }

   for(i in fileData){
      var option=document.createElement("option");
      option.text=(fileData[i].path);
      secondSelector.add(option,secondSelector.options[null]);
   }

}
