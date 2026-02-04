window.contextMenuComponent = function () {
    return {
        contextMenuOpen: false,

        // ============================================================================
        // MOBILE TOUCH SUPPORT ADDITION
        // ============================================================================
        // The following properties and methods were added to support mobile devices
        // (Android/iOS) where right-click is not available. Instead, we detect
        // long-press gestures (typically 500ms) using touch events.
        // ============================================================================
        
        // Timer for long-press detection (mobile touch support)
        longPressTimer: null,
        
        // Threshold for long-press detection in milliseconds
        longPressDuration: 500,
        
        // Track initial touch position to detect movement
        touchStartX: null,
        touchStartY: null,
        
        // Maximum distance (in pixels) touch can move before canceling long-press
        touchMoveThreshold: 10,

        contextMenuToggle: function (event) {
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

        // ============================================================================
        // MOBILE TOUCH SUPPORT ADDITION
        // ============================================================================
        // Handle touchstart event - begins long-press detection timer
        // ============================================================================
        handleTouchStart: function (event) {
            // Prevent default browser context menu on long press
            event.preventDefault();
            
            // Get the first touch point
            const touch = event.touches[0];
            this.touchStartX = touch.clientX;
            this.touchStartY = touch.clientY;
            
            // Clear any existing timer
            if (this.longPressTimer) {
                clearTimeout(this.longPressTimer);
            }
            
            // Create a synthetic event object with touch coordinates
            // This allows us to reuse the existing contextMenuToggle method
            const syntheticEvent = {
                clientX: touch.clientX,
                clientY: touch.clientY,
                preventDefault: () => event.preventDefault(),
                stopPropagation: () => event.stopPropagation(),
            };
            
            // Start timer for long-press detection
            this.longPressTimer = setTimeout(() => {
                // Long press detected - trigger context menu
                this.contextMenuToggle(syntheticEvent);
                this.longPressTimer = null;
            }, this.longPressDuration);
        },

        // ============================================================================
        // MOBILE TOUCH SUPPORT ADDITION
        // ============================================================================
        // Handle touchmove event - cancel long-press if user moves finger
        // ============================================================================
        handleTouchMove: function (event) {
            if (!this.touchStartX || !this.touchStartY) {
                return;
            }
            
            const touch = event.touches[0];
            const deltaX = Math.abs(touch.clientX - this.touchStartX);
            const deltaY = Math.abs(touch.clientY - this.touchStartY);
            
            // If user moved finger beyond threshold, cancel long-press
            if (deltaX > this.touchMoveThreshold || deltaY > this.touchMoveThreshold) {
                if (this.longPressTimer) {
                    clearTimeout(this.longPressTimer);
                    this.longPressTimer = null;
                }
                this.touchStartX = null;
                this.touchStartY = null;
            }
        },

        // ============================================================================
        // MOBILE TOUCH SUPPORT ADDITION
        // ============================================================================
        // Handle touchend event - cancel long-press timer if touch ends early
        // ============================================================================
        handleTouchEnd: function (event) {
            // Clear the long-press timer if touch ends before duration
            if (this.longPressTimer) {
                clearTimeout(this.longPressTimer);
                this.longPressTimer = null;
            }
            this.touchStartX = null;
            this.touchStartY = null;
        },

        calculateContextMenuPosition: function (clickEvent) {
            const menu = this.$refs.contextmenu;
            const menuHeight = menu.offsetHeight;
            const menuWidth = menu.offsetWidth;

            const top = clickEvent.clientY + menuHeight > window.innerHeight
                ? window.innerHeight - menuHeight
                : clickEvent.clientY;

            const left = clickEvent.clientX + menuWidth > window.innerWidth
                ? clickEvent.clientX - menuWidth
                : clickEvent.clientX;

            menu.style.top = `${top}px`;
            menu.style.left = `${left}px`;
        },

        handleCloseOtherMenus: function (event) {
            if (event.detail.id !== this.$el) {
                this.contextMenuOpen = false;
            }
        },

        init: function () {
            window.addEventListener('resize', () => {
                this.contextMenuOpen = false;
            });
            
            // ============================================================================
            // MOBILE TOUCH SUPPORT ADDITION
            // ============================================================================
            // Clean up timer on component destruction/unmount
            // ============================================================================
            this.$watch('contextMenuOpen', (value) => {
                if (!value && this.longPressTimer) {
                    clearTimeout(this.longPressTimer);
                    this.longPressTimer = null;
                }
            });
        },
    };
};
