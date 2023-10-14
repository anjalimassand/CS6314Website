document.addEventListener("DOMContentLoaded", function () {
    const specialOfferButton = document.getElementById("specialOfferButton");
    const questionContainer = document.getElementById("questionContainer");
    const resultContainer = document.getElementById("resultContainer");
    const nextButton = document.getElementById("nextButton");
    const skipButton = document.getElementById("skipButton");
    const qualificationReason = document.getElementById("qualificationReason");
    const offerDetails = document.getElementById("offerDetails");
    const timeSpent = document.getElementById("timeSpent");

    const questions = [
        "Are you a student?",
        "Are you a low-income person?",
        "Are you a member of Shopper's Stop?",
    ];
    let currentQuestionIndex = 0;
    let userAnswers = [];
    let startTime;

    specialOfferButton.addEventListener("click", () => {
        questionContainer.style.display = "block";
        specialOfferButton.style.display = "none";
        showQuestion(currentQuestionIndex);
        startTime = new Date();
    });

    nextButton.addEventListener("click", () => {
        const selectedOption = document.querySelector('input[name="student"]:checked');
        if (selectedOption) {
            userAnswers.push(selectedOption.value);
            currentQuestionIndex++;
            if (currentQuestionIndex < questions.length) {
                showQuestion(currentQuestionIndex);
            } else {
                displaySpecialOffer();
            }
        } else {
            alert("Please select an answer.");
        }
    });

    skipButton.addEventListener("click", () => {
        userAnswers.push("skipped");
        currentQuestionIndex++;
        if (currentQuestionIndex < questions.length) {
            showQuestion(currentQuestionIndex);
        } else {
            displaySpecialOffer();
        }
    });

    function showQuestion(index) {
        const currentQuestion = questions[index];
        document.querySelector("h4").textContent = currentQuestion;
        document.querySelectorAll('input[name="student"]').forEach((radio) => (radio.checked = false));
    }

    function displaySpecialOffer() {
        questionContainer.style.display = "none";
        resultContainer.style.display = "block";
    
        // Check if the user answered "Yes" to all questions
        const allYes = userAnswers.every(answer => answer === "yes");
    
        if (allYes) {
            const qualificationReasonText = "Because you answered 'Yes' to all questions, you qualify for $100 off your purchase!";
            const offerDetailsText = "Use code 556482 for $100 off";
            qualificationReason.textContent = qualificationReasonText;
            offerDetails.textContent = offerDetailsText;
        } else {
            const qualificationReasonText = "You do not qualify for a special offer at this time.";
            qualificationReason.textContent = qualificationReasonText;
         //   offerDetails.textContent = "No special offer available.";
        }
    
        const endTime = new Date();
        const timeDiff = (endTime - startTime) / 1000; // Calculate time spent in seconds
        timeSpent.textContent = `Time Spent: ${timeDiff} seconds`;
    }
   
});
