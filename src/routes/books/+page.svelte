<script>
    import BookResult from "../../lib/components/BookResult.svelte";
    async function fetchBooks(queryString) {
        var url = new URL("https://openlibrary.org/search.json");
        url.searchParams.append("q", queryString);

        const res = await fetch(url);
        const data = await res.json();

        if (res.ok) {
            return data;
        } else {
            throw new Error(data);
        }
    }

    let promise;
    let inputQueryString;

    function fetchHandler(url) {
        promise = fetchBooks(url);
        console.log(data);
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
    <button on:click={() => fetchHandler(inputQueryString)}>Search</button>
</section>

{#if promise != undefined}
    {#await promise}
        <progress></progress>
    {:then data}
        <p>Found {data.numFound} books</p>

        <section id='result-page'>
            {#each data.docs as book}
                {#if book.title != "Undefined" && book.title != "undefined" && book.author_name != "Undefined" && book.author_name != "undefined"}
                <section>
                    <BookResult title={book.title} author={book.author} cover={book.cover_i}/>

                </section>    
                {/if}
            {/each}
        </section>

    {/await}
{/if}

<style>
    #result-page {
        display: grid;
        grid-template-columns: repeat(auto-fill, 14rem);
        gap: 1.5rem;
    }
</style>