function validateEmail(email) {
    // Regular expression for email validation
    var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  
    // Check if the email matches the regex
    if (emailRegex.test(email)) {
        return true; // Email is valid
    } else {
        return false; // Email is invalid
    }
}

// Usage example
var email = "user@example.com";
if (validateEmail(email)) {
    console.log("Email is valid");
} else {
    console.log("Email is invalid");
}
