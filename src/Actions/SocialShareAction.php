<?php

namespace Tapp\FilamentSocialShare\Actions;

use Closure;
use Filament\Actions\Action;
use Filament\Support\Enums\Width;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Contracts\View\View;

class SocialShareAction extends Action
{
    protected string | null | Closure $urlToShare = null;

    protected ?string $text = null;

    protected bool | \Closure $x = false;

    protected ?string $xIcon = null;

    protected ?string $xTooltip = null;

    protected ?string $xColor = null;

    protected string $xUrl;

    protected bool | Closure $facebook = false;

    protected ?string $facebookIcon = null;

    protected ?string $facebookTooltip = null;

    protected ?string $facebookColor = null;

    protected bool | Closure $reddit = false;

    protected ?string $redditIcon = null;

    protected ?string $redditTooltip = null;

    protected ?string $redditColor = null;

    protected bool | Closure $linkedin = false;

    protected ?string $linkedinIcon = null;

    protected ?string $linkedinTooltip = null;

    protected ?string $linkedinColor = null;

    protected bool | Closure $email = false;

    protected ?string $emailIcon = null;

    protected ?string $emailTooltip = null;

    protected ?string $emailColor = null;

    protected bool | Closure $nativeBrowserShare = false;

    protected ?Closure $beforeCallback = null;

    protected ?Closure $afterCallback = null;

    public static function getDefaultName(): ?string
    {
        return 'socialShare';
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this
            ->label(__('filament-social-share::filament-social-share.label'))
            ->tooltip(__('filament-social-share::filament-social-share.tooltip'))
            ->modalSubmitAction(false)
            ->modalCancelAction(false)
            ->modalWidth(Width::Large)
            ->modalHeading(__('filament-social-share::filament-social-share.modal.heading'))
            ->modalAutofocus(false)
            ->action(function () {
                return null;
            })
            ->icon(config('filament-social-share.action.icon'));
    }

    public function getModalContent(): View | Htmlable | null
    {
        // Execute before callback if set
        if ($this->beforeCallback) {
            $this->evaluate($this->beforeCallback);
        }

        $content = view('filament-social-share::modal-content', [
            'urlToShare' => $this->getUrlToShare(),
            'text' => $this->getText(),
            'nativeBrowserShare' => $this->showNativeBrowserShare(),
            'x' => $this->getX(),
            'xIcon' => $this->getXIcon(),
            'xTooltip' => $this->getXTooltip(),
            'xUrl' => $this->getXUrl(),
            'xColor' => $this->getXColor(),
            'facebook' => $this->getFacebook(),
            'facebookIcon' => $this->getFacebookIcon(),
            'facebookTooltip' => $this->getFacebookTooltip(),
            'facebookUrl' => $this->getFacebookUrl(),
            'facebookColor' => $this->getFacebookColor(),
            'reddit' => $this->getReddit(),
            'redditIcon' => $this->getRedditIcon(),
            'redditTooltip' => $this->getRedditTooltip(),
            'redditUrl' => $this->getRedditUrl(),
            'redditColor' => $this->getRedditColor(),
            'linkedin' => $this->getLinkedin(),
            'linkedinIcon' => $this->getLinkedinIcon(),
            'linkedinTooltip' => $this->getLinkedinTooltip(),
            'linkedinUrl' => $this->getLinkedinUrl(),
            'linkedinColor' => $this->getLinkedinColor(),
            'email' => $this->getEmail(),
            'emailIcon' => $this->getEmailIcon(),
            'emailTooltip' => $this->getEmailTooltip(),
            'emailUrl' => $this->getEmailUrl(),
            'emailColor' => $this->getEmailColor(),
            'afterCallback' => $this->afterCallback,
        ]);

        // Execute after callback if set
        if ($this->afterCallback) {
            $this->evaluate($this->afterCallback);
        }

        return $content;
    }

    public function urlToShare(null | string | \Closure $urlToShare): static
    {
        $this->urlToShare = $urlToShare;

        return $this;
    }

    public function getUrlToShare(): ?string
    {
        if ($this->urlToShare === null) {
            // Get the current page URL without Livewire update parameters
            $request = request();

            // If this is a Livewire request, try to get the original URL
            if ($request->hasHeader('X-Livewire') || $request->is('livewire/*')) {
                // Try to get the referer URL or fallback to current URL
                $referer = $request->header('referer');
                if ($referer) {
                    return $referer;
                }
            }

            // Fallback to current URL with query parameters
            return $request->fullUrl();
        }

        return $this->evaluate($this->urlToShare);
    }

