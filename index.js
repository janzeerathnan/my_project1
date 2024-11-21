
// JavaScript function to validate login forms
function validateForm(formType) {
    let idField, passwordField;

    if (formType === 'student') {
        idField = document.querySelector('[name="studentId"]');
        passwordField = document.querySelector('[name="studentPassword"]');
    } else if (formType === 'admin') {
        idField = document.querySelector('[name="adminId"]');
        passwordField = document.querySelector('[name="adminPassword"]');
    }

    if (idField.value === "" || passwordField.value === "") {
        alert("Both fields are required.");
        return false;
    }
    return true;
}

// Toggle password visibility
function togglePasswordVisibility(id) {
    const passwordField = document.getElementById(id);
    const currentType = passwordField.type;

    // Toggle between password and text type
    if (currentType === "password") {
        passwordField.type = "text";
    } else {
        passwordField.type = "password";
    }
}

// Switch between login forms (Student vs Admin)
function toggleLoginForm(formType) {
    const studentLoginForm = document.querySelector('.student-login');
    const adminLoginForm = document.querySelector('.admin-login');

    if (formType === 'student') {
        studentLoginForm.style.display = 'block';
        adminLoginForm.style.display = 'none';
    } else {
        studentLoginForm.style.display = 'none';
        adminLoginForm.style.display = 'block';
    }
}
