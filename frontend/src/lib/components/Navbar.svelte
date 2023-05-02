<script>
    import { logoutSession } from "../../session";

</script>
<nav>
    <ul>
        <li><a href="/" class="secondary"><strong>Biblio</strong></a></li>
    </ul>
    <ul>
        <li><a href="users" class="secondary">My readlist</a></li>
        <li><a href="books" class="secondary">Books</a></li>
        <li><a on:click={logoutSession} href="/" class="secondary">Logout</a></li>
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