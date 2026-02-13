# Krayin WhatsApp Integration

Integrates WhatsApp "Click to Chat" functionality into Krayin CRM.

## Features
- **One-Click Chat**: Adds a WhatsApp button next to phone numbers in **Leads** and **Contacts** views.
- **Strict Validation**: Only enables the button for valid international numbers (e.g. `+595...`, `+1...`).
- **Unified UI**: Standardizes Contact phone numbers to use `callto:` links, matching the Leads view.

## Installation from GitHub

To install this package in your Krayin CRM project, follow these steps:

### 1. Update `composer.json`
Add the GitHub repository to the `repositories` section of your root `composer.json`:

```json
"repositories": [
    {
        "type": "vcs",
        "url": "https://github.com/carlvallory/KrayinWhatsApp.git"
    }
]
```

### 2. Require the Package
Run the following command in your terminal:

```bash
composer require carlvallory/krayin-whatsapp
```

### 3. Verify Installation
Ensure the service provider is discovered. You should see the package in the discovery output:

```bash
php artisan package:discover
```

## Configuration
This package Works out of the box. No additional configuration is required.
- **Validation Logic**: Hardcoded to accept E.164-like formats (`^\+\d{8,15}$`).
- **Styling**: Uses Krayin's native button styles and a bundled SVG icon.
