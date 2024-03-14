const form = document.querySelector('#signup-form');
const username = document.querySelector('#username');
const email = document.querySelector('#email');
const password = document.querySelector('#password');
const confirmPassword = document.querySelector('#confirm-password');

form.addEventListener('submit', (e) => {
  e.preventDefault();
  if (password.value !== confirmPassword.value) {
    alert('Passwords do not match.');
    return;
  }
  // You can add code here to send form data to a server.
  alert('Sign up successful!');
  form.reset();
});