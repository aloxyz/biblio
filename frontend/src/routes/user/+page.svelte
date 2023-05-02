<script>
    import BookResult from "../../lib/components/BookResult.svelte";
    import { page } from '$app/stores';
    import { getSession } from "../../session";


    const user_id = $page.url.searchParams.get('id');

    function getUser(id) {
        var url = new URL("http://localhost:8000/users/read.php");
        url.searchParams.append("id", id);

        return fetch(url)
            .then((res) => {
                if (!res.ok) throw new Error(`API error: ${res.status}`);
                return res;
            })
            .then((res) => {
                return res.json();
            })
            .catch((e) => console.error(e.message));
    }

    function getReadlist(user_id) {
        var url = new URL("http://localhost:8000/readlists/read.php");
        url.searchParams.append("user_id", user_id);

        return fetch(url)
            .then((res) => {
                if (!res.ok) throw new Error(`API error: ${res.status}`);
                return res;
            })
            .then((res) => {
                return res.json();
            })
            .catch((e) => console.error(e.message));
    }

    function getBook(olid) {
        var url = new URL("http://localhost:8000/books.php");
        url.searchParams.append("olid", olid);

        return fetch(url)
            .then((res) => {
                if (!res.ok) throw new Error(`API error: ${res.status}`);
                return res;
            })
            .then((res) => {
                return res.json();
            })
            .catch((e) => console.error(e.message));
    }
</script>

{#await getUser(user_id)}
    <progress />
{:then user}
    <section>
        <header>
            <h1>{user.name}</h1>
        </header>

        {#await getReadlist(user_id)}
            <progress />
        {:then readlist}
            <section>
                <h2>Readlist</h2>
                {#each readlist as record}
                    <section id="result-page">
                        {#await getBook(record.book_olid)}
                            <progress />
                        {:then book}
                            {book.author_name = ""}
                            <BookResult book={book}></BookResult>
                        {/await}
                    </section>
                {/each}
            </section>
        {/await}
    </section>
{/await}
