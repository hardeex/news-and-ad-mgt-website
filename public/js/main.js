
// Handling the nav menu toggle
document.getElementById('menu-toggle').addEventListener('click', function() {
    var navMenu = document.querySelector('nav');
    navMenu.classList.toggle('hidden'); // Toggle the 'hidden' class on the navigation menu
});


window.addEventListener('scroll', function() {
    var toggleMenu = document.getElementById('menu-toggle');
    var header = document.querySelector('header');
    var navMenu = document.querySelector('nav');

    // Calculate the bottom of the header and navMenu
    var headerBottom = header.getBoundingClientRect().bottom;
    var navMenuBottom = navMenu.getBoundingClientRect().bottom;

    // Check if the user has scrolled past the header or navMenu
    if (window.scrollY > headerBottom || window.scrollY > navMenuBottom) {
        toggleMenu.style.display = 'none'; // Hide toggle menu       
    } else {
        toggleMenu.style.display = 'block'; // Show toggle menu
    }
});


// // Get the scroll to top button
var scrollToTopBtn = document.getElementById("scrollToTopBtn");

// When the user scrolls down 20px from the top of the document, show the button
window.addEventListener('scroll', function() {
    if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
        scrollToTopBtn.style.display = "block";
    } else {
        scrollToTopBtn.style.display = "none";
    }
});

// When the user clicks on the button, scroll to the top of the document
scrollToTopBtn.addEventListener("click", function() {
    document.body.scrollTop = 0; // For Safari
    document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE and Opera
});


// Handling the flexibility to scroll by gesture and touch --- to be applied upon the completion of the UI
// Select the scroll container
const scrollContainer = document.querySelector('.scroll-container');

// Variables to store touch/mouse position
let isDragging = false;
let startPosition = 0;
let scrollLeft = 0;

// Event listeners for touch/mouse events
scrollContainer.addEventListener('mousedown', (e) => {
    isDragging = true;
    startPosition = e.clientX;
    scrollLeft = scrollContainer.scrollLeft;
});

scrollContainer.addEventListener('mouseup', () => {
    isDragging = false;
});

scrollContainer.addEventListener('mousemove', (e) => {
    if (!isDragging) return;
    const delta = e.clientX - startPosition;
    scrollContainer.scrollLeft = scrollLeft - delta;
});

// Prevent default behavior for touch events to avoid interference with scrolling
scrollContainer.addEventListener('touchstart', (e) => {
    isDragging = true;
    startPosition = e.touches[0].clientX;
    scrollLeft = scrollContainer.scrollLeft;
});

scrollContainer.addEventListener('touchend', () => {
    isDragging = false;
});

scrollContainer.addEventListener('touchmove', (e) => {
    if (!isDragging) return;
    const delta = e.touches[0].clientX - startPosition;
    scrollContainer.scrollLeft = scrollLeft - delta;
});


//SHOWING AND HIDDING THE OVERLAY COMPONENTS
function hideOverlay(video) {
    const overlay = video.parentElement.querySelector('.video-overlay');
    overlay.style.display = 'none';
}

function showOverlay(video) {
    const overlay = video.parentElement.querySelector('.video-overlay');
    overlay.style.display = 'flex';
}

// HANDLING THE PLAYING OF THE SHORT VIDEO
document.addEventListener("DOMContentLoaded", function() {
    var playButtons = document.querySelectorAll(".play-button");

    playButtons.forEach(function(playButton) {
        playButton.addEventListener("click", function() {
            var video = playButton.closest(".short-video-item").querySelector("video");

            if (video.paused) {
                video.play();
                video.setAttribute("controls", "controls"); // Show controls when video is playing
                playButton.style.display = "none"; // Hide play button when video is playing
            } else {
                video.pause();
            }
        });
    });
});






// THE DASHBOARD CODING
// display and hide selected tab
function openTab(event, tabName) {
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }
  document.getElementById(tabName).style.display = "block";
  event.currentTarget.className += " active";
}