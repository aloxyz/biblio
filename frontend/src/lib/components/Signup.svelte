<script>
    import {
        loginRequest,
        signupRequest,
    } from "../../session.js";
    let hashedPassword = "";

    let terms = false;
    let name = "";
    let email = "";
    let password = "";
    let cpassword = "";

    $: checkMatchingPasswords = password === cpassword;

    $: buttonDisabled = !(
        name &&
        email &&
        password &&
        cpassword &&
        checkMatchingPasswords &&
        terms
    );

    let errorMessage;
    $: formMessage = errorMessage;

    async function submitHandler() {
        await signupRequest(name, email, password)
        .then(loginRequest(email, password))
        .then(window.location.href = "/books")
        .catch(e => errorMessage = e)
    }

</script>

<h1>Create an account</h1>
{#if formMessage}
    <section>
        <mark>{formMessage}</mark>

    </section>
{/if}
<form on:submit={submitHandler}>
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

    <button {buttonDisabled} type="submit">Sign up</button>
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
