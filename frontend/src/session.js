export function getSession() {
    return {
        loggedIn: localStorage.getItem('loggedIn'),
        id: localStorage.getItem('id'),
        email: localStorage.getItem('email'),
        name: localStorage.getItem('name')
    }
}

export function loginSession(user) {
    localStorage.setItem('loggedIn', true);
    localStorage.setItem('id', user.id);
    localStorage.setItem('email', user.email);
    localStorage.setItem('name', user.name);
}

export function logoutSession() {
    localStorage.clear();
    location.reload();
}

export async function loginRequest(email, password) {
    return await fetch("http://localhost:8000/users/login.php", {
        method: "post",
        mode: 'cors',
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ email: email, password: password }),

    })
        .then(res => {
            if (res.ok) {
                return res.json();
            }

            else if (res.status === 401) {
                throw new Error('Invalid email or password');
            }

            else if (res.status === 404) {
                throw new Error('No user found with this email');
            }
            
            else if (res.status === 400) {
                throw new Error('No email or password provided');
            }

            else {
                throw new Error(`Unexpected status code: ${res.status}`);
            }

        })
}

export async function signupRequest(name, email, password) {
    return await fetch("http://localhost:8000/users/create.php", {
        method: "post",
        mode: 'cors',
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ email: email, name: name, password: password }),

    })
        .then(res => {
            if (res.ok) {
                return res.json();
            }

            else if (res.status === 400) {
                throw new Error('Fill in all the form fields');
            }

            else if (res.status === 409) {
                throw new Error(`User ${email} already exists`);
            }

            else if (res.status === 500) {
                throw new Error('Could not satisfy request, server error');
            }

            else {
                throw new Error(`Unexpected status code: ${res.status}`);
            }

        })
}