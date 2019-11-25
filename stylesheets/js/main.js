function checkform(){
    let formElement = document.querySelector("#checkform");
    let username = formElement.username;
    let password= formElement.password;
    let gentagPassword = formElement.gentagPassword;
    let fornavn = formElement.fornavn;
    let efternavn = formElement.efternavn;
    let email = formElement.email;
    let postnr = formElement.postnr;
    let by_navn = formElement.by;

    //Tjek for username
    if(username.value == ""){
        failtext("#usernamefail", "Du skal indtaste et brugernavn");
    }else if (!/^[a-zA-Z0-9æøåÆØÅ]*$/. test(username.value)){
        failtext("#usernamefail", "Du kan kun bruge bogstaver og tal i dit brugernavn");
    }else if (username.value.length < 4){
        failtext("#usernamefail", "Dit brugernavn skal minumun indeholde 4 bogstaver eller tal");
    }else{
        clear("#usernamefail");
    }

    //Tjek for password
    if(password.value == ""){
        failtext("#passwordfail", "Du skal indtaste et password");
        return false;
    }else if(password.value.length < 8){
        failtext("#passwordfail", "Du skal indtaste et password");
        return false
    }else if(gentagPassword.value == ""){
        failtext("#genpassfail", "Du skal gentage dit password");
        clear("#passwordfail");
        return false;
    }else if (!password.value === gentagPassword.value){
        failtext("#genpassfail", "Du skal gentage dit password");
        clear("#usernamefail");
        return false;
    }

    //Tjek fornavn
    if(fornavn.value == ""){
        console.log("Tjekker navn");
        failtext("#namefail", "Du skal indtaste dit navn");
        return false;
    }else if (!/^[a-zA-Z]*$/. test(fornavn.value)){
        failtext("#namefail", "Du kan kun bruge bogstaver i dit navn");
        return false;
    }else{
        clear("#namefail");
    }

    //Tjek efternavn
    if(efternavn.value == ""){
        console.log("Tjekker efternavn");
        failtext("#enamefail", "Du skal indtaste dit efternavn");
        return false;
    } else if (!/^[a-zA-Z]*$/. test(efternavn.value)) {
        failtext("#enamefail", "Du kan kun bruge bogstaver i dit efternavn");
        return false;
    }

    //Tjek email
    if(email.value == ""){
        console.log("tjekker email");
        failtext("#emailfail", "Du skal indtaste en email");
        return false;
    }else if (!/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/. test(email.value)){
        failtext("#emailfail", "Du skal skrive en valid email");
        return false;
    }else {
        clear("#emailfail");
    }

    //Tjek postnr
    if(postnr.value == ""){
        console.log("tjekker postnr");
        failtext("#postfail", "Du skal indtaste dit postnummer");
        return false;
    }else if (postnr.value.length != 4){
        failtext("#postfail", "Dit postnummer skal bestå af 4 cifre");
        return false;
    }else {
        clear("#postfail");
    }

    //Tjek by
    if(by_navn.value == ""){
        console.log("tjekker bynavn");
        failtext("#byfail", "Du skal indtaste den by du bor i");
        return false;
    }else if (!/^[a-zA-ZæøåÆØÅ]*$/. test(by_navn.value)){
        failtext("#byfail", "Du kan kun bruge bogstaver i by navnet");
        return false;
    }else if(by_navn.value.length < 2){
        failtext("#byfail", "Du skal indtaste et valideret bynavn");
        return false;
    }else{
        clear("#byfail");
    }

    function failtext(pname, msg){
        let p = document.querySelector(pname);
        p.innerHTML = msg;
        p.className = "fail";
        return false;
    }

    function clear(pname){
        let p = document.querySelector(pname);
        p.className = "succes";
        p.innerHTML = "Succes";
    }
}