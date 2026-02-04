window.contextMenuComponent = function () {
    return {
        contextMenuOpen: false,

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
        },
    };
};
