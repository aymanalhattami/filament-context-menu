<div x-data="contextMenuComponent()"
     x-init="init()"
     @contextmenu="contextMenuToggle($event)"
     @close-other-menus.window="handleCloseOtherMenus($event)"
     class="relative z-50 w-full">

    <span class="cursor-default">
        @include('filament-tables::columns.text-column')
    </span>

    <template x-teleport="body">
        <div x-show="contextMenuOpen" @click.away="contextMenuOpen = false" x-ref="contextmenu" class="z-50 min-w-[8rem] text-neutral-800 rounded-md border border-neutral-200/70 bg-white text-sm fixed p-1 shadow-md w-64" x-cloak>
            <div @click="contextMenuOpen = false" class="relative flex cursor-default select-none group items-center rounded px-2 py-1.5 hover:bg-neutral-100 outline-none pl-8  data-[disabled]:opacity-50 data-[disabled]:pointer-events-none">
                <span>Back</span>
                <span class="ml-auto text-xs tracking-widest text-neutral-400 group-hover:text-neutral-600">⌘[</span>
            </div>
        </div>
    </template>
</div>

<script>
    function contextMenuComponent() {
        return {
            contextMenuOpen: false,

            contextMenuToggle: function(event) {
                event.preventDefault();
                this.contextMenuOpen = true;
                this.$dispatch('close-other-menus', { id: this.$el });

                this.$nextTick(() => {
                    this.calculateContextMenuPosition(event);
                });
            },

            calculateContextMenuPosition: function(clickEvent) {
                const menu = this.$refs.contextmenu;
                const menuHeight = menu.offsetHeight;
                const menuWidth = menu.offsetWidth;

                const top = clickEvent.clientY + menuHeight > window.innerHeight ?
                    window.innerHeight - menuHeight :
                    clickEvent.clientY;

                const left = clickEvent.clientX + menuWidth > window.innerWidth ?
                    clickEvent.clientX - menuWidth :
                    clickEvent.clientX;

                menu.style.top = `${top}px`;
                menu.style.left = `${left}px`;
            },

            handleCloseOtherMenus: function(event) {
                if (event.detail.id !== this.$el) {
                    this.contextMenuOpen = false;
                }
            },

            init: function() {
                window.addEventListener('resize', () => { this.contextMenuOpen = false; });
            }
        }
    }
</script>
