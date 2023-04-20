<script>
    import BookResult from "../../lib/components/BookResult.svelte";
    
    async function fetchBooks(queryString) {
            var url = new URL("https://openlibrary.org/search.json");
            url.searchParams.append("q", queryString);
            url.searchParams.append("sort", 'new');

            const res = await fetch(url);

            if (res.ok) {
                const data = await res.json();
                let filteredData = data.docs.slice(0,50).filter((book) => book.title != "Undefined" && book.title != "undefined" && book.title != undefined); //&& book.cover_i != undefined
                return filteredData;
            }
    }

    let promise;
    let inputQueryString;

    function fetchHandler(url) {
        promise = fetchBooks(url);
    }
</script>

<section>
    <input
        type="search"
        name="search"
        id="search"
        placeholder="Search..."
        bind:value={inputQueryString}
    />
    <button
        disabled={inputQueryString ? false : true}
        on:click={() => fetchHandler(inputQueryString)}>Search</button
    >
</section>

{#if promise != undefined}
    {#await promise}
        <progress />
    {:then books}
        <p>Found <strong>{books.length}</strong></p>

        <section id="result-page">
            {#each books as book}
                <section>
                    <BookResult
                        title={book.title}
                        author={book.author_name}
                        cover={book.cover_i}
                    />
                </section>
            {/each}
        </section>
    {/await}
{/if}

<style>
    #result-page {
        display: grid;
        grid-template-columns: repeat(auto-fill, 14rem);
        align-items: center;
        gap: 1.5rem;
    }
</style>
