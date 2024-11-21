
// Validate form fields before submission
function validateForm() {
    var username = document.querySelector('input[name="username"]').value;
    var studentId = document.querySelector('input[name="studentId"]').value;
    var password = document.querySelector('input[name="password"]').value;

    // Check if any of the fields are empty
    if (username === "" || studentId === "" || password === "") {
        alert("Please fill out all fields.");
        return false;
    }

    // Check password length
    if (password.length < 6) {
        alert("Password must be at least 6 characters long.");
        return false;
    }

    // If everything is valid, return true
    return true;
}
