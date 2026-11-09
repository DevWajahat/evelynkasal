<?php

use App\Http\Controllers\Admin\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CmsPageMetaManagmentController;
use App\Http\Controllers\Admin\CmsManagmentController;

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::prefix('cms/meta/')->controller(CmsPageMetaManagmentController::class)->name('cms.meta.')->group(function () {
    Route::get('home/hero-section', 'heroSection')->name('herosection.form');
    Route::post('home/hero-section', 'saveHeroSection')->name('herosection.save');

    Route::get('home/featured-book', 'featuredBookSection')->name('featured-book.form');
    Route::post('home/featured-book', 'saveFeaturedBookSection')->name('featured-book.save');
    Route::delete('home/featured-book/gallery-delete', 'deleteGalleryImage')->name('featured-book.gallery.delete');

    Route::get('home/about-section', 'aboutSection')->name('about-section.form');
    Route::post('home/about-section', 'saveAboutSection')->name('about-section.save');

    Route::get('home/newsletter', 'newsletterSection')->name('newsletter.form');
    Route::post('home/newsletter', 'saveNewsletterSection')->name('newsletter.save');

    Route::get('about/about-section', 'aboutPageSection')->name('about-page.form');
    Route::post('about/about-section', 'saveAboutPageSection')->name('about-page.save');

    Route::get('contact/get-in-touch', 'contactSection')->name('contact.getInTouch');
    Route::post('contact/get-in-touch', 'saveContactSection')->name('contact.getInTouch.save');
});

Route::prefix('cms/page-sections')->controller(CmsManagmentController::class)->name('cms.')->group(function () {
    Route::get('/', 'index')->name('index');
    Route::post('/store', 'store')->name('store');
    Route::put('/update/{cms}', 'update')->name('update');
    Route::delete('/destroy/{cms}', 'destroy')->name('destroy');
});
