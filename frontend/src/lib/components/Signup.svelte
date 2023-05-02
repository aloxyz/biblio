<script>
    let hashedPassword = "";

    let terms = false;
    let name = "";
    let email = "";
    let password = "";
    let cpassword = "";

    $: checkMatchingPasswords = password === cpassword;

    $: disabled = !(
        name &&
        email &&
        password &&
        cpassword &&
        checkMatchingPasswords &&
        terms
    );

    function postData() {
        return fetch("http://localhost:8000/users/create.php", {
            method: "post",
            mode: 'cors',
            headers: {
                "Content-Type": "application/json",
            },
            body: JSON.stringify({name: name, email: email, password: password}),
            
        })
        .then((res) => {
            return res.json();
        })
        .catch(e => console.error(e))
    }

</script>

<h1>Create an account</h1>
<form on:submit={postData}>
    <input
    bind:value={name}
    required
    type="text"
    name="name"
    id="name"
    placeholder="Nickname"
    />

    <input
        bind:value={email}
        required
        type="email"
        name="email"
        id="email"
        placeholder="john.doe@email.com"
    />

    <input
        bind:value={password}
        required
        type="password"
        name="password"
        id="password"
        placeholder="Password"
        title="Password must have a minimum of eight characters, at least one letter, one number and one special character"
    />

    <input
        aria-invalid={!checkMatchingPasswords ? true : null}
        bind:value={cpassword}
        required
        type="password"
        name="cpassword"
        id="cpassword"
        placeholder="Confirm password"
    />

    <button {disabled} type="submit">Sign up</button>
    <fieldset>
        <label for="terms">
            <input bind:value={terms} type="checkbox" id="terms" name="terms" />
            I accept terms and conditions
        </label>
    </fieldset>
</form>

<!-- pattern="^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8}$" -->

<style>
</style>
