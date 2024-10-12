const prizes = [
  {
    id: 0,
    msg: "0",
  },
  {
    id: 1,
    msg: "10",
  },
  {
    id: 2,
    msg: "300",
  },
  {
    id: 3,
    msg: "50",
  },
  {
    id: 4,
    msg: "150",
  },
  {
    id: 5,
    msg: "200",
  },
  {
    id: 6,
    msg: "400",
  },
  {
    id: 7,
    msg: "1",
  },
  {
    id: 8,
    msg: "500",
  },
  {
    id: 9,
    msg: "-1",
  },
  {
    id: 10,
    msg: "250",
  },
  {
    id: 11,
    msg: "100",
  },
];

var activeBtn = false;
var audio = new Audio("./account/landing_page_images/assets/wheel-audio.mp3");

function randomNum() {
  var prizeNum = Math.random() * 12;
  prizeNum = Math.floor(prizeNum);
  console.log(prizeNum);
  return prizeNum;
}

// console.log(prizeNum);

function removeClass() {
  prize = randomNum();

  document.getElementById("spinner").classList.remove("spin");
  document.getElementById("spin-btn").classList.remove("disabled");
  //   document.getElementById("spinner").classList.add("shake");

  document.getElementById("spinner").style.transform =
    "rotate(" + prize * 30 + "deg)";

  $(".pop-up-content").fadeIn();

  setTimeout(function () {
    document.getElementById("spin-btn").disabled = false;
    document.getElementById("arrow").classList.add("float");
    activeBtn = false;
  }, 2000);

  prizeText = prizes[prize].msg;

  // console.log("Current Prize Amount is: " +prizeText);
  sessionStorage.setItem("prizeAmount", prizeText);


  document.getElementsByClassName("pop-up-para")[0].innerHTML = prizeText;
  document.getElementById("reward_tokens").value = prizeText;
  $(".pop-up").fadeIn();
}

function spin() {
  activeBtn = true;
  audio.play();

  //   document.getElementById("spinner").classList.remove("shake");
  document.getElementById("arrow").classList.remove("float");
  document.getElementById("spinner").classList.add("spin");
  document.getElementById("spin-btn").disabled = true;

  setTimeout(removeClass, 5000);
}
activeBtn = false;

document.addEventListener("keydown", (event) => {
  console.log(event);
  if (event.key === " " && activeBtn === false) {
    $("#spin-btn").trigger("click");
  }
});


// COUNTDOWN
function makeTimer() {

  var endTime = new Date("August 26, 2025 00:00:00 PDT");     
  var endTime = (Date.parse(endTime)) / 1000;

  var now = new Date();
  var now = (Date.parse(now) / 1000);

  var timeLeft = endTime - now;

  var days = Math.floor(timeLeft / 86400); 
  var hours = Math.floor((timeLeft - (days * 86400)) / 3600);
  var minutes = Math.floor((timeLeft - (days * 86400) - (hours * 3600 )) / 60);
  var seconds = Math.floor((timeLeft - (days * 86400) - (hours * 3600) - (minutes * 60)));

  if (hours < "10") { hours = "0" + hours; }
  if (minutes < "10") { minutes = "0" + minutes; }
  if (seconds < "10") { seconds = "0" + seconds; }

  $("#days").html(days + "<span> D</span>");
  $("#hours").html(hours + "<span> H</span>");
  $("#minutes").html(minutes + "<span> Min</span>");
  $("#seconds").html(seconds + "<span> Sec</span>");   

}

setInterval(function() { makeTimer(); }, 1000);
// COUNTDOWN



// START BACKGROUND ANIMATION
const background = document.querySelector('.background');

// Function to generate random circles
function createCircle() {
  const circle = document.createElement('div');
  circle.classList.add('circle');

  // Random size between 10px and 50px
  const size = Math.random() * 40 + 10;
  circle.style.width = `${size}px`;
  circle.style.height = `${size}px`;

  // Random horizontal position across the screen
  const posX = Math.random() * window.innerWidth;
  circle.style.left = `${posX}px`;

  // Random animation duration between 3s and 10s
  const duration = Math.random() * 7 + 3;
  circle.style.animationDuration = `${duration}s`;

  // Append circle to the background container
  background.appendChild(circle);

  // Remove circle after animation is complete
  setTimeout(() => {
    circle.remove();
  }, duration * 1000);
}

// Generate circles at random intervals
setInterval(createCircle, 300);

// END BACKGROUND ANIMATION



// START REWARD JAVASCRIPT
document.addEventListener('DOMContentLoaded', () => {
  const claimButtons = document.querySelectorAll('.claim-button');
  const totalPointsDiv = document.getElementById('total-points');
  let totalPoints = 0;

  // For social media claim buttons
  claimButtons.forEach(button => {
      const points = parseInt(button.getAttribute('data-points'));
      const waitTime = parseInt(button.getAttribute('data-wait-time'));
      const url = button.getAttribute('data-url');
      
      // Add event listener for initial "Follow" button click
      button.addEventListener('click', () => {
          if (!button.classList.contains('visited')) {
              window.open(url, '_blank');  // Open the social media link on the first click
              button.classList.add('visited'); // Mark the button as visited
              button.classList.add('disabled'); // Disable the button during loading
              button.textContent = '';  // Clear the button text

              // Add a loading spinner
              const loader = document.createElement('div');
              loader.classList.add('loader');
              button.appendChild(loader);

              // After the wait time (5s or 2 minutes for YouTube), allow the user to claim points
              setTimeout(() => {
                  button.classList.remove('disabled');
                  button.removeChild(loader);
                  button.textContent = `Claim ${points} Points`;  // Show claim button

                  // Add a new event listener for claiming the points after loading
                  button.addEventListener('click', claimPoints);

              }, waitTime);
          } else {
              // If already visited, directly enable claiming points without redirection
              claimPoints();
          }
      });

      // Function to handle point claiming
      function claimPoints() {
          if (!button.classList.contains('claimed')) {
              totalPoints += points;  // Add points to total
              totalPointsDiv.textContent = `Total Points: ${totalPoints}`;  // Update points display
              button.textContent = 'Claimed';  // Update button text
              button.classList.add('claimed');  // Mark as claimed
              button.classList.add('disabled');  // Disable the button
              button.removeEventListener('click', claimPoints);  // Remove event listener after claiming
          }
      }
  });

  // For the URL input field claim
  const claimUrlBtn = document.getElementById('claim-url-btn');
  const urlInput = document.getElementById('url-input');
  
  claimUrlBtn.addEventListener('click', () => {
      const pastedUrl = urlInput.value.trim();

      // Check if the pasted URL is the required one
      if (pastedUrl === 'https://www.w3schools.com/') {
          claimUrlBtn.textContent = 'Claimed 200 Points';  // Update button text
          claimUrlBtn.classList.add('disabled');  // Disable the button after claiming
          totalPoints += 200;  // Add 200 points
          totalPointsDiv.textContent = `Total Points: ${totalPoints}`;  // Update points display
      } else {
          alert('Invalid URL. Please paste the correct link: https://www.w3schools.com/');
      }
  });
});

// END REWARD JAVASCRIPT


// START "COPY" JAVASCRIPT
function myFunction() {
  // Get the text field
  var copyText = document.getElementById("myInput");

  // Select the text field
  copyText.select();
  copyText.setSelectionRange(0, 99999); // For mobile devices

  // Copy the text inside the text field
  navigator.clipboard.writeText(copyText.value);

  // Alert the copied text
  alert("Copied the text: " + copyText.value);
}
// END "COPY" JAVASCRIPT