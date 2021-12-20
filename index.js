const getValidation = () =>{
    var items = document.getElementById("toitems").value.trim();
    var errors = document.getElementById("error_text");
    if(items === ""){
        errors.style.display="block";
        return false;
    }else{
        if(items.length < 3){
            document.getElementById("error_text").style.display = "block";
            document.getElementById("error_text").innerHTML ="Item length is too small (min 3 characters)";
            return false;
        }else if(!isNaN(items)){
            document.getElementById("error_text").style.display = "block";
            document.getElementById("error_text").innerHTML ="Numbers are not allowed as to do items please add text";
            return false;
        }
        
    }
}
const removeError = () =>{
    document.getElementById("error_text").style.display="none";
}
const closeforms = () =>{
    document.getElementById("closeforms").style.display="none";
}
const getEditForms = (clicked_id) =>{
    document.getElementById("closeforms").style.display="block";
    var clickeditems = document.getElementsByClassName(clicked_id)[0].innerHTML;
    document.getElementById("restitem").value= clickeditems;
    document.cookie = "resetid="+clicked_id;
    // alert(clickeditems);
}
const validateReset = () =>{
   var restitem = document.getElementById("restitem").value.trim();
   if(restitem === ""){
       document.getElementById("resetError").innerHTML = "please fill the form";
       return false;
   }
}
const setDone = (done_id) =>{
    document.cookie = "doneItems="+done_id;
}