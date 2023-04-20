<script>
    import Signup from '../../lib/components/Signup.svelte'
    import Login from '../../lib/components/Login.svelte'

    let checked = false;
</script>
    <article class="grid" style="text-align: center;">
        <div>
            <label for="signup-switch">
                <input bind:checked={checked} type="checkbox" role="switch" name="signup-switch" id="signup-switch">
                {checked ? 'Signup' : 'Login'}
            
            </label>            
            {#if checked}
            <Signup/>
            {:else}
            <Login/>
            {/if}
        </div>
    
        <div id="cover-image" />
    </article>


<style>
    #cover-image {
        background-image: url("/src/lib/images/form-cover.jpg");
        background-position: center;
        background-size: cover;
    }
</style>
