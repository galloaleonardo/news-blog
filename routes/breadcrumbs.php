<?php

// Home
use DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;

Breadcrumbs::for('dashboard', function ($trail) {
    $trail->push(trans('admin.dashboard'), route('dashboard'));
});

// Home > Authors
Breadcrumbs::for('authors', function ($trail) {
    $trail->parent('dashboard');
    $trail->push(trans('admin.authors'), route('authors.index'));
});

// Home > Authors > Create
Breadcrumbs::for('author-create', function ($trail) {
    $trail->parent('authors');
    $trail->push(trans('admin.create'), route('authors.index'));
});

// Home > Authors > Show/Edit
Breadcrumbs::for('author-show-edit', function ($trail, $author) {
    $trail->parent('authors');
    $trail->push($author->name);
});

// Home > Categories
Breadcrumbs::for('categories', function ($trail) {
    $trail->parent('dashboard');
    $trail->push(trans('admin.categories'), route('categories.index'));
});

// Home > Categories > Create
Breadcrumbs::for('category-create', function ($trail) {
    $trail->parent('categories');
    $trail->push(trans('admin.create'), route('categories.index'));
});

// Home > Categories > Show/Edit
Breadcrumbs::for('category-show-edit', function ($trail, $category) {
    $trail->parent('categories');
    $trail->push($category->name);
});

// Home > Advertisements
Breadcrumbs::for('advertisements', function ($trail) {
    $trail->parent('dashboard');
    $trail->push(trans('admin.adverts'), route('advertisements.index'));
});

// Home > Advertisements > Create
Breadcrumbs::for('advertisements-create', function ($trail) {
    $trail->parent('advertisements');
    $trail->push(trans('admin.create'));
});

// Home > Advertisements > Show/Edit
Breadcrumbs::for('advertisements-show-edit', function ($trail, $advertising) {
    $trail->parent('advertisements');
    $trail->push($advertising->title);
});

// Home > Top Banner
Breadcrumbs::for('top-banner', function ($trail) {
    $trail->parent('dashboard');
    $trail->push(trans('admin.top_banner'), route('top-banner.index'));
});

// Home > Top Banner > Create
Breadcrumbs::for('top-banner-create', function ($trail) {
    $trail->parent('top-banner');
    $trail->push(trans('admin.create'));
});

// Home > Top Banner > Show/Edit
Breadcrumbs::for('top-banner-show-edit', function ($trail, $topbanner) {
    $trail->parent('top-banner');
    $trail->push($topbanner->title);
});

// Home > News
Breadcrumbs::for('news', function ($trail) {
    $trail->parent('dashboard');
    $trail->push(trans('admin.news'), route('news.index'));
});

// Home > News > Create
Breadcrumbs::for('news-create', function ($trail) {
    $trail->parent('news');
    $trail->push(trans('admin.create'));
});

// Home > News > Show/Edit
Breadcrumbs::for('news-show-edit', function ($trail, $news) {
    $trail->parent('news');
    $trail->push($news->title);
});

// Home > Users
Breadcrumbs::for('users', function ($trail) {
    $trail->parent('dashboard');
    $trail->push(trans('admin.users'), route('users.index'));
});

// Home > Users > Create
Breadcrumbs::for('users-create', function ($trail) {
    $trail->parent('users');
    $trail->push(trans('admin.create'));
});

// Home > Users > Show/Edit
Breadcrumbs::for('users-show-edit', function ($trail, $user) {
    $trail->parent('users');
    $trail->push($user->name);
});

// Home > Settings
Breadcrumbs::for('settings', function ($trail) {
    $trail->parent('dashboard');
    $trail->push(trans('admin.settings'), route('settings.index'));
});

// Home > Settings > Edit
Breadcrumbs::for('settings-edit', function ($trail) {
    $trail->parent('settings');
    $trail->push(trans('admin.edit'));
});

// Home > Google Ads
Breadcrumbs::for('google-ads', function ($trail) {
    $trail->parent('dashboard');
    $trail->push(trans('admin.google_ads'), route('google-ads.index'));
});

// Home > Google Ads > Edit
Breadcrumbs::for('google-ads-edit', function ($trail) {
    $trail->parent('google-ads');
    $trail->push(trans('admin.edit'));
});

// Home > Google Analytics
Breadcrumbs::for('google-analytics', function ($trail) {
    $trail->parent('dashboard');
    $trail->push(trans('admin.google_analytics'), route('google-analytics.index'));
});

// Home > Google Ads > Analytics
Breadcrumbs::for('google-analytics-edit', function ($trail) {
    $trail->parent('google-analytics');
    $trail->push(trans('admin.edit'));
});

// Home > Blog
Breadcrumbs::for('blog', function ($trail) {
    $trail->parent('home');
    $trail->push('Blog', route('blog'));
});

// Home > Blog > [Category]
Breadcrumbs::for('category', function ($trail, $category) {
    $trail->parent('blog');
    $trail->push($category->title, route('category', $category->id));
});

// Home > SEO
Breadcrumbs::for('seo', function ($trail) {
    $trail->parent('dashboard');
    $trail->push(trans('admin.seo'), route('seo.index'));
});

// Home > Settings > Edit
Breadcrumbs::for('seo-edit', function ($trail) {
    $trail->parent('seo');
    $trail->push(trans('admin.edit'));
});
