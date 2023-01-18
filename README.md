# wordpress-custom-post-type-excerpts
Allows setting custom excerpt lengths for all post types from the WordPress admin.

## How to use
1. Clone this repository or download a release.
1. Zip the project directory ("wordpress-custom-post-type-excerpts") and install from the admin plugins page.
1. Alternatively, upload the directory to  "YOUR_SITE_NAME/app/public/wp-content/plugins".
1. All excerpt lengths are set to 55 by default (same as WordPress core's default).
1. A new page is added to the admin menu under "Tools" titled "Set Post Excerpts".
1. Change the desired excerpt length and select "Save".

## Version

### 0.1.0
Stable and ready for testing

## TODO
### Testing
- Make sure options are properly erased from the DB on uninstall
- Run on clean installation
- Run on existing installation
- Run after adding a CPT
- Run after removing a CPT
- Check excerpt length on custom queries

### Other
- Name change (no longer need "custom" or "wordpress")
- Measure for performance hit
