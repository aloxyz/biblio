<script>
    import Book from "../../lib/components/Book.svelte";
    import { page } from "$app/stores";
    import { getUser, getBook, getReadlist } from "../../user";

    const user_id = $page.url.searchParams.get("id");

    let user = null;
    let readlist = null;
    let error = null;

    async function loadData() {
        try {
            user = await getUser(user_id);
            readlist = await getReadlist(user_id);
            
        } catch (e) {
            error = e.message;
        }
        
    }

    $: loadData();
</script>

{#if error}
    <mark>{error}</mark>
{:else if user && readlist}
    <section>
        <header>
            <h1>{user.name}</h1>
        </header>

        {#if readlist.length > 0}
            <section>
                <hgroup>
                    <h2>Readlist</h2>
                    <p>{readlist.length} books in readlist</p>
                </hgroup>
                <section id="result-page">
                {#each readlist as record}
                        {#await getBook(record.book_olid)}
                            <progress />
                        {:then book}
                            {(book.author_name = "")}
                            <Book {book} {user_id}/>
                        {/await}
                {/each}
                </section>

            </section>
        {:else}
            <mark>No books in readlist</mark>
        {/if}
    </section>
{:else}
    <progress />
{/if}

