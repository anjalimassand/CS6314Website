function validateForm() {
    var letters = /^[A-Za-z]+$/;
    var firstInput = document.getElementById("first").value;
    var text1 = "";
    if (!firstInput.match(letters)) {
        text1 = "First name must only contain letters.";
    }
    document.getElementById("firstMessage").innerHTML = text1;

    var text2 = "";
    var lastInput = document.getElementById("last").value;
    if (!lastInput.match(letters)) {
        text2 = "Last name must only contain letters.";
    }
    document.getElementById("lastMessage").innerHTML = text2;

    var text3 = "";
    if (lastInput.match(firstInput)) {
        text3 = "First name and last name should be different.";
    }
    document.getElementById("diffMessage").innerHTML = text3;

    var text4 = "";
    var format = /^\((\d{3})\)[ ](\d{3})[- ](\d{4})$/;
    var phoneInput = document.getElementById("number").value;
    if (!phoneInput.match(format)) {
        text4 = "Phone number must be formatted as (012) 345-6789.";
    }
    document.getElementById("phoneMessage").innerHTML = text4;

    var text5 = "";
    var emailInput = document.getElementById("email").value;
    if (!emailInput.includes("@") || !emailInput.includes(".")) {
        text5 = "Email must contain '@' and '.'";
    }
    document.getElementById("emailMessage").innerHTML = text5;

    var text6 = "";
    var maleInput = document.getElementById("male").checked;
    var femaleInput = document.getElementById("female").checked;
    if (maleInput == false && femaleInput == false) {
        text6 = "Gender must be selected.";
    }
    document.getElementById("genderMessage").innerHTML = text6;

    var text7 = "";
    var commentInput = document.getElementById("comment").value;
    if (commentInput.length < 10) {
        text7 = "Comment must be at least 10 characters.";
    }
    document.getElementById("commentMessage").innerHTML = text7;
}

var myInterval = setInterval(formatDate, 1000);

function formatDate() {
    var date = new Date();
    var hours = date.getHours();
    var minutes = date.getMinutes();
    var seconds = date.getSeconds();
    var ampm = hours >= 12 ? 'p.m.' : 'a.m.';
    hours = hours % 12;
    hours = hours ? hours : 12; // the hour '0' should be '12'
    minutes = minutes < 10 ? '0'+minutes : minutes;
    seconds = seconds < 10 ? '0'+seconds : seconds;
    var strTime = hours + ':' + minutes + ':' + seconds + ' ' + ampm;
    document.getElementById("date").innerHTML = (date.getMonth()+1) + "/" + date.getDate() + "/" + date.getFullYear() + "  " + strTime;
}

var inventory = {
    
};


  
