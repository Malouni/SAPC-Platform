function showEmailPopup() {
    var email = "example@email.com";
    var popupMessage = "Please contact admin to this email: "+ email;
    var popupElement = document.createElement("div");
    popupElement.innerHTML = popupMessage;
    alert(popupElement.innerHTML);
}