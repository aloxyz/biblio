<script>
    import BookResult from "../../lib/components/BookResult.svelte";

    async function fetchBooks(queryString, n) {
        // Create URL object and append
        var url = new URL("http://localhost:8000/search.php");
        url.searchParams.append("query", queryString);

        // Fetch response
        return fetch(url)
            .then((res) => {
                if (!res.ok) throw new Error(`Fetch error: ${res.status}`);
                return res;
            })
            .then((res) => {
                return res.json();
            })
            .catch((e) => console.error(e.message));
    }

    let inputQueryString, promise;
    let queriesNumber = 30;

    function fetchHandler() {
        promise = fetchBooks(inputQueryString, queriesNumber);
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
    <input bind:value={queriesNumber} type="number" name="queries" id="queries" step="10" min='10' max='100' placeholder="Number or queries">
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
