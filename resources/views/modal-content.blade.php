<div x-data="{
    copiedToClipboard: false,
    copyUrlToClipboard(url) {
        if (window.navigator.clipboard && window.navigator.clipboard.writeText) {
            window.navigator.clipboard
                .writeText(url)
                .then(() => {
                    this.copiedToClipboard = true;
                    $tooltip('Copied to clipboard', { timeout: 1500 });
                    setTimeout(() => {
                        this.copiedToClipboard = false;
                    }, 2000);
                })
                .catch((err) => {
                    console.log('Clipboard API failed', err);
                });
        } else {
            console.log('Clipboard API failed', err);
        }
    },
}">
    <!-- Dialog Body -->
    <div class="flex flex-col gap-8">
        <!-- Social Icons -->
        <div class="grid grid-cols-3 gap-6 sm:grid-cols-5 sm:gap-4">

            @if ($x)
                <!-- X - Twitter -->
                <a href="{{ $xUrl }}" target="_blank" class="flex flex-col items-center justify-center gap-1.5 no-underline" x-tooltip="'{{ $xTooltip }}'">
                    <div class="flex h-10 w-10 items-center justify-center rounded-full p-2" style="background-color: {{ $xColor }};">
                        <x-filament::icon
                            icon="{{ $xIcon }}"
                            class="h-5 w-5 text-gray-100"
                        />
                    </div>
                    <span class="whitespace-nowrap text-xs text-gray-600 dark:text-gray-300">X(Twitter)</span>
                </a>
            @endif

            @if ($facebook)
                <!-- Facebook -->
                <a href="{{ $facebookUrl }}" target="_blank" class="flex flex-col items-center justify-center gap-1.5 no-underline" x-tooltip="'{{ $facebookTooltip }}'">
                    <div class="flex h-10 w-10 items-center justify-center rounded-full p-2" style="background-color: {{ $facebookColor }};">
                        <x-filament::icon
                            icon="{{ $facebookIcon }}"
                            class="h-6 w-6 text-gray-100"
                        />
                    </div>
                    <span class="whitespace-nowrap text-xs text-gray-600 dark:text-gray-300">Facebook</span>
                </a>
            @endif

            @if ($reddit)
                <!-- Reddit -->
                <a href="{{ $redditUrl }}" target="_blank" class="flex flex-col items-center justify-center gap-1.5 no-underline" x-tooltip="'{{ $redditTooltip }}'">
                    <div class="flex h-10 w-10 items-center justify-center rounded-full p-2" style="background-color: {{ $redditColor }};">
                        <x-filament::icon
                            icon="{{ $redditIcon }}"
                            class="h-7 w-7 text-gray-100"
                        />
                    </div>
                    <span class="whitespace-nowrap text-xs text-gray-600 dark:text-gray-300">Reddit</span>
                </a>
            @endif

            @if ($linkedin)
                <!-- LinkedIn -->
                <a href="{{ $linkedinUrl }}" target="_blank" class="flex flex-col items-center justify-center gap-1.5 no-underline" x-tooltip="'{{ $linkedinTooltip }}'">
                    <div class="flex h-10 w-10 items-center justify-center rounded-full p-2" style="background-color: {{ $linkedinColor }};">
                        <x-filament::icon
                            icon="{{ $linkedinIcon }}"
                            class="h-5 w-5 text-gray-100"
                        />
                    </div>
                    <span class="whitespace-nowrap text-xs text-gray-600 dark:text-gray-300">LinkedIn</span>
                </a>
            @endif

            @if ($email)
                <!-- Email -->
                <a href="{{ $emailUrl }}" target="_blank" class="flex flex-col items-center justify-center gap-1.5 no-underline" x-tooltip="'{{ $emailTooltip }}'">
                    <div class="flex h-10 w-10 items-center justify-center rounded-full p-2" style="background-color: {{ $emailColor }};">
                        <x-filament::icon
                            icon="{{ $emailIcon }}"
                            class="h-6 w-6 fill-gray-100 dark:fill-black"
                        />
                    </div>
                    <span class="whitespace-nowrap text-xs text-gray-600 dark:text-gray-300">Email</span>
                    </a>
            @endif
        </div>

        <!-- Copy URL Section -->
        <div class="px-2">
            <label for="shareLink" class="sr-only">share link</label>
            <x-filament::input.wrapper>
                <x-filament::input
                    id="shareLink"
                    type="text"
                    x-ref="shareUrl"
                    x-bind:value="'{{ $urlToShare }}'"
                    readonly
                />
                <x-slot name="suffix">
                    <button
                        type="button"
                        class="rounded-full p-1 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary-600 active:outline-offset-0 dark:focus-visible:outline-primary-500"
                        x-on:click="copyUrlToClipboard($refs.shareUrl.value)"
                        x-on:click.away="copiedToClipboard = false"
                        :title="copiedToClipboard ? 'Copied!' : 'Copy URL to clipboard'"
                    >
                        <span class="sr-only" x-text="copiedToClipboard ? 'copied' : 'copy the url to clipboard'"></span>
                        <x-filament::icon
                            x-cloak
                            x-show="!copiedToClipboard"
                            icon="heroicon-o-document-duplicate"
                            class="h-5 w-5"
                        />
                        <x-filament::icon
                            x-cloak
                            x-show="copiedToClipboard"
                            icon="heroicon-o-check"
                            class="h-5 w-5 text-green-500"
                        />
                    </button>
                </x-slot>
            </x-filament::input.wrapper>
        </div>
    </div>
</div>
