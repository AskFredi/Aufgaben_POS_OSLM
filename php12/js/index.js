function validateMessurementDate(elem){

 let today = new Date();
 today.setHours(0,0,0,0);

 let messDate = new Date(elem.value);
 messDate.setHours(0,0,0,0);

 <!-- CSS Vorgabe -->
 if(messDate <= today){
  elem.classList.add("is-valid");
  elem.classList.remove("is-invalid");
 }else{
  elem.classList.add("is-invalid");
  elem.classList.remove("is-valid");
 }
}