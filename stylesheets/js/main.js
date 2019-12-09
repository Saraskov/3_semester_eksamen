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
    if(username.value === ""){
        failtext("#usernamefail", "Du skal indtaste et brugernavn");
    }
    else if (!/^[a-zA-Z0-9æøåÆØÅ]*$/){
        failtext("#usernamefail", "Du kan kun bruge bogstaver og tal i dit brugernavn");
    }
    else if (username.value.length < 4){
        failtext("#usernamefail", "Dit brugernavn skal minumun indeholde 4 bogstaver eller tal");
    }else{
        clear("#usernamefail");
    }

    //Tjek for password
    if(password.value === ""){
        failtext("#passwordfail", "Du skal indtaste et password");
        return false;
    }else if(password.value.length < 8){
        failtext("#passwordfail", "Dit password skal være mindst 8 karakterer");
        password.value = "";
        gentagPassword.value = "";
        return false
    }else if(gentagPassword.value === ""){
        failtext("#genpassfail", "Du skal gentage dit password");
        clear("#passwordfail");
        return false;
    }else if (!password.value === gentagPassword.value){
        failtext("#genpassfail", "Det er ikke identisk");
        password.value = "";
        gentagPassword.value = "";
        return false;
    }else{
        clear("#passwordfail");
        clear("#genpassfail");
    }

    //Tjek fornavn
    if(fornavn.value === ""){
        console.log("Tjekker navn");
        failtext("#namefail", "Du skal indtaste dit navn");
        return false;
    }else if (!/^[a-zA-Z]*$/){
        failtext("#namefail", "Du kan kun bruge bogstaver i dit navn");
        return false;
    }else{
        clear("#namefail");
    }

    //Tjek efternavn
    if(efternavn.value === ""){
        console.log("Tjekker efternavn");
        failtext("#enamefail", "Du skal indtaste dit efternavn");
        return false;
    } else if (!/^[a-zA-Z]*$/) {
        failtext("#enamefail", "Du kan kun bruge bogstaver i dit efternavn");
        return false;
    } else{
        clear("#enamefail");
    }

    //Tjek email
    if(email.value === ""){
        console.log("tjekker email");
        failtext("#emailfail", "Du skal indtaste en email");
        return false;
    }else if (!/([a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*|"(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21\x23-\x5b\x5d-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])*")@(?:(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?|\[(?:(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.){3}(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?|[a-z0-9-]*[a-z0-9]:(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21-\x5a\x53-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])+)\])/){
        failtext("#emailfail", "Du skal skrive en valid email");
        return false;
    }else {
        clear("#emailfail");
    }

    //Tjek postnr
    if(postnr.value === ""){
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
    if(by_navn.value === ""){
        console.log("tjekker bynavn");
        failtext("#byfail", "Du skal indtaste den by du bor i");
        return false;
    }else if (!/^[a-zA-ZæøåÆØÅ]*$/){
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