@if(method_exists(static::class, 'getContextMenuActions'))
    @if(static::isContextMenuEnabled())
        <div id="contextMenu"
             class="flex z-50 min-w-48 max-w-2xl text-neutral-800 rounded-md ring-1 ring-gray-950/5 transition bg-white text-sm fixed p-2 shadow-md dark:text-gray-200 dark:bg-gray-900 dark:ring-white/10"
             style="display: none;">
            @foreach(static::getCachedContextMenuActions() as $action)
                @if($action->isVisible())
                    @if($action instanceof \AymanAlhattami\FilamentContextMenu\ContextMenuDivider)
                        <x-filament-context-menu::divider />
                    @endif

                    @if($action instanceof \Filament\Actions\Action and !$action instanceof \AymanAlhattami\FilamentContextMenu\ContextMenuDivider)
                        <div @class([
                        'context-menu-filament-action flex gap-x-4 select-none group justify-between rounded px-2 py-1.5 hover:bg-neutral-100 outline-none pl-8 data-[disabled]:opacity-50 data-[disabled]:pointer-events-none dark:hover:bg-white/5',
                        'mt-1' => !$loop->first
                    ])>
                            {{ $action }}
                        </div>
                    @endif
                @endif
            @endforeach
        </div>

        <script>
            document.addEventListener('livewire:navigated', function () {
                var contextMenu = document.getElementById('contextMenu');
                var contextMenuTrigger = document.getElementsByClassName('fi-main')[0];

                document.addEventListener('close-parent-context-menu', function(event) {
                    contextMenu.style.display = 'none'; // Show the context menu
                    contextMenu.style.opacity = '0';
                })

                contextMenuTrigger.addEventListener('contextmenu', function (event) {
                    event.preventDefault();
                    contextMenu.style.display = 'block'; // Show the context menu
                    contextMenu.style.opacity = '0';

                    let closeChildrenContextMenu = new Event('close-children-context-menu');
                    dispatchEvent(closeChildrenContextMenu);

                    setTimeout(function () {
                        calculateContextMenuPosition(event);
                        contextMenu.style.opacity = '1';
                    }, 0); // Similar to $nextTick
                });

                document.addEventListener('click', function (event) {
                    if (!contextMenu.contains(event.target)) {
                        contextMenu.style.display = 'none'; // Hide the context menu
                    }
                });

                window.addEventListener('resize', function (event) {
                    contextMenu.style.display = 'none';
                });

                function calculateContextMenuPosition(clickEvent) {
                    var menuHeight = contextMenu.offsetHeight;
                    var menuWidth = contextMenu.offsetWidth;

                    var top = window.innerHeight < clickEvent.clientY + menuHeight ?
                        (window.innerHeight - menuHeight) : clickEvent.clientY;
                    var left = window.innerWidth < clickEvent.clientX + menuWidth ?
                        (clickEvent.clientX - menuWidth) : clickEvent.clientX;

                    contextMenu.style.top = top + 'px';
                    contextMenu.style.left = left + 'px';
                }
            });
        </script>
    @endif
@endif
