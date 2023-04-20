<script>
    export let title;
    export let author;
    export let cover;

</script>

<div class='book-result'>
    <div class="heading">
        <p><strong>{title.length > 42 ? title.substring(0,42).concat('...') : title}</strong></p>
        <p>{author.length > 42 ? author.substring(0,42).concat('...') : author}</p>
    </div>


    <img src={cover === undefined ? "/src/lib/images/noimage.png" : "https://covers.openlibrary.org/b/id/"+cover+"-M.jpg"} alt="">

    <button class='secondary outline' style="width: fit-content; align-self: center;">Add to readlist</button>
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