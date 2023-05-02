<script>
    import Signup from "../../lib/components/Signup.svelte";
    import Login from "../../lib/components/Login.svelte";

    import { getSession } from "../../session";

    import { onMount } from 'svelte';

    onMount(() => {
        if(getSession().loggedIn) {
            window.location.href='/books';
        }
    })

    let checked = false;
</script>

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
