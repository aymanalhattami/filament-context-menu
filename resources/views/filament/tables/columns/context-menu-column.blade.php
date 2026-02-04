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
            {{ $record->{$getName()} }}
        </div>

        <template x-teleport="body">
            <div x-show="contextMenuOpen" @click.away="contextMenuOpen = false" x-ref="contextmenu"
                 class="z-50 min-w-48 max-w-2xl text-neutral-800 rounded-md ring-1 ring-gray-950/5 transition bg-white text-sm fixed p-2 shadow-md dark:text-gray-200 dark:bg-gray-900 dark:ring-white/10"
                 x-cloak>
                @foreach($getContextMenuActions() as $action)
                    @if($action->isVisible())
                        @if($action instanceof \AymanAlhattami\FilamentContextMenu\ContextMenuDivider)
                            <x-filament-context-menu::divider />
                        @endif

                        @if($action instanceof Filament\Actions\Action and !$action instanceof \AymanAlhattami\FilamentContextMenu\ContextMenuDivider)
                            @if($action->isVisible())
                                <div @class([
                            'context-menu-filament-action flex gap-x-4 select-none group justify-between rounded-sm px-2 py-1.5 hover:bg-neutral-100 outline-hidden data-disabled:opacity-50 data-disabled:pointer-events-none dark:hover:bg-white/5',
                            'mt-1' => !$loop->first
                        ])>
                                    {!! $action->toHtml() !!}
                                </div>
                            @endif
                        @endif
                    @endif
                @endforeach
            </div>
        </template>
    </div>

@else
    <div>
        {{ $record->{$getName()} }}
    </div>
@endif
