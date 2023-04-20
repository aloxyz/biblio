<script>
    import Logo from './Logo.svelte';

    let user = {
        email: '',
        password: '',
        cpassword: ''
    }

    
    
    let disabled = true;

    function checkDisabled() {
        if(user.email && user.password && user.cpassword) {
            disabled = false;
        } else {
            disabled = true;
        }
    }

</script>

<svelte:head>
	<title>Biblio</title>
	<meta name="description" content="Biblio" />
</svelte:head>

<section>
    <Logo/>
    <h1>Create an account</h1>
	<form action='/api/user' method="post" class="flex flex-grow flex-col gap-8 text-center">
        <input 
        bind:value={user.email}
        required
        type="email" 
        name="email" 
        id="email" 
        placeholder="john.doe@email.com"/>
        
        <input
        bind:value={user.password}
        required
        type="password" 
        name="password" 
        id="password" 
        placeholder="Password" 
        pattern="^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8}$" 
        title="Password must have a minimum of eight characters, at least one letter, one number and one special character"/>
        
        <input
        bind:value={user.cpassword}
        required
        type="password" 
        name="cpassword" 
        id="cpassword" 
        placeholder="Confirm password"/>

        
        <div class="space-x-2 self-start">
            <input name="terms" type="checkbox"/>
            <label for="terms">I accept the terms and conditions</label>
        </div>

        
        <button disabled={disabled || null} class="{disabled ? 'btn-disabled' : 'btn'}" type="submit">Sign up</button>

        <div>
        <p>Already have an account?</p>
        <a href="login">Click here to sign in</a>
        </div>

    </form>
</section>
