@if(method_exists(static::class, 'getContextMenu'))
    <div id="contextMenu" class="flex z-50 min-w-48 max-w-2xl text-neutral-800 rounded-md ring-1 ring-gray-950/5 transition bg-white text-sm fixed p-2 shadow-md dark:text-gray-200 dark:bg-gray-900 dark:ring-white/10" style="display: none;">
        @foreach(static::getContextMenu()->getItems() as $item)
            @if($item instanceof \Filament\Actions\Action)
                <span @class([
                    'context-menu-filament-action flex gap-x-4 select-none group justify-between rounded px-2 py-1.5 hover:bg-neutral-100 outline-none pl-8 data-[disabled]:opacity-50 data-[disabled]:pointer-events-none dark:hover:bg-white/5',
                    'mt-1' => !$loop->first
                ])>
                    {{ $item }}
                </span>
            @elseif($item instanceof \AymanAlhattami\FilamentContextMenu\ContentMenuItem)
                <a href="{{ $item->getUrl() }}" target="{{ $item->getTarget() }}" @click="contextMenuOpen=false" @class([
                    "flex gap-x-1 select-none group justify-between rounded px-2 py-1.5 hover:bg-neutral-100 outline-none  data-[disabled]:opacity-50 data-[disabled]:pointer-events-none dark:hover:bg-white/5",
                    'mt-1' => !$loop->first,
                ])>
                    <span class="flex gap-x-1">
                        @if(filled($item->getIcon()))
                            <span class="flex h-5 w-5 items-center justify-center">
                                <x-filament::icon
                                    :icon="$item->getIcon()"
                                    class="h-5 w-5 ml-auto text-xs tracking-widest text-neutral-400"/>
                            </span>
                        @endif
                        <span class="font-semibold hover:underline group-hover/link:underline group-focus-visible/link:underline text-sm text-gray-700 dark:text-gray-200">{{ $item->getTitle() }}</span>
                    </span>
                </a>
            @elseif($item instanceof \AymanAlhattami\FilamentContextMenu\ContentMenuDivider)
                <div @class([
                    "flex h-px my-1 -mx-1 bg-gray-100 dark:bg-white/5",
                    'mt-1' => !$loop->first,
                ])></div>
            @endif
        @endforeach
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var contextMenuOpen = false;
            var contextMenu = document.getElementById('contextMenu');
            var contextMenuTrigger = document.getElementsByClassName('fi-main')[0];

            contextMenuTrigger.addEventListener('contextmenu', function(event) {
                contextMenuOpen = true;
                event.preventDefault();
                contextMenu.style.opacity = '0';
                contextMenu.style.display = 'block'; // Show the context menu

                setTimeout(function() {
                    calculateContextMenuPosition(event);
                    calculateSubMenuPosition(event);
                    contextMenu.style.opacity = '1';
                }, 0); // Similar to $nextTick
            });

            document.addEventListener('click', function(event) {
                if (!contextMenu.contains(event.target)) {
                    contextMenuOpen = false;
                    contextMenu.style.display = 'none'; // Hide the context menu
                }
            });

            window.addEventListener('resize', function(event) {
                contextMenuOpen = false;
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

            function calculateSubMenuPosition(clickEvent) {
                var submenus = document.querySelectorAll('[data-submenu]');
                var contextMenuWidth = contextMenu.offsetWidth;

                submenus.forEach(function(submenu) {
                    if(window.innerWidth < (clickEvent.clientX + contextMenuWidth + submenu.offsetWidth)){
                        submenu.classList.add('left-0', '-translate-x-full');
                        submenu.classList.remove('right-0', 'translate-x-full');
                    } else {
                        submenu.classList.remove('left-0', '-translate-x-full');
                        submenu.classList.add('right-0', 'translate-x-full');
                    }

                    if(window.innerHeight < (submenu.previousElementSibling.getBoundingClientRect().top + submenu.offsetHeight)){
                        let heightDifference = (window.innerHeight - submenu.previousElementSibling.getBoundingClientRect().top) - submenu.offsetHeight;
                        submenu.style.top = heightDifference + 'px';
                    } else {
                        submenu.style.top = '';
                    }
                });
            }
        });
    </script>
@endif
