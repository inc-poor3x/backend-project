document.getElementById("login-button").addEventListener("click", function (e) {
    e.preventDefault(); // Prevent form submission
    
    const enterUsername = document.getElementById("username").value; // Get the entered username
    const enterPassword = document.getElementById("password1").value;
    const errormessage = document.getElementById("errormessage");
    const users = JSON.parse(localStorage.getItem("users"));
    
    if (users && users.length > 0) {
        for (let i = 0; i < users.length; i++) {
            const storedUsername = users[i].username; // Change to username
            const storedPassword = users[i].password;
            const storedName = users[i].name;

            if (enterUsername === storedUsername && enterPassword === storedPassword) {
                localStorage.setItem("isLoggedIn", "true");
                localStorage.setItem("name", storedName);
                window.location.href = "../homepage.html";
                return; // Exit the loop when a match is found
            }
        }
    }
    errormessage.textContent = "The username or password you entered is incorrect";
});
