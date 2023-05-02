<script>
    import Signup from "../../lib/components/Signup.svelte";
    import Login from "../../lib/components/Login.svelte";
    import { getSession } from "../../session";
    import { onMount } from 'svelte';
    
    let checked = true;
    let loggedIn;
    onMount(() => {
        loggedIn = getSession().loggedIn
        if (loggedIn) window.location.href = '/books';
    });

</script>

{#if !loggedIn}
    <article style="text-align: center;">
        <label for="signup-switch">
            <input
                bind:checked
                type="checkbox"
                role="switch"
                name="signup-switch"
                id="signup-switch"
            />
            {checked ? "Signup" : "Login"}
        </label>
        {#if checked}
            <Signup />
        {:else}
            <Login />
        {/if}
    </article>
{/if}