<?php

namespace AymanAlhattami\FilamentContextMenu\Actions;

use Filament\Actions\Action;

class CopyAction extends Action
{
    public static function getDefaultName(): ?string
    {
        return 'copy';
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->label('Copy')
            ->translateLabel()
            ->color('gray')
            ->icon('heroicon-o-clipboard-document')
            ->link();
        //            ->extraAttributes([
        //                'x-data' => '',
        //                'x-on:click' => new HtmlString('
        //                    const filamentContextMenuTextToCopy = window.getSelection().toString();
        //                    navigator.clipboard.writeText(filamentContextMenuTextToCopy).then(
        //                        () => {
        //                            console.log("Text copied to clipboard");
        //                        },
        //                        (err) => {
        //                            console.error("Failed to copy text: ", err);
        //                        }
        //                    );
        //                '),
        //            ])
    }
}
