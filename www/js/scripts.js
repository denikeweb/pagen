
function login_form (tag){
    if (tag == 1) {
        document.getElementById("login_alert").style.display = "none";
        document.getElementById("login_form").style.display = "block";
    } else {
        document.getElementById("login_alert").style.display = "block";
        document.getElementById("login_form").style.display = "none";
    }
}