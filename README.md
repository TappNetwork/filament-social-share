# Filament Social Share

[![Latest Version on Packagist](https://img.shields.io/packagist/v/tapp/filament-social-share.svg?style=flat-square)](https://packagist.org/packages/TappNetwork/filament-social-share)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/TappNetwork/filament-social-share/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/TappNetwork/filament-social-share/actions?query=workflow%3Arun-tests+branch%3Amain)
![GitHub Code Style Action Status](https://github.com/TappNetwork/filament-social-share/actions/workflows/fix-php-code-style-issues.yml/badge.svg)
[![Total Downloads](https://img.shields.io/packagist/dt/tapp/filament-social-share.svg?style=flat-square)](https://packagist.org/packages/TappNetwork/filament-social-share)

An action that allows users to share the current URL (or provide a custom one) on social media platforms, through email, or copy the link. It could be also used the web share API (supported by certain browsers).

> [!IMPORTANT]  
> The web share API and copy to clipboard require HTTPs to work.

## Appareance

![Action button](https://raw.github.com/TappNetwork/filament-social-share/main/docs/button.png)

![Modal](https://raw.github.com/TappNetwork/filament-social-share/main/docs/modal.png)

## Dependencies

- owenvoke/blade-fontawesome for default social icons

## Installation

You can install the package via composer:

```bash
composer require tapp/filament-social-share
```

You can publish the config using:

```bash
php artisan vendor:publish --tag="filament-social-share-config"
```

This is the contents of the published config file:

```php
return [

    'action' => [
        'icon' => 'heroicon-m-share',
    ],

];
```

To apply the plugin styles, add to the your Filament `theme.css` file:

```css
@source '../../../../vendor/tapp/filament-social-share';
```

## Usage

The share action can open the native browser share or a Filament modal with options to share on X, Facebook, Linkedin, Reddit, or Email.

**Using Native Browser Web Share API**

Add the `->nativeBrowserShare()` to display the native browser share:

```php
use Tapp\FilamentSocialShare\Actions\SocialShareAction;

SocialShareAction::make()
    ->nativeBrowserShare()
```

**Using modal with social plataform options**

When `->nativeBrowserShare()` is not provided a modal will be opened with options to share on social plataforms or email. The social plataforms available are in the example below:

```php
use Tapp\FilamentSocialShare\Actions\SocialShareAction;

SocialShareAction::make()
    ->x()
    ->facebook()
    ->linkedin()
    ->reddit()
    ->email()
```

### Options available

Below you can see all the options available to the `SocialShareAction`.

> [!NOTE]  
> Any icon supported by Blade UI kit can be used for the social share icons.

### URL to Share

Default is current URL.

Provide a custom URL to share:

```php
use Tapp\FilamentSocialShare\Actions\SocialShareAction;

SocialShareAction::make()
    ->urlToShare('https://github.com/TappNetwork/filament-social-share')
```

### Text

Default is the title.

Provide the text to share:

```php
use Tapp\FilamentSocialShare\Actions\SocialShareAction;

SocialShareAction::make()
    ->text('Social Share Filament Plugin')
```

### Twitter/X

To add X share button, add the x method providing the user:

```php
use Tapp\FilamentSocialShare\Actions\SocialShareAction;

SocialShareAction::make()
    ->x()

// With custom icon, tooltip, and color
SocialShareAction::make()
    ->x(
        enabled: true,
        icon: 'fab-x',
        tooltip: 'Share on X',
        color: '#000000'
    )
    
// Using dedicated methods
SocialShareAction::make()
    ->x()
    ->xIcon('fab-x')
    ->xTooltip('Share this post on X')
    ->xColor('#000000')
```

### Facebook

To add Facebook share button:

```php
use Tapp\FilamentSocialShare\Actions\SocialShareAction;

SocialShareAction::make()
    ->facebook()
    
// With custom icon, tooltip, and color
SocialShareAction::make()
    ->facebook(
        enabled: true,
        icon: 'fab-facebook-f',
        tooltip: 'Share on Facebook',
        color: '#1877f2'
    )
    
// Using dedicated methods
SocialShareAction::make()
    ->facebook()
    ->facebookIcon('fab-facebook-f')
    ->facebookTooltip('Share this post on Facebook')
    ->facebookColor('#1877f2')
```

### LinkedIn

To add LinkedIn share button:

```php
use Tapp\FilamentSocialShare\Actions\SocialShareAction;

SocialShareAction::make()
    ->linkedin()
    
// With custom icon, tooltip, and color
SocialShareAction::make()
    ->linkedin(
        enabled: true,
        icon: 'fab-linkedin-in',
        tooltip: 'Share on LinkedIn',
        color: '#0077b5'
    )
    
// Using dedicated methods
SocialShareAction::make()
    ->linkedin()
    ->linkedinIcon('fab-linkedin-in')
    ->linkedinTooltip('Share on LinkedIn network')
    ->linkedinColor('#0077b5')
```

### Reddit

To add Reddit share button:

```php
use Tapp\FilamentSocialShare\Actions\SocialShareAction;

SocialShareAction::make()
    ->reddit()
    
// With custom icon, tooltip, and color
SocialShareAction::make()
    ->reddit(
        enabled: true,
        icon: 'fab-reddit-alien',
        tooltip: 'Share on Reddit',
        color: '#ff4500'
    )
    
// Using dedicated methods
SocialShareAction::make()
    ->reddit()
    ->redditIcon('fab-reddit-alien')
    ->redditTooltip('Post to Reddit')
    ->redditColor('#ff4500')
```

### Email

To add Email share button:

```php
use Tapp\FilamentSocialShare\Actions\SocialShareAction;

SocialShareAction::make()
    ->email()
    
// With custom icon, tooltip, and color
SocialShareAction::make()
    ->email(
        enabled: true,
        icon: 'heroicon-o-envelope',
        tooltip: 'Share via Email',
        color: '#6b7280'
    )
    
// Using dedicated methods
SocialShareAction::make()
    ->email()
    ->emailIcon('heroicon-o-envelope')
    ->emailTooltip('Send via Email')
    ->emailColor('#6b7280')
```

### Native Browser Share

Enable native browser Web Share API:

```php
use Tapp\FilamentSocialShare\Actions\SocialShareAction;

SocialShareAction::make()
    ->nativeBrowserShare()
```

### Process Customization

Add custom logic before or after the sharing process:

```php
use Tapp\FilamentSocialShare\Actions\SocialShareAction;
use Filament\Notifications\Notification;

SocialShareAction::make()
    ->before(function () {
        // Execute before sharing modal opens
        Notification::make()
            ->title('Opening share options...')
            ->info()
            ->send();
    })
    ->after(function () {
        // Execute after sharing process
        \Log::info('User opened social share modal');
    })
    ->facebook()
    ->linkedin()
```

### Default Colors

The plugin comes with sensible default colors for each platform:

- **X (Twitter)**: `#000000` (Black)
- **Facebook**: `#3b82f6` (Blue)
- **LinkedIn**: `#1d4ed8` (Dark Blue)
- **Reddit**: `#ea580c` (Orange)
- **Email**: `#000000` (Black)

### Different Approaches to Define Configurations

Using named parameters in main social plataform method

```php
SocialShareAction::make()
    ->facebook(
        enabled: true,
        icon: 'fab-facebook-f', 
        tooltip: 'Share this post on Facebook',
        color: '#1877f2'
    )
    ->linkedin(
        icon: 'fab-linkedin-in',
        color: '#0077b5',
        tooltip: 'Share on LinkedIn network'
    )
    ->reddit(
        color: '#ff4500',
        tooltip: 'Post to Reddit'
    )
```

Using pure dedicated methods

```php
SocialShareAction::make()
    ->facebook()
        ->facebookIcon('fab-facebook-f')
        ->facebookTooltip('Share this amazing post on Facebook')
        ->facebookColor('#1877f2')
    ->linkedin()
        ->linkedinColor('#0077b5')
        ->linkedinTooltip('Share on LinkedIn network')
    ->reddit()
        ->redditColor('#ff4500')
```

Mixed approach (Maximum Flexibility)

```php
SocialShareAction::make()
    ->facebook(icon: 'fab-facebook-f')  // Named parameter for icon
        ->facebookTooltip('Custom tooltip')  // Dedicated method for tooltip
        ->facebookColor('#1877f2')           // Dedicated method for color
    ->linkedin(color: '#0077b5')        // Named parameter for color
        ->linkedinIcon('fab-linkedin-in')    // Dedicated method for icon
    ->reddit()                          // Enable with all defaults
        ->redditColor('#ff4500')     
```

Conditional/Dynamic Configuration

```php
$action = SocialShareAction::make()
    ->facebook()
    ->linkedin();

// Conditionally customize based on user preferences
if ($user->prefers_custom_colors) {
    $action->facebookColor('#custom-color')
           ->linkedinColor('#another-color');
}

if ($user->is_premium) {
    $action->reddit()
           ->redditTooltip('Premium user sharing');
}
```

### Customizing the action

Any method available to Filament action can be used, for example, to use an icon instead of button for share action:

```php
use Tapp\FilamentSocialShare\Actions\SocialShareAction;

 SocialShareAction::make()
    ->facebook()
    ->iconButton(),
```

### Executing code before or after the action

The `before()` and `after()` methods could be used to execute some extra logic before or after the action:

- **before()** - Runs code before the main sharing action occurs.

- **after()** - Runs code after the sharing modal is displayed/processed.

Example: Send Notification After Sharing

```php
use Filament\Notifications\Notification;
use Tapp\FilamentSocialShare\Actions\SocialShareAction;

SocialShareAction::make()
    ->facebook()
    ->linkedin()
    ->after(function () {
        // Send notification after user opens share modal
        Notification::make()
            ->title('Share options displayed')
            ->body('The social sharing options have been presented to the user.')
            ->success()
            ->send();
    }),
```

Example: Log Sharing Activity

```php
use Illuminate\Support\Facades\Log;
use Tapp\FilamentSocialShare\Actions\SocialShareAction;

SocialShareAction::make()
    ->facebook()
    ->linkedin()
    ->before(function () {
        // Log that user initiated sharing
        Log::info('User opened social share modal', [
            'user_id' => auth()->id(),
            'timestamp' => now(),
            'url' => request()->url()
        ]);
    })
    ->after(function () {
        // Log completion
        Log::info('Social share modal displayed successfully');
    })
```

Example: Custom Authorization Check

```php
use Filament\Notifications\Notification;
use Tapp\FilamentSocialShare\Actions\SocialShareAction;

SocialShareAction::make()
    ->facebook()
    ->linkedin()
    ->before(function () {
        // Check if user has permission to share
        if (!auth()->user()->can('share_content')) {
            Notification::make()
                ->title('Permission Denied')
                ->body('You do not have permission to share content.')
                ->danger()
                ->send();
            
            throw new \Exception('Unauthorized sharing attempt');
        }
    })
```

Example: Track Analytics

```php
use Tapp\FilamentSocialShare\Actions\SocialShareAction;

SocialShareAction::make()
    ->facebook()
    ->linkedin()
    ->before(function () {
        // Track sharing intent in analytics
        event('social_share_initiated', [
            'user_id' => auth()->id(),
            'content_type' => 'article',
            'content_id' => request()->route('id')
        ]);
    })
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](.github/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Tapp Network](https://github.com/TappNetwork)
- [All Contributors](../../contributors)

Inspired by [PenguinUI](https://www.penguinui.com/ai-components/output-interactions).

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
