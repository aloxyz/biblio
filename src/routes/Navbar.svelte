<script>
    import Icon from "@iconify/svelte";

    let showSidebar = false;
</script>



{#if showSidebar}
    <button on:click={(showSidebar = true)}>
        <Icon
            icon="material-symbols:close"
            class="fill-1 fill-white w-12 cursor-pointer fixed right-0 top-0 z-50"
        />
    </button>
{:else}
    <button on:click={(showSidebar = false)}>
        <Icon
            icon="material-symbols:menu"
            class="fill-1 fill-emerald-800 w-12 cursor-pointer fixed right-0 top-0 z-50"
        />
    </button>
{/if}

<nav
    class="{showSidebar
        ? 'translate-x-0 '
        : 'translate-x-full'} top-0 right-0 w-[50vw] bg-emerald-800 p-10 text-white fixed h-full flex flex-col items-center gap-5 ease-in-out duration-300"
>
    <a href="/user" class="flex flex-col items-center hover:underline">
        <Icon icon="mdi:user-circle-outline" class="w-14 fill-1" />
        Mario Rossi
    </a>

    <ul>
        <li class="hover:underline">
            <a href="/books">
                <Icon
                    icon="material-symbols:menu-book-outline"
                    class="w-5 pb-1 inline"
                />
                Books
            </a>
        </li>

        <li class="hover:underline">
            <a href="/readlist">
                <Icon
                    icon="ic:outline-collections-bookmark"
                    class="w-5 pb-1 inline"
                />
                My readlist
            </a>
        </li>

        <li class="hover:underline">
            <a href="/settings">
                <Icon
                    icon="material-symbols:settings"
                    class="w-5 pb-1 inline"
                />
                Settings
            </a>
        </li>

        <li class="hover:underline">
            <a href="api/settings">
                <Icon icon="material-symbols:logout" class="w-5 pb-1 inline" />
                Log out
            </a>
        </li>
    </ul>
</nav>
