@if(method_exists(static::class, 'getContextMenu'))
    <div id="contextMenu" class="flex z-50 min-w-48 max-w-2xl text-neutral-800 rounded-md ring-1 ring-gray-950/5 transition bg-white text-sm fixed p-2 shadow-md dark:text-gray-200 dark:bg-gray-900 dark:ring-white/10" style="display: none;">
        @foreach(static::getContextMenu()->getActions() as $action)
            @if($action instanceof \Filament\Actions\Action)
                <span @class([
                    'context-menu-filament-action flex gap-x-4 select-none group justify-between rounded px-2 py-1.5 hover:bg-neutral-100 outline-none pl-8 data-[disabled]:opacity-50 data-[disabled]:pointer-events-none dark:hover:bg-white/5',
                    'mt-1' => !$loop->first
                ])>
                    {{ $action }}
                </span>
            @elseif($action instanceof \AymanAlhattami\FilamentContextMenu\ContentMenuDivider)
                <div @class([
                    "flex h-px my-1 -mx-1 bg-gray-100 dark:bg-white/5",
                    'mt-1' => !$loop->first,
                ])></div>
            @endif
        @endforeach
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var contextMenu = document.getElementById('contextMenu');
            var contextMenuTrigger = document.getElementsByClassName('fi-main')[0];

            contextMenuTrigger.addEventListener('contextmenu', function(event) {
                event.preventDefault();
                contextMenu.style.display = 'block'; // Show the context menu

                setTimeout(function() {
                    calculateContextMenuPosition(event);
                }, 0); // Similar to $nextTick
            });

            document.addEventListener('click', function(event) {
                if (!contextMenu.contains(event.target)) {
                    contextMenu.style.display = 'none'; // Hide the context menu
                }
            });

            window.addEventListener('resize', function(event) {
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
