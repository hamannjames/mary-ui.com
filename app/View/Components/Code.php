<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Code extends Component
{
    public function __construct(
        public string $language = 'html',
        public ?bool $noRender = false
    ) {

    }

    public function render(): View|Closure|string
    {
        return <<<'HTML'
        <!-- Fix identation -->
        @php 
            $x = (string) Str::of($slot)->prepend('    ');
        @endphp

        @if(!$noRender)
            <div {{ $attributes->class(["rounded-lg  p-8 bg-base-200/50 border-gray-400/50 border border-dashed"]) }} >                            
                    @php  echo Blade::render($x)  @endphp                
            </div>
        @endif
        <pre><x-torchlight-code :language="$language" :contents="$x" /></pre>
        HTML;
    }
}
