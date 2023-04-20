<script>
    import Spinner from "../../lib/components/Spinner.svelte";

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
        placeholder="Lord of the rings"
        bind:value={inputQueryString}
    />
    <button on:click={() => fetchHandler(inputQueryString)}>Search</button>
</section>

{#if promise != undefined}
    {#await promise}
        <Spinner />
    {:then data}
        <p>Found {data.numFound} books</p>

        {#each data.docs as book}
            {#if book.title != "Undefined" && book.title != "undefined"}
                <p>{book.title}</p>
            {/if}
        {/each}
    {/await}
{/if}
