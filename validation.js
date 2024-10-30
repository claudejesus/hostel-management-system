// Form validation function
function validateForm() {
    // Get form elements
    const registrationNumber = document.getElementById("registration_number");
    const firstName = document.getElementById("first_name");
    const lastName = document.getElementById("last_name");
    const gender = document.getElementById("gender");
    const email = document.getElementById("email");
    const phone = document.getElementById("telephone");
    const password = document.getElementById("password");
    let isValid = true;

    // Clear previous error messages
    document.querySelectorAll(".error").forEach(error => error.innerText = "");

    // Validate Registration Number (required)
    if (!registrationNumber.value.trim()) {
        showError(registrationNumber, "Registration Number is required.");
        isValid = false;
    }

    // Validate First Name (required)
    if (!firstName.value.trim()) {
        showError(firstName, "First Name is required.");
        isValid = false;
    }

    // Validate Last Name (required)
    if (!lastName.value.trim()) {
        showError(lastName, "Last Name is required.");
        isValid = false;
    }

    // Validate Gender (required)
    if (!gender.value) {
        showError(gender, "Gender is required.");
        isValid = false;
    }

    // Validate Email format
    if (!email.value.trim()) {
        showError(email, "Email is required.");
        isValid = false;
    } else if (!isValidEmail(email.value)) {
        showError(email, "Invalid email format.");
        isValid = false;
    }

    // Validate Phone (10 digits)
    if (!phone.value.trim()) {
        showError(phone, "Phone number is required.");
        isValid = false;
    } else if (!/^\d{10}$/.test(phone.value)) {
        showError(phone, "Phone number must be 10 digits.");
        isValid = false;
    }

    // Validate Password (8 characters minimum, 1 uppercase, 1 lowercase, 1 number)
    if (!password.value.trim()) {
        showError(password, "Password is required.");
        isValid = false;
    } else if (!isValidPassword(password.value)) {
        showError(password, "Password must be at least 8 characters, contain 1 uppercase, 1 lowercase letter, and 1 number.");
        isValid = false;
    }

    return isValid;
}

// Show error message
function showError(input, message) {
    const errorElement = input.nextElementSibling; // Assumes an error span exists right after the input
    errorElement.innerText = message;
    errorElement.classList.add("error");
}

// Email validation function
function isValidEmail(email) {
    const emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
    return emailPattern.test(email);
}

// Password validation function
function isValidPassword(password) {
    const passwordPattern = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}$/;
    return passwordPattern.test(password);
}

// Event listener to trigger validation on form submission
document.getElementById("registrationForm").addEventListener("submit", function(event) {
    if (!validateForm()) {
        event.preventDefault(); // Prevent form submission if validation fails
    }
});
