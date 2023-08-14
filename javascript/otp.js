 const otpInputs = document.querySelectorAll('.otp-input'),
 errorMessage=document.querySelector('.error'),
 close=document.querySelector('.close'),

 button=document.querySelector('.submit');

 close.addEventListener('click',()=>{
  location.href="home";
})
 function handleInput(event) {
  const input = event.target;
  if (input.value.length === 1) {
    // If the input field has a character, move focus to the next field
    const currentIndex = Array.from(otpInputs).indexOf(input);
    if (currentIndex < otpInputs.length - 1) {
      otpInputs[currentIndex + 1].focus();
    }
  } else if (input.value.length === 0) {
    // If the input field is empty, move focus to the previous field
    const currentIndex = Array.from(otpInputs).indexOf(input);
    if (currentIndex > 0) {
      otpInputs[currentIndex - 1].focus();
    }
  }

  // Check if all input fields are filled
  let allInputsFilled = true;
  otpInputs.forEach((input) => {
    if (input.value.length === 0) {
      allInputsFilled = false;
    }
  });

  // If all input fields are filled, add 'active' class to the button; otherwise, remove it
  if (allInputsFilled) {
    button.classList.add('active');
  } else {
    button.classList.remove('active');
  }
}

otpInputs.forEach(input => {
  input.addEventListener('input', handleInput);
});

document.querySelector('form').onsubmit =(e)=>{
  e.preventDefault();
}


   
document.addEventListener('DOMContentLoaded', function () {
  const hiddenButton = document.querySelector('.request');
  const countdownTimer = document.getElementById('countdownTimer');

  const storedTimestamp = localStorage.getItem('buttonTimestamp');
  const currentTime = Math.floor(Date.now() / 1000); // Convert current time to Unix timestamp (in seconds)
  let timeLeft = 240; // 10 minutes in seconds (10 minutes * 60 seconds)

  let countdownInterval; // Declare countdownInterval variable in the outer scope

  if (storedTimestamp) {
    // Calculate the time left based on the stored timestamp
    const elapsedTime = currentTime - parseInt(storedTimestamp, 10);
    if (elapsedTime < timeLeft) {
      timeLeft = timeLeft - elapsedTime;
    } else {
      timeLeft = 0; // Timer has already expired
    }
  } else {
    // Show the button after 10 minutes (600 seconds) from the current time
    localStorage.setItem('buttonTimestamp', currentTime);
  }

  function showHiddenButton() {
    hiddenButton.classList.add('active');
  }

  function updateCountdown() {
    const minutes = Math.floor(timeLeft / 60);
    const seconds = timeLeft % 60;
    countdownTimer.innerText = `${minutes}:${seconds.toString().padStart(2, '0')}`;
    timeLeft--;

    if (timeLeft < 0) {
      showHiddenButton();
      clearInterval(countdownInterval);
      localStorage.removeItem('buttonTimestamp'); // Remove stored timestamp when the button appears

      // Send AJAX request when the timer reaches zero
      const xhr = new XMLHttpRequest();
      xhr.open("POST", "php/login.php", true);
      xhr.onreadystatechange = function () {
        if (this.readyState === XMLHttpRequest.DONE) {
          if (xhr.status === 200 && xhr.readyState === 4) {
            console.log(xhr.response);
            if (xhr.response === "done") {
              location.href = "login";
            }
          }
        }
      };
      xhr.setRequestHeader("content-type", "application/x-www-form-urlencoded");
      xhr.send("code=0" + "&action=otp&expired=" + true);
    }
  }

  // Update the countdown timer immediately to avoid the 1-second delay on the initial display
  updateCountdown();

  // Update the countdown timer every second and store the interval in the countdownInterval variable
  countdownInterval = setInterval(updateCountdown, 1000);
});






  button.addEventListener('click',()=>{
    if(button.classList.contains('active')){
      localStorage.removeItem('buttonTimestamp'); // Remove stored timestamp when the button appears
      let code="";
      otpInputs.forEach(element=>{
         code+=element.value;
      })
        const xhr= new XMLHttpRequest();
        xhr.open("POST","php/login.php",true);
        xhr.onreadystatechange= function(){
            if(this.readyState===XMLHttpRequest.DONE){
                if(xhr.status===200 && xhr.readyState===4){
                    if(xhr.response==="done"){
                      errorMessage.style.display="none";
                      location.href="home";
                    }
                    else{
                      errorMessage.style.display="flex";
                      errorMessage.textContent=xhr.response;
                    }


                }
            }
        }
        xhr.setRequestHeader("content-type","application/x-www-form-urlencoded");
        xhr.send("code="+ +code+"&action=otp&expired="+false);
    }

});

