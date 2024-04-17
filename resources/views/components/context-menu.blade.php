@if(method_exists(static::class, 'getContextMenu'))
    <div id="contextMenu" class="z-50 min-w-[8rem] text-neutral-800 rounded-md border border-neutral-200/70 bg-white text-sm fixed p-1 shadow-md w-64" style="display: none;">
        @foreach(static::getContextMenu()->getItems() as $item)
            <div @click="contextMenuOpen=false" class="relative flex cursor-default select-none group items-center rounded px-2 py-1.5 hover:bg-neutral-100 outline-none pl-8  data-[disabled]:opacity-50 data-[disabled]:pointer-events-none">
                <span>{{ $item->getTitle() }}</span>
                <span class="ml-auto text-xs tracking-widest text-neutral-400 group-hover:text-neutral-600">⌘[</span>
            </div>
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
