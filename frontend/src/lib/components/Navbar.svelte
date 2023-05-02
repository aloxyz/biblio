<script>
    import { onMount } from "svelte";
    import { getSession, logoutSession } from "../../session";

    let user_id, loggedIn;
    onMount(() => {
        loggedIn = getSession().loggedIn;

        if (loggedIn) {
            user_id = getSession().id;
        }
    });
</script>

<nav>
    <ul>
        <li><a href="/" class="secondary"><strong>Biblio</strong></a></li>
    </ul>
    <ul>
        {#if loggedIn}
            <li><a href="user?id={user_id}" class="secondary">My readlist</a></li>
            <li><a href="books" class="secondary">Books</a></li>
            <li><a on:click={logoutSession} href="/" class="secondary">Logout</a></li>
        {:else}
            <li><a href="account" class="secondary">Login</a></li>
        {/if}
    </ul>
</nav>

<style>
    nav {
        position: fixed;
        width: 100%;
        top: 0;
        overflow: hidden;
        backdrop-filter: blur(10px);

        border-bottom: 1px solid lightgrey;
        margin-bottom: 2rem;

        padding: 0 2rem 0 2rem;
    }
</style>
