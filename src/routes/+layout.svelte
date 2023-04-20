<script>
	import Navbar from '../lib/components/Navbar.svelte';
    import '@picocss/pico'

    import "../app.css";
</script>

<Navbar></Navbar>
<div class="app container-fluid">
    

	<main class='container' style="margin-top: 5rem;">
		<slot />
	</main>

    <!-- <footer class="container-fluid">
        <p style="text-align: center">Made by Gabriele Aloisio</p>
    </footer> -->
</div>

