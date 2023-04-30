<script>
    let hashedPassword = "";

    let terms = false;
    let email = "";
    let password = "";
    let cpassword = "";

    $: checkMatchingPasswords = password === cpassword;
    
    $: disabled = !(
        email
        && password 
        && cpassword 
        && checkMatchingPasswords
        && terms);

</script>

<h1>Create an account</h1>
<form action="https://localhost:8000/users/create.php" method="POST">
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
        pattern="^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8}$"
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

    <button disabled={disabled} type="submit">Sign up</button>
    <fieldset>
        <label for="terms">
            <input 
            bind:value={terms}
            type="checkbox" 
            id="terms" 
            name="terms" />
            I accept terms and conditions
        </label>
    </fieldset>
</form>

<style>
</style>