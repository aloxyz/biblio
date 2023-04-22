<script>
    import { loop_guard } from "svelte/internal";
    import BookResult from "../../lib/components/BookResult.svelte";
    // TUTTO IL LAVORO DI FILTRAGGIO CHE AVVIENE IN QUESTO FILE
    // VERRÀ FATTO DAL BACKEND

    function filterBooks(books, n) {
        // Get N books, then return a filtered books array
        return books.docs
            .slice(0, n)
            .filter(
                (book) =>
                    book.title !== "Undefined" ||
                    book.title != undefined ||
                    book.author_name != undefined
            );
    }

    async function fetchBooks(queryString, n) {
        // Create URL object and append
        var url = new URL("https://openlibrary.org/search.json");
        url.searchParams.append("q", queryString);
        //url.searchParams.append("sort", 'new');

        // Fetch response
        return fetch(url)
            .then((res) => {
                if (!res.ok) throw new Error(`Fetch error: ${res.status}`);
                return res;
            })
            .then((res) => res.json())
            .then((data) => {
                return filterBooks(data, n);
            })
            .catch((e) => console.error(e.message));
    }

    let inputQueryString, promise;

    function fetchHandler() {
        promise = fetchBooks(inputQueryString, 50);
        inputQueryString = undefined;
    }
</script>

<section>
    <input
        type="search"
        id="search"
        placeholder="Search..."
        bind:value={inputQueryString}
        on:keydown={(e) =>
            e.keyCode === 13 ? fetchHandler(inputQueryString) : null}
    />
    <button
        disabled={inputQueryString ? false : true}
        on:click={() => fetchHandler(inputQueryString)}>Search</button
    >
</section>

<section>
    {#if promise != undefined}
        {#await promise}
            <progress />
        {:then books}
            <p>Found <strong>{books.length}</strong></p>

            <section id="result-page">
                {#each books as book}
                    <BookResult {book} />
                {/each}
            </section>
        {/await}
    {/if}
</section>

<style>
    #result-page {
        display: grid;
        grid-template-columns: repeat(auto-fill, 14rem);
        align-items: center;
        justify-content: center;
        gap: 1.5rem;
    }
</style>
