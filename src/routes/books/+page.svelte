<script>
    import Spinner from "../../lib/components/Spinner.svelte";

    async function fetchBooks(url) {
        const res = await fetch(url);
        const data = await res.json();

        if (res.ok) {
            return data;
        } else {
            throw new Error(data);
        }
    }

    const url = "https://openlibrary.org/search.json?q=the+lord+of+the+rings";

    let promise = fetchBooks(url);
</script>


{#await promise}
    <Spinner/>
{:then data}
    <p>{JSON.stringify(data)}</p>
{/await}