    public function text(null | string | \Closure $text): static
    {
        $this->text = $text;

        return $this;
    }

    public function getText(): ?string
    {
        return $this->evaluate($this->text);
    }

    public function x(bool | \Closure $enabled = true, ?string $icon = null, ?string $tooltip = null, ?string $color = null): static
    {
        $this->x = $enabled;

        if ($icon !== null) {
            $this->xIcon = $icon;
        }
        if ($tooltip !== null) {
            $this->xTooltip = $tooltip;
        }
        if ($color !== null) {
            $this->xColor = $color;
        }

        return $this;
    }

    public function getX(): ?string
    {
        return $this->evaluate($this->x);
    }

    public function xIcon(?string $xIcon = null): static
    {
        $this->xIcon = $xIcon;

        return $this;
    }

    public function getXIcon(): ?string
    {
        return $this->xIcon ?? 'fab-x-twitter';
    }

    public function xTooltip(?string $xTooltip = null): static
    {
        $this->xTooltip = $xTooltip;

        return $this;
    }

    public function getXTooltip(): ?string
    {
        return $this->xTooltip ?? 'Share on X (Twitter)';
    }

    public function xColor(?string $xColor = null): static
    {
        $this->xColor = $xColor;

        return $this;
    }

    public function getXColor(): string
    {
        return $this->xColor ?? '#000000';
    }

    public function getXUrl(): string
    {
        return 'https://x.com/intent/tweet?url=' . urlencode($this->getUrlToShare()) . '&text=' . urlencode($this->getText() ?? 'Check out this content');
    }

    public function facebook(bool | \Closure $enabled = true, ?string $icon = null, ?string $tooltip = null, ?string $color = null): static
    {
        $this->facebook = $enabled;

        if ($icon !== null) {
            $this->facebookIcon = $icon;
        }
        if ($tooltip !== null) {
            $this->facebookTooltip = $tooltip;
        }
        if ($color !== null) {
            $this->facebookColor = $color;
        }

        return $this;
    }

    public function getFacebook(): bool
    {
        return (bool) $this->evaluate($this->facebook);
    }

    public function facebookIcon(?string $facebookIcon = null): static
    {
        $this->facebookIcon = $facebookIcon;

        return $this;
    }

    public function getFacebookIcon(): ?string
    {
        return $this->facebookIcon ?? 'fab-facebook-f';
    }

    public function facebookTooltip(?string $facebookTooltip = null): static
    {
        $this->facebookTooltip = $facebookTooltip;

        return $this;
    }

    public function getFacebookTooltip(): ?string
    {
        return $this->facebookTooltip ?? 'Share on Facebook';
    }

    public function facebookColor(?string $facebookColor = null): static
    {
        $this->facebookColor = $facebookColor;

        return $this;
    }

    public function getFacebookColor(): string
    {
        return $this->facebookColor ?? '#3b82f6';
    }

    public function getFacebookUrl(): string
    {
        return 'https://www.facebook.com/sharer/sharer.php?u=' . urlencode($this->getUrlToShare());
    }

    public function reddit(bool | \Closure $enabled = true, ?string $icon = null, ?string $tooltip = null, ?string $color = null): static
    {
        $this->reddit = $enabled;

        if ($icon !== null) {
            $this->redditIcon = $icon;
        }
        if ($tooltip !== null) {
            $this->redditTooltip = $tooltip;
        }
        if ($color !== null) {
            $this->redditColor = $color;
        }

        return $this;
    }

    public function getReddit(): bool
    {
        return $this->evaluate($this->reddit);
    }

    public function redditIcon(?string $redditIcon = null): static
    {
        $this->redditIcon = $redditIcon;

        return $this;
    }

    public function getRedditIcon(): ?string
    {
        return $this->redditIcon ?? 'fab-reddit-alien';
    }

    public function redditTooltip(?string $redditTooltip = null): static
    {
        $this->redditTooltip = $redditTooltip;

        return $this;
    }

    public function getRedditTooltip(): ?string
    {
        return $this->redditTooltip ?? 'Share on Reddit';
    }

    public function redditColor(?string $redditColor = null): static
    {
        $this->redditColor = $redditColor;

        return $this;
    }

    public function getRedditColor(): string
    {
        return $this->redditColor ?? '#ea580c';
    }

    public function getRedditUrl(): string
    {
        return 'http://www.reddit.com/submit?url=' . urlencode($this->getUrlToShare()) . '&title=' . urlencode($this->getText() ?? 'Check out this content');
    }

