* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Poppins', sans-serif;
}

body {
    background: linear-gradient(to bottom, rgb(211, 203, 241), rgb(205, 232, 241));
    overflow-x: hidden;
}

/* NAVBAR */
.navbar {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 10px 5%;
    background: rgb(27, 78, 87);
    color: white;
}

.logo {
    height: 80px;
    width: 80px;
    border-radius: 50%;
    cursor: pointer;
}

.navbar h1 {
    font-size: 28px;
    color: rgb(201, 228, 241);
    cursor: pointer;
}

nav ul {
    display: flex;
    list-style: none;
}

nav ul li {
    margin: 0 15px;
    position: relative;
}

nav ul li a {
    text-decoration: none;
    font-size: 18px;
    color: white;
    font-weight: 600;
    transition: color 0.3s;
}

nav ul li a:hover {
    color: rgb(39, 159, 228);
}

nav ul li::after {
    content: "";
    height: 3px;
    width: 0%;
    background: rgb(201, 228, 241);
    position: absolute;
    left: 0;
    bottom: -5px;
    transition: width 0.4s;
}

nav ul li:hover::after {
    width: 100%;
}

/* ACTIVE LINK */
.active::after {
    content: "";
    height: 3px;
    width: 100%;
    background: rgb(201, 228, 241);
    position: absolute;
    left: 0;
    bottom: -5px;
}

/* BUTTONS */
.btn {
    padding: 8px 20px;
    font-size: 16px;
    font-weight: bold;
    background: rgb(201, 228, 241);
    color: rgb(27, 78, 87);
    border: none;
    border-radius: 20px;
    cursor: pointer;
    transition: background 0.3s, color 0.3s;
}

.btn:hover {
    background: rgb(27, 78, 87);
    color: white;
}

/* FORM CONTAINER */
.form-container {
    background: white;
    width: 350px;
    padding: 20px;
    margin: 40px auto;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    text-align: center;
}

.form-container span {
    font-weight: bold;
    padding: 0 10px;
    color: #555;
    cursor: pointer;
}

form input {
    width: 100%;
    padding: 10px;
    margin: 10px 0;
    border: 1px solid #ccc;
    border-radius: 5px;
}

.btn-losi {
    width: 100%;
    padding: 10px;
    font-weight: bold;
    background: rgb(109, 159, 201);
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background 0.3s;
}

.btn-losi:hover {
    background: rgb(27, 78, 87);
    color: white;
}

/* RULES SECTION */
#rules {
    padding: 40px;
    background-color: aliceblue;
}

#rules h1 {
    text-align: center;
    color: rgb(5, 85, 85);
}

#rules ul {
    padding-left: 50px;
}

#rules li {
    font-size: 18px;
    margin: 10px 0;
    font-weight: bold;
}

/* FOOTER */
footer {
    background: rgb(27, 78, 87);
    color: white;
    padding: 20px;
    text-align: center;
}

footer .main-content {
    display: flex;
    justify-content: space-between;
    flex-wrap: wrap;
}

footer .box {
    flex: 1;
    padding: 20px;
}

footer .box h2 {
    font-size: 18px;
    margin-bottom: 10px;
    font-weight: bold;
    text-transform: uppercase;
}

footer .box p {
    font-size: 14px;
    line-height: 1.5;
}

.copyright {
    background: rgb(51, 123, 133);
    padding: 10px;
    font-size: 14px;
}
