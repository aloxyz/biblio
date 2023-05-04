<script>
    import { addBook, removeBook, userHasBook } from "../../readlist";
    export var book;
    export var user_id;

    let key = book.key.slice(7, book.key.length);

    let isAdded;

    async function userHasBookHandler() {
        isAdded = await userHasBook(user_id, key);
    }

    userHasBookHandler();

</script>

<div class="book-result">
    <div class="heading">
        <p>
            <strong
                >{book.title.length > 42
                    ? book.title.substring(0, 42).concat("...")
                    : book.title}</strong>
        </p>
        <p>{book.author_name}</p>
    </div>

    <img
        src={book.cover_i === undefined
            ? "/src/lib/images/noimage.png"
            : "https://covers.openlibrary.org/b/id/" + book.cover_i + "-M.jpg"}
        alt=""
    />

    <button
        on:click={() => {userHasBookHandler(); isAdded ? removeBook(user_id, key) : addBook(user_id, key)}}
        class={isAdded ? "secondary" : "secondary outline"}
        style="width: fit-content; align-self: center;"
        >{isAdded ? "Remove from readlist" : "Add to readlist"}
    </button>
</div>

<style>
    img {
        width: 14rem;
        object-fit: cover;
        height: 14rem;
        padding: 0.8rem;
        border-radius: 1.5rem;
    }

    .book-result {
        border-radius: 0.5rem;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        gap: 2rem;

        border: 1px solid lightgrey;
        height: 28rem;
    }

    .book-result:hover {
        box-shadow: rgba(149, 157, 165, 0.2) 0px 8px 24px;
        transition-duration: 0.2s;
    }

    .heading {
        height: 3rem;
        margin-bottom: 0;
        padding: 1rem;
    }
</style>
