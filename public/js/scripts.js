// Navbar
// document.addEventListener('DOMContentLoaded', function(event) {
//
//     // Hamburger menu
//     var navbarToggler = document.querySelectorAll('.navbar-toggler')[0];
//     navbarToggler.addEventListener('click', function(e) {
//         e.target.children[0].classList.toggle('active');
//     });
//
//     // Select the <html> element
//     var html = document.querySelectorAll('html')[0];
//
//     // Select the first element with the attribute 'data-bs-toggle-theme'
//     var themeToggle = document.querySelectorAll('*[data-bs-toggle-theme]')[0];
//
//     // Set the default theme to 'dark' for the <html> element
//     html.setAttribute('data-bs-theme', 'light');
//
//     // Check if a themeToggle element is found
//     if (themeToggle) {
//         // Add a click event listener to the themeToggle element
//         themeToggle.addEventListener('click', function(event) {
//             // Prevent the default behavior of the click event
//             event.preventDefault();
//
//             // Check the current theme attribute value of the <html> element
//             if (html.getAttribute('data-bs-theme') === 'light') {
//                 // If the current theme is 'dark', change it to 'light'
//                 html.setAttribute('data-bs-theme', 'light');
//             } else {
//                 // If the current theme is not 'dark', change it back to 'dark'
//                 html.setAttribute('data-bs-theme', 'light');
//             }
//         });
//     }
// });


$(document).ready(function() {

    $('#confirm_password').on('input', function() {
        const newPassword = $('#new_password').val();
        const confirmPassword = $('#confirm_password').val();
        const passwordError = $('#passwordError');
        const submitButton = $('#submitButton');

        if (newPassword !== confirmPassword) {
            passwordError.show();
            submitButton.prop('disabled', true);
        } else {
            passwordError.hide();
            submitButton.prop('disabled', false);
        }
    });

    // Frontend Recaptcha Error
    $(".error-message ul").each(function() {
        var errorText = $(this).text().trim(); // Get the text inside <ul>
        $(this).parent().text(errorText); // Replace .error-message content with the text
    });

});




// Diable Developer Options
// document.addEventListener("contextmenu", (event) => event.preventDefault()); // Disable right-click
// document.addEventListener("keydown", (event) => {
//     if (event.key === "F12" ||
//         (event.ctrlKey && event.shiftKey && event.key === "I") || // Ctrl+Shift+I
//         (event.ctrlKey && event.shiftKey && event.key === "J") || // Ctrl+Shift+J
//         (event.ctrlKey && event.key === "U") // Ctrl+U (view source)
//     ) {
//         event.preventDefault();
//     }
// });



