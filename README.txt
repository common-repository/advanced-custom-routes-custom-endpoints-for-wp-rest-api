=== Advanced Custom Routes - Custom Endpoints for WP REST API ===
Contributors: lcarlile
Donate link: https://carlile.design/
Tags: rest api, rest, api, custom route, custom endpoint, endpoint, route, custom rest api, custom rest endpoint, custom rest route, carlile design
Requires at least: 4.0 or higher
Tested up to: 5.2.2
Stable tag: 0.8.0
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

The easiest way to create custom WP REST API Routes without writing a line of code.

== Description ==

The REST API was a great additional to WordPress that made it easy to grab data through the default routes. The biggest issue with these default routes is it will either grab too much data or too little data and it didn’t make it easy to only grab the data you need. This plugin makes it possible to create custom routes where you can set to pull only the data you need/want. Even better you won’t even have to touch a line of code to make it work, everything will be configurable within the WordPress dashboard.


## Features ⚡️

* Unlimited custom routes
* Custom route naming
* Custom filtering to only receive data you need
* Select which fields to output
* Query parameters
* A hassle-free experience

## How to use

1. To start using **Advanced Custom Routes**, go to the WordPress dashboard and select the **Custom Routes** section.
2. Next click 'Add New' to create your first custom route.
3. Give your custom route a name and start configuring your custom route to what you need.
4. **Query Builder Options:** Select how to filter the posts you would like to receive at this custom route.
5. **Response Output:** Select which fields you would like to receive at this custom route.
6. Once you have configured everything to your liking, publish the custom route and you will now be able to receive your selected data at this route.

## Query Builder Options

* Posts, Pages, and Custom Post Types
* Post ID
* Categories
* Tags
* Author
* Post Parent
* Status
* Order & Orderby
* Date
* Amount & Offset

## Response Output

* ID
* Title
* Content
* Excerpt
* Link
* Slug
* Date Posted
* Status
* Featured Image
* Categories
* Tags
* Author
* Post Type
* Template
* Post Parent
* Menu Order
* Custom Fields

## Route Parameters

You can also filter your custom routes using query parameters that you add to the end of your custom route like so:

`https://example.com/wp-json/custom-routes/v1/posts?id=1`

In the example above it would only pull data for that custom route where the post's ID was equal to 1. This can be used for multiple different query parameters:

* amount
* offset
* page
* post_type
* id
* id_exclude
* category
* category_exclude
* tag
* tag_exclude
* author
* author_exclude
* post_parent
* post_parent_exclude
* status
* date_before
* date_after
* order
* orderby
* slug
* search
* page


## Single Post Route

You can also receive data for a single post at a custom route using either an ID or a Slug, like so:

### ID:

`https://example.com/wp-json/custom-routes/v1/posts/1`

(This would grab the post with an ID of 1 at this custom route)

### Slug:

`https://example.com/wp-json/custom-routes/v1/posts/hello-world`

(This would grab the post with the slug of *hello-world* at this custom route)


== Installation ==

## How to install Advanced Custom Routes.

### Using WordPress Plugin Directory
Navigate to the 'Add New' in the plugins dashboard
Search for 'Advanced Custom Routes'
Click 'Install Now'
Activate the plugin on the Plugin dashboard

### Uploading it to WordPress
Navigate to the 'Add New' in the plugins dashboard
Navigate to the 'Upload' area
Select advanced-custom-routes.zip from your computer
Click 'Install Now'
Activate the plugin in the Plugin dashboard

### Via FTP
Download advanced-custom-routes.zip
Extract the advanced-custom-routes directory to your computer
Upload the advanced-custom-routes directory to the /wp-content/plugins/ directory
Activate the plugin in the Plugin dashboard


== Frequently Asked Questions ==

### Why isn't my custom post type showing in the query builder options?
Make sure when creating a custom post type that it is allowed to show in the REST API by setting `show_in_rest` to `true`.

### Why is my custom route appearing empty?
If you custom route is appearing empty that means it cannot find any posts that match your query builder options. I would go back and make sure they are set up correctly.

### Can I use pagination with my custom route?
Sure can! To use pagination use the `page` route parameter.

### How do I receive a single post from my custom route?
To receive a single post from a custom route add the post's ID or slug to the end of the custom route. Learn more above in the *Single Post Route* section.

### My custom fields are not outputting how I expect at my custom route?
Make sure to go to *Settings* in Custom Routes to set your preferred custom fields plugin/library.

== Screenshots ==

1. Advanced Custom Routes - List View
2. Advanced Custom Routes - Query Builder Options
3. Advanced Custom Routes - Response Output
4. Advanced Custom Routes - Settings
