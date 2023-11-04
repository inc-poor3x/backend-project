document.getElementById('login-button').addEventListener('click', function(event) {
    event.preventDefault();
    createUser();
});

function createUser() {
    var name = document.getElementById('name').value;
    var username = document.getElementById('username').value;
    var password = document.getElementById('password').value;
    var email = document.getElementById('email').value;
    var date_of_birth = document.getElementById('date_of_birth').value;
    var img = document.getElementById('img').value;



   

    var user = {
        name: name,
        username: username,
        password: password,
        email: email,
        date_of_birth: date_of_birth,
        img: img
    };
      console.log(JSON.stringify(user));
    // Make a POST request using Fetch API
    fetch('http://localhost/singup/project/home/signup.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(user)
    })
    .then(response => {
        // Handle the response from the server, if needed
        if (response.ok) {
            window.location.href = "login.html"; // Redirect upon successful submission
        } else {
            // Handle error scenarios
            throw new Error('Network response was not ok.');
        }
    })
    .catch(error => {
        // Handle and display errors
        console.error('There was a problem with the fetch operation:', error);
        // You can display an error message on the page if needed
    });
}
