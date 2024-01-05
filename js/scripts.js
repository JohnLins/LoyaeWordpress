const loader = document.getElementById("loader");

function showLoader() {
  loader.style.display = "block";
}



function toggle(source, name) {
  checkboxes = document.getElementsByClassName(name);
  for(var i=0, n=checkboxes.length;i<n;i++) {
    checkboxes[i].checked = source.checked;
  }
    
}

function sumAmount(source) {
  var temp = 0.0;
  checkboxes = document.getElementsByClassName("pages")
  for(var i=0, n=checkboxes.length;i<n;i++) {
      if(checkboxes[i].checked){
          temp += parseFloat(checkboxes[i].getAttribute("cost"));
      }
  }
  checkboxes = document.getElementsByClassName("posts")
  for(var i=0, n=checkboxes.length;i<n;i++) {
      if(checkboxes[i].checked){
          temp += parseFloat(checkboxes[i].getAttribute("cost"));
      }
  }

  totalAmount = temp.toFixed(2);

  document.getElementById("optimize").setAttribute("value", "Optimize ($"+totalAmount+")");
  document.getElementById("amount").value = totalAmount;
}

function optmiz(){
  const o = document.getElementById("optimize");
  o.disable = true;
  o.style.backgroundColor="gray";
  o.value = "loading... (this will take a while)";
}