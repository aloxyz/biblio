<script>
    import { getSession, loginRequest, loginSession } from '../../session.js';

    let email = "";
    let password = "";

    $: disabled = !(email && password);

    let errorMessage;
    $: formMessage = errorMessage;

    async function submitHandler() {
        try {
            let loginResponse = await loginRequest(email, password); // Successful login return user data
            loginSession(loginResponse); // Store user data in localStorage
            window.location.href='/books';
        }

        catch (e) {
            errorMessage = e;
        }
    }

</script>

<h1>Welcome back</h1>
{#if formMessage}
    <section>
        <mark>{formMessage}</mark>

    </section>
{/if}

<form on:submit={submitHandler}>
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

    <button disabled={disabled} type="submit">Sign up</button>
    <fieldset>
        <label for="terms">
            <input type="checkbox" id="terms" name="terms" />
            Remember me
        </label>
    </fieldset>
</form>

<!-- pattern="^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8}$" -->