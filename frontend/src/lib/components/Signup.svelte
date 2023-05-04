<script>
    import { loginRequest, signupRequest, loginSession } from "../../session.js";

    let terms = false;
    let name = "";
    let email = "";
    let password = "";
    let cpassword = "";

    let checkMatchingPasswords;
    $: checkMatchingPasswords = password === cpassword;

    let buttonDisabled;
    $: buttonDisabled = !(
        name &&
        email &&
        password &&
        cpassword &&
        checkMatchingPasswords &&
        terms === true
    );

    let errorMessage;
    $: formMessage = errorMessage;


    async function submitHandler() {
        try {
            await signupRequest(name, email, password)
            let loginResponse = await loginRequest(email, password); // Successful login return user data
            loginSession(loginResponse); // Store user data in localStorage
            window.location.href = "/books" 
        } 
        
        catch (e) {
            errorMessage = e;
        }
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
        minlength="3"
        maxlength="16"
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
        minlength="8"
        maxlength="24"
        title="Password must have a minimum of eight characters, at least one letter and one number"
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

    <button disabled={buttonDisabled} type="submit">Sign up</button>
    <fieldset>
        <label for="terms">
            <input bind:checked={terms} type="checkbox" id="terms" name="terms" />
            I accept terms and conditions
        </label>
    </fieldset>
</form>



<style>
</style>
