<script>
    export let title;
    export let author;
    export let cover;

</script>

<div class='book-result'>
    <hgroup>
        <p><strong>{title.length > 42 ? title.substring(0,42).concat('...') : title}</strong></p>
        <p>{author ? author : 'Unknown author'}</p>
    </hgroup>

    <img src={cover === undefined ? "/src/lib/images/noimage.png" : "https://covers.openlibrary.org/b/id/"+cover+"-M.jpg"} alt="">

    <button class='secondary outline' style="width: fit-content; align-self: center;">Add to readlist</button>
</div>

<style>
    img {
        width: 14rem;
        object-fit: cover;
        height: 14rem;
        padding: .8rem;
    }

    .book-result {
        border-radius: .5rem;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        gap: 2rem;
        
        box-shadow: rgba(149, 157, 165, 0.2) 0px 8px 24px;
        height: 28rem;
    
    }

    hgroup {
        height: 3rem;
        margin-bottom: 0;
        padding: .5rem;
    }


</style>