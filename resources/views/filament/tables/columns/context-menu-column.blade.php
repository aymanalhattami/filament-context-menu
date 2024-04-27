@if($isContextMenuEnabled())
    <div
        {{--  wire:ignore is to fix the problem of the dropdown menu not showing when modal does not shown --}}
        wire:ignore
        x-data="contextMenuComponent()"
        x-init="init()"
        @contextmenu="contextMenuToggle($event)"
        @close-other-menus.window="handleCloseOtherMenus($event)"
        @close-children-context-menu.window="contextMenuOpen = false"
        class="relative w-full">

    <div>
        @include($getMainView())
    </div>

        <template x-teleport="body">
            <div x-show="contextMenuOpen" @click.away="contextMenuOpen = false" x-ref="contextmenu" class="z-50 min-w-48 max-w-2xl text-neutral-800 rounded-md ring-1 ring-gray-950/5 transition bg-white text-sm fixed p-2 shadow-md dark:text-gray-200 dark:bg-gray-900 dark:ring-white/10" x-cloak>
                @foreach($getContextMenuActions() as $action)
                    @if($action->isVisible())
                        @if($action instanceof \AymanAlhattami\FilamentContextMenu\ContextMenuDivider)
                            <x-filament-context-menu::divider />
                        @endif

                        @if($action instanceof Filament\Tables\Actions\Action and !$action instanceof \AymanAlhattami\FilamentContextMenu\ContextMenuDivider)
                            @if($action->isVisible())
                                <div @class([
                            'context-menu-filament-action flex gap-x-4 select-none group justify-between rounded px-2 py-1.5 hover:bg-neutral-100 outline-none pl-8 data-[disabled]:opacity-50 data-[disabled]:pointer-events-none dark:hover:bg-white/5',
                            'mt-1' => !$loop->first
                        ])>
                                    {{ $action }}
                                </div>
                            @endif
                        @endif
                    @endif
                @endforeach
            </div>
        </template>
    </div>

    <script>
        function contextMenuComponent() {
            return {
                contextMenuOpen: false,

                contextMenuToggle: function(event) {
                    event.preventDefault();
                    event.stopPropagation();
                    this.contextMenuOpen = true;
                    this.$refs.contextmenu.style.opacity = 0;

                    this.$dispatch('close-other-menus', { id: this.$el });
                    this.$dispatch('close-parent-context-menu', { id: this.$el });

                    this.$nextTick(() => {
                        this.$refs.contextmenu.style.opacity = 1;
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
                    // document.addEventListener('close-children-context-menu', () => { this.contextMenuOpen = false; });
                }
            }
        }
    </script>

@else
    <div>
        @include($getMainView())
    </div>
@endif
