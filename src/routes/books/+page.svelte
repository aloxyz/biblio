<script>
    import BookResult from "../../lib/components/BookResult.svelte";
    async function fetchBooks(queryString) {
        try {
            var url = new URL("https://openlibrary.org/search.json");
            url.searchParams.append("q", queryString);

            const res = await fetch(url);
            const data = await res.json();

            if (res.ok) {
                return data;
            } else {
                throw new Error(data);
            }
        } catch (e) {
            console.log("error while fetching books: "+e)
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
    {:then data}
        <p>Found <strong>{data.numFound}</strong> books</p>

        <section id="result-page">
            {#each data.docs.filter((book) => book.title != "Undefined" && book.title != "undefined" && book.title != undefined) as book}
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
