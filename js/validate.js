const validation = new JustValidate("#signup");

validation
.addField("#name", [
    {
        rule: "required",
        errorMessage: "Name is required"
    }
])
.addField("#email", [
    {
        rule: "required",
        errorMessage: "Email is required"
    },
    {
        rule: "email",
        errorMessage: "Email is invalid"
    }
])
.addField("#password", [
    {
        rule: "required"
    },
    {
        rule: "password",
        errorMessage: "Password must contain at least 8 characters long"
    }
])
.addField("#password_confirmation", [
    {
        validator: (value, fields) => {
            return value === fields["#password"].elem.value;
        },
        errorMessage: "Passwords must match"
    }
])
.onSuccess((event) => {
    document.getElementById("signup").submit();
});

