<script>
    export var book;

    // initially author_name is an array. we are joining all of them in a string

    var userBooks = []

    let added = userBooks.includes(book.key);

    function addBookHandler() {

        if(added) {
            userBooks.splice(userBooks.indexOf(book.key), 1)
        } else {
            userBooks.push(book.key)
        }

        added = userBooks.includes(book.key)

        console.log(userBooks)
        console.log(userBooks.includes(book.key))
    }
</script>

<div class='book-result'>
    <div class="heading">
        <p><strong>{book.title.length > 42 ? book.title.substring(0,42).concat('...') : book.title}</strong></p>
        <p>{book.author_name}</p>
    </div>


    <img src={book.cover_i === undefined ? "/src/lib/images/noimage.png" : "https://covers.openlibrary.org/b/id/"+book.cover_i+"-M.jpg"} alt="">

    <button on:click={addBookHandler}  class={added ? 'secondary' : 'secondary outline'} style="width: fit-content; align-self: center;">{added ? "Remove from readlist" : "Add to readlist"}</button>
</div>

<style>
    img {
        width: 14rem;
        object-fit: cover;
        height: 14rem;
        padding: .8rem;
        border-radius: 1.5rem;
    }

    .book-result {
        border-radius: .5rem;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        gap: 2rem;
        
        border: 1px solid lightgrey;
        height: 28rem;
    }

    .book-result:hover {
        box-shadow: rgba(149, 157, 165, 0.2) 0px 8px 24px;
        transition-duration: .2s;
    }

    .heading {
        height: 3rem;
        margin-bottom: 0;
        padding: 1rem;
    }


</style>