    public function linkedin(bool | \Closure $enabled = true, ?string $icon = null, ?string $tooltip = null, ?string $color = null): static
    {
        $this->linkedin = $enabled;

        if ($icon !== null) {
            $this->linkedinIcon = $icon;
        }
        if ($tooltip !== null) {
            $this->linkedinTooltip = $tooltip;
        }
        if ($color !== null) {
            $this->linkedinColor = $color;
        }

        return $this;
    }

    public function getLinkedin(): ?string
    {
        return $this->evaluate($this->linkedin);
    }

    public function linkedinIcon(?string $linkedinIcon = null): static
    {
        $this->linkedinIcon = $linkedinIcon;

        return $this;
    }

    public function getLinkedinIcon(): ?string
    {
        return $this->linkedinIcon ?? 'fab-linkedin-in';
    }

    public function linkedinTooltip(?string $linkedinTooltip = null): static
    {
        $this->linkedinTooltip = $linkedinTooltip;

        return $this;
    }

    public function getLinkedinTooltip(): ?string
    {
        return $this->linkedinTooltip ?? 'Share on LinkedIn';
    }

    public function linkedinColor(?string $linkedinColor = null): static
    {
        $this->linkedinColor = $linkedinColor;

        return $this;
    }

    public function getLinkedinColor(): string
    {
        return $this->linkedinColor ?? '#1d4ed8';
    }

    public function getLinkedinUrl(): string
    {
        return 'http://www.linkedin.com/shareArticle?mini=true&url=' . urlencode($this->getUrlToShare()) . '&title=' . urlencode($this->getText() ?? 'Check out this content');
    }

    public function email(bool | \Closure $enabled = true, ?string $icon = null, ?string $tooltip = null, ?string $color = null): static
    {
        $this->email = $enabled;

        if ($icon !== null) {
            $this->emailIcon = $icon;
        }
        if ($tooltip !== null) {
            $this->emailTooltip = $tooltip;
        }
        if ($color !== null) {
            $this->emailColor = $color;
        }

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->evaluate($this->email);
    }

    public function emailIcon(?string $emailIcon = null): static
    {
        $this->emailIcon = $emailIcon;

        return $this;
    }

    public function getEmailIcon(): ?string
    {
        return $this->emailIcon ?? 'heroicon-o-envelope';
    }

    public function emailTooltip(?string $emailTooltip = null): static
    {
        $this->emailTooltip = $emailTooltip;

        return $this;
    }

    public function getEmailTooltip(): ?string
    {
        return $this->emailTooltip ?? 'Share via Email';
    }

    public function emailColor(?string $emailColor = null): static
    {
        $this->emailColor = $emailColor;

        return $this;
    }

    public function getEmailColor(): string
    {
        return $this->emailColor ?? '#000000';
    }

    public function getEmailUrl(): string
    {
        $subject = urlencode($this->getText() ?? 'Check out this content');
        $body = urlencode('Check out this content: ' . $this->getUrlToShare());

        return "mailto:?subject={$subject}&body={$body}";
    }

    public function nativeBrowserShare(bool | \Closure $nativeBrowserShare = true): static
    {
        $this->nativeBrowserShare = $nativeBrowserShare;

        return $this;
    }

    public function before(?Closure $callback): static
    {
        $this->beforeCallback = $callback;

        return $this;
    }

    public function after(?Closure $callback): static
    {
        $this->afterCallback = $callback;

        return $this;
    }

    public function showNativeBrowserShare(): bool
    {
        return (bool) $this->evaluate($this->nativeBrowserShare);
    }

    public function boot(): void
    {
        if ($this->showNativeBrowserShare()) {
            // Execute before callback if set
            if ($this->beforeCallback) {
                $this->evaluate($this->beforeCallback);
            }

            $text = $this->getText() ?? 'Check out this content';

            $this->modalHeading(null);
            $this->modalContent(null);

            $this->action(function ($livewire) use ($text) {
                $livewire->js(
                    'navigator.share({
                        title: document.title,
                        text: "' . $text . '",
                        url: "' . $this->getUrlToShare() . '"
                    }).then(() => {
                        $tooltip("' . __('Shared') . '", { timeout: 1500 });
                    }).catch((err) => {
                        console.log("Native sharing failed or cancelled:", err);
                    });'
                );
            });

            // Execute after callback if set
            if ($this->afterCallback) {
                $this->evaluate($this->afterCallback);
            }
        }
    }
}
