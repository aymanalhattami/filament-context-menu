@if(method_exists(static::class, 'getContextMenuActions'))
    @if(static::isContextMenuEnabled())
        {{-- ============================================================================ --}}
        {{-- MOBILE TOUCH SUPPORT ADDITION --}}
        {{-- ============================================================================ --}}
        {{-- The CSS classes below prevent the default browser context menu from --}}
        {{-- appearing on long-press for mobile devices. The touch event listeners --}}
        {{-- in the script section detect long-press gestures to trigger the custom --}}
        {{-- context menu. --}}
        {{-- ============================================================================ --}}
        <div id="contextMenu"
             class="flex z-50 min-w-48 max-w-2xl flex-col items-center text-neutral-800 rounded-md ring-1 ring-gray-950/5 transition bg-white text-sm fixed p-2 shadow-md dark:text-gray-200 dark:bg-gray-900 dark:ring-white/10"
             style="display: none;">

            @foreach(static::getCachedContextMenuActions() as $action)
                @if($action->isVisible())

                    @if($action instanceof \AymanAlhattami\FilamentContextMenu\ContextMenuDivider)
                        <x-filament-context-menu::divider />
                    @endif

                    @if($action instanceof \Filament\Actions\Action and !$action instanceof \AymanAlhattami\FilamentContextMenu\ContextMenuDivider)
                        <div @class([
                    'context-menu-filament-action flex max-w-md justify-center gap-x-4 select-none group rounded-sm px-2 py-1.5 hover:bg-neutral-100 outline-hidden data-disabled:opacity-50 data-disabled:pointer-events-none dark:hover:bg-white/5',
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
                
                // ============================================================================
                // MOBILE TOUCH SUPPORT ADDITION
                // ============================================================================
                // Apply CSS to prevent default mobile context menu on long-press
                // ============================================================================
                if (contextMenuTrigger) {
                    contextMenuTrigger.style.webkitTouchCallout = 'none';
                    contextMenuTrigger.style.webkitUserSelect = 'none';
                    contextMenuTrigger.style.userSelect = 'none';
                }

                // ============================================================================
                // MOBILE TOUCH SUPPORT ADDITION
                // ============================================================================
                // The following variables and functions were added to support mobile devices
                // (Android/iOS) where right-click is not available. Instead, we detect
                // long-press gestures (typically 500ms) using touch events.
                // ============================================================================
                
                var longPressTimer = null;
                var longPressDuration = 500; // milliseconds
                var touchStartX = null;
                var touchStartY = null;
                var touchMoveThreshold = 10; // pixels

                document.addEventListener('close-parent-context-menu', function(event) {
                    contextMenu.style.display = 'none'; // Show the context menu
                    contextMenu.style.opacity = '0';
                })

                // Desktop: right-click handler (original functionality)
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

                // ============================================================================
                // MOBILE TOUCH SUPPORT ADDITION
                // ============================================================================
                // Handle touchstart event - begins long-press detection timer
                // ============================================================================
                contextMenuTrigger.addEventListener('touchstart', function (event) {
                    // Prevent default browser context menu on long press
                    event.preventDefault();
                    
                    // Get the first touch point
                    var touch = event.touches[0];
                    touchStartX = touch.clientX;
                    touchStartY = touch.clientY;
                    
                    // Clear any existing timer
                    if (longPressTimer) {
                        clearTimeout(longPressTimer);
                    }
                    
                    // Start timer for long-press detection
                    longPressTimer = setTimeout(function () {
                        // Long press detected - trigger context menu
                        var syntheticEvent = {
                            clientX: touchStartX,
                            clientY: touchStartY,
                            preventDefault: function() { event.preventDefault(); },
                            stopPropagation: function() { event.stopPropagation(); }
                        };
                        
                        contextMenu.style.display = 'block';
                        contextMenu.style.opacity = '0';

                        let closeChildrenContextMenu = new Event('close-children-context-menu');
                        dispatchEvent(closeChildrenContextMenu);

                        setTimeout(function () {
                            calculateContextMenuPosition(syntheticEvent);
                            contextMenu.style.opacity = '1';
                        }, 0);
                        
                        longPressTimer = null;
                    }, longPressDuration);
                }, { passive: false });

                // ============================================================================
                // MOBILE TOUCH SUPPORT ADDITION
                // ============================================================================
                // Handle touchmove event - cancel long-press if user moves finger
                // ============================================================================
                contextMenuTrigger.addEventListener('touchmove', function (event) {
                    if (touchStartX === null || touchStartY === null) {
                        return;
                    }
                    
                    var touch = event.touches[0];
                    var deltaX = Math.abs(touch.clientX - touchStartX);
                    var deltaY = Math.abs(touch.clientY - touchStartY);
                    
                    // If user moved finger beyond threshold, cancel long-press
                    if (deltaX > touchMoveThreshold || deltaY > touchMoveThreshold) {
                        if (longPressTimer) {
                            clearTimeout(longPressTimer);
                            longPressTimer = null;
                        }
                        touchStartX = null;
                        touchStartY = null;
                    }
                });

                // ============================================================================
                // MOBILE TOUCH SUPPORT ADDITION
                // ============================================================================
                // Handle touchend event - cancel long-press timer if touch ends early
                // ============================================================================
                contextMenuTrigger.addEventListener('touchend', function (event) {
                    // Clear the long-press timer if touch ends before duration
                    if (longPressTimer) {
                        clearTimeout(longPressTimer);
                        longPressTimer = null;
                    }
                    touchStartX = null;
                    touchStartY = null;
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
