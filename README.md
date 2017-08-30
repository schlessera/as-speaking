# Speaking Page Plugin

> Custom post type and presentation tools for a page to promote your speaking gigs.

The main reason why I developed this plugin is because I needed something to talk about at [WordCamp Nijmegen 2017](https://2017.nijmegen.wordcamp.org/session/oop-plugin-development-basics/).

This plugin is currently active on my personal blog, and you can see the output on my [Speaking Page](https://www.alainschlesser.com/speaking/).

## Basic usage

Adding and editing talks should be pretty straight-forward.

To display them on the frontpage, you can use the `[speaking_page]` shortcode.

The talks will automatically be ordered by date, and showed as either "Upcoming Talks" or "Past Talks".

## Customizing

If you want to override the markup fom within your theme, just create a `views` folder in your (parent or child) theme and copy the file from the plugin's `views` folder in there and copy the markup file(s) you need from the plugin's `views` folder. You can then change the copied file(s) as needed.

## Screenshots

### List view of the added talks

![List view of the added talks](/assets/images/screenshot-1.png)

### Metabox in talk edit screen

![Metabox in talk edit screen](/assets/images/screenshot-2.png)

### Expanded metabox showing all properties

![Expanded metabox showing all properties](/assets/images/screenshot-3.png)

### Frontend rendering

![Frontend rendering](/assets/images/screenshot-4.png)
