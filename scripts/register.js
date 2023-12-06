document.addEventListener("DOMContentLoaded", function () {
    document.getElementById("password2").addEventListener("input", function () {
        var password1 = document.getElementById("password").value;
        var password2 = document.getElementById("password2").value;
        var message = document.getElementById("pwdMatchMessage");

        if (password1 !== password2) {
            message.innerHTML = "Passwords do not match.";
        } else {
            message.innerHTML = "";
        }
    });
});


// function validateForm() {

//     var flag = true;
//     var letters = /^[A-Za-z]+$/;

//     clearMessages();

//     var firstInput = document.getElementById("first").value;
//     var text1 = "";
//     if (!firstInput.match(letters)) {
//         text1 = "First name must only contain letters.";
//         flag = false;
//     }
//     document.getElementById("firstMessage").innerHTML = text1;

//     var text2 = "";
//     var lastInput = document.getElementById("last").value;
//     if (!lastInput.match(letters)) {
//         text2 = "Last name must only contain letters.";
//         flag = false;
//     }
//     document.getElementById("lastMessage").innerHTML = text2;

//     var text3 = "";
//     if (lastInput.match(firstInput)) {
//         text3 = "First name and last name should be different.";
//         flag = false;
//     }
//     document.getElementById("diffMessage").innerHTML = text3;

//     var text4 = "";
//     var format = /^\((\d{3})\)[ ](\d{3})[- ](\d{4})$/;
//     var phoneInput = document.getElementById("number").value;
//     if (!phoneInput.match(format)) {
//         text4 = "Phone number must be formatted as (012) 345-6789.";
//         flag = false;
//     }
//     document.getElementById("phoneMessage").innerHTML = text4;

//     var text5 = "";
//     var emailInput = document.getElementById("email").value;
//     if (!emailInput.includes("@") || !emailInput.includes(".com")) {
//         text5 = "Email must contain '@' and '.com'";
//         flag = false;
//     }
//     document.getElementById("emailMessage").innerHTML = text5;

//     var text6 = "";
//     var password = document.getElementById("password").value;
//     var password2 = document.getElementById("password2").value;
//     if (!password.match(password2)) {
//         text6 = "Passwords do not match.";
//         flag = false;
//     }
//     document.getElementById("pwdMessage").innerHTML = text6;

//     var text7 = "";
//     if (password.length < 8) {
//         text7 = "Password must be at least 8 characters.";
//         flag = false;
//     }
//     document.getElementById("8Message").innerHTML = text7;

//     var text8 = "";
//     var birthday = document.getElementById("birthday").value;
//     if (birthday == "") {
//         text8 = "Please enter your Date of Birth.";
//         flag = false;
//     }

//     document.getElementById("bdayMessage").innerHTML = text8;

//     var text9 = "";
//     var address = document.getElementById("address").value;
//     if (address == "") {
//         text9 = "Please enter your address.";
//         flag = false;
//     }

//     document.getElementById("addMessage").innerHTML = text9;

//     if (!flag) {
//         return false;
//     }

//     return true;
// }


// function clearMessages() {
//     // Clear all error messages
//     var errorMessages = ["8Message", "pwdMessage", "firstMessage", "lastMessage", "diffMessage", "bdayMessage", "phoneMessage", "emailMessage", "genderMessage", "addMessage"];

//     for (var i = 0; i < errorMessages.length; i++) {
//         document.getElementById(errorMessages[i]).innerHTML = "";
//     }
// }


// var myInterval = setInterval(formatDate, 1000);

// function formatDate() {
//     var date = new Date();
//     var hours = date.getHours();
//     var minutes = date.getMinutes();
//     var seconds = date.getSeconds();
//     var ampm = hours >= 12 ? 'p.m.' : 'a.m.';
//     hours = hours % 12;
//     hours = hours ? hours : 12; // the hour '0' should be '12'
//     minutes = minutes < 10 ? '0'+minutes : minutes;
//     seconds = seconds < 10 ? '0'+seconds : seconds;
//     var strTime = hours + ':' + minutes + ':' + seconds + ' ' + ampm;
//     document.getElementById("date").innerHTML = (date.getMonth()+1) + "/" + date.getDate() + "/" + date.getFullYear() + "  " + strTime;
// }

 function displaySuccessMessage() {
     var successDiv = document.getElementById("successMessage");
     successDiv.style.display = "block";
 }
