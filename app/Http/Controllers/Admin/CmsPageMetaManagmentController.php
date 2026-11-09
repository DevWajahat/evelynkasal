<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cms;
use App\Models\CmsMeta;
use Illuminate\Http\Request;

class CmsPageMetaManagmentController extends Controller
{
    public function heroSection()
    {
        $cms = Cms::firstOrCreate(
            ['page' => 'home', 'type' => 'hero_section']
        );

        $metas = CmsMeta::where('cms_id', $cms->id)
            ->pluck('meta_value', 'meta_key')
            ->toArray();

        return view('screens.admin.cms.home-cms.hero-section.form', compact('cms', 'metas'));
    }

    public function saveHeroSection(Request $request)
    {
        $request->validate([
            'badge' => 'nullable|string|max:255',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'button_text' => 'nullable|string|max:255',
            'button_link' => 'nullable|string|max:255',
            'background_image' => 'nullable|image|mimes:jpeg,png,jpg,webp,svg|max:5120',
        ]);

        $cms = Cms::firstOrCreate(
            ['page' => 'home', 'type' => 'hero_section']
        );

        $inputs = $request->except(['_token', 'background_image']);

        if ($request->hasFile('background_image')) {
            $uploadedImage = $request->file('background_image');
            $uploadName = time() . '_' . uniqid() . '.' . $uploadedImage->getClientOriginalExtension();
            $uploadedImage->move(public_path('uploads/cms'), $uploadName);
            $inputs['background_image'] = asset('uploads/cms/' . $uploadName);
        }

        foreach ($inputs as $key => $value) {
            CmsMeta::updateOrCreate(
                [
                    'cms_id' => $cms->id,
                    'meta_key' => $key,
                ],
                [
                    'meta_value' => $value ?? '',
                ]
            );
        }

        return back()->with('success', 'Hero section updated successfully.');
    }
    public function featuredBookSection()
    {
        $cms = Cms::firstOrCreate(
            ['page' => 'home', 'type' => 'featured_book_section']
        );

        $metas = CmsMeta::where('cms_id', $cms->id)
            ->pluck('meta_value', 'meta_key')
            ->toArray();

        $galleryImages = isset($metas['gallery_images']) && !empty($metas['gallery_images'])
            ? json_decode($metas['gallery_images'], true)
            : [];

        return view('screens.admin.cms.home-cms.featured-book.form', compact('cms', 'metas', 'galleryImages'));
    }

    public function saveFeaturedBookSection(Request $request)
    {
        $request->validate([
            'right_title' => 'required|string|max:255',
            'right_intro' => 'nullable|string',
            'right_description' => 'nullable|string',
            'badge' => 'nullable|string|max:255',
            'left_title' => 'nullable|string|max:255',
            'author_name' => 'nullable|string|max:255',
            'rating' => 'nullable|numeric|min:1|max:5',
            'button_text' => 'nullable|string|max:255',
            'button_link' => 'nullable|string|max:255',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,webp,svg|max:5120',
            'author_photo' => 'nullable|image|mimes:jpeg,png,jpg,webp,svg|max:2048',
            'gallery_images.*' => 'nullable|image|mimes:jpeg,png,jpg,webp,svg|max:5120',
        ]);

        $cms = Cms::firstOrCreate(
            ['page' => 'home', 'type' => 'featured_book_section']
        );

        $inputs = $request->except(['_token', 'featured_image', 'author_photo', 'gallery_images']);

        if ($request->hasFile('featured_image')) {
            $image = $request->file('featured_image');
            $imageName = 'book_' . time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/cms'), $imageName);
            $inputs['featured_image'] = asset('uploads/cms/' . $imageName);
        }

        if ($request->hasFile('author_photo')) {
            $photo = $request->file('author_photo');
            $photoName = 'author_' . time() . '_' . uniqid() . '.' . $photo->getClientOriginalExtension();
            $photo->move(public_path('uploads/cms'), $photoName);
            $inputs['author_photo'] = asset('uploads/cms/' . $photoName);
        }

        if ($request->hasFile('gallery_images')) {
            $existingGalleryMeta = CmsMeta::where('cms_id', $cms->id)->where('meta_key', 'gallery_images')->first();
            $currentGallery = ($existingGalleryMeta && !empty($existingGalleryMeta->meta_value))
                ? json_decode($existingGalleryMeta->meta_value, true)
                : [];

            foreach ($request->file('gallery_images') as $file) {
                $galleryName = 'gallery_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('uploads/cms'), $galleryName);
                $currentGallery[] = asset('uploads/cms/' . $galleryName);
            }

            $inputs['gallery_images'] = json_encode(array_values($currentGallery));
        }

        foreach ($inputs as $key => $value) {
            CmsMeta::updateOrCreate(
                [
                    'cms_id' => $cms->id,
                    'meta_key' => $key,
                ],
                [
                    'meta_value' => $value ?? '',
                ]
            );
        }

        return redirect()->route('admin.cms.meta.featured-book.form')->with('success', 'Featured book section updated successfully.');
    }

    public function deleteGalleryImage(Request $request)
    {
        $cms = Cms::where('page', 'home')->where('type', 'featured_book_section')->first();

        if (!$cms) {
            return back()->with('error', 'Section not found.');
        }

        $galleryMeta = CmsMeta::where('cms_id', $cms->id)->where('meta_key', 'gallery_images')->first();

        if ($galleryMeta) {
            $gallery = json_decode($galleryMeta->meta_value, true) ?? [];
            $targetUrl = $request->input('image_url');

            $gallery = array_filter($gallery, function ($item) use ($targetUrl) {
                return $item !== $targetUrl;
            });

            $galleryMeta->update([
                'meta_value' => json_encode(array_values($gallery)),
            ]);
        }

        return redirect()->route('admin.cms.meta.featured-book.form')->with('success', 'Gallery image deleted.');
    }

    public function aboutSection()
    {
        $cms = Cms::firstOrCreate(
            ['page' => 'home', 'type' => 'about_section']
        );

        $metas = CmsMeta::where('cms_id', $cms->id)
            ->pluck('meta_value', 'meta_key')
            ->toArray();

        return view('screens.admin.cms.home-cms.about-section.form', compact('cms', 'metas'));
    }

    public function saveAboutSection(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'author_image' => 'nullable|image|mimes:jpeg,png,jpg,webp,svg|max:5120',
        ]);

        $cms = Cms::firstOrCreate(
            ['page' => 'home', 'type' => 'about_section']
        );

        $inputs = $request->except(['_token', 'author_image']);

        if ($request->hasFile('author_image')) {
            $image = $request->file('author_image');
            $imageName = 'author_about_' . time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/cms'), $imageName);
            $inputs['author_image'] = asset('uploads/cms/' . $imageName);
        }

        foreach ($inputs as $key => $value) {
            CmsMeta::updateOrCreate(
                [
                    'cms_id' => $cms->id,
                    'meta_key' => $key,
                ],
                [
                    'meta_value' => $value ?? '',
                ]
            );
        }

        return redirect()->route('admin.cms.meta.about-section.form')->with('success', 'About section updated successfully.');
    }

    public function newsletterSection()
    {
        $cms = Cms::firstOrCreate(
            ['page' => 'home', 'type' => 'newsletter_section']
        );

        $metas = CmsMeta::where('cms_id', $cms->id)
            ->pluck('meta_value', 'meta_key')
            ->toArray();

        return view('screens.admin.cms.home-cms.newsletter.form', compact('cms', 'metas'));
    }

    public function saveNewsletterSection(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $cms = Cms::firstOrCreate(
            ['page' => 'home', 'type' => 'newsletter_section']
        );

        $inputs = $request->except(['_token']);

        foreach ($inputs as $key => $value) {
            CmsMeta::updateOrCreate(
                [
                    'cms_id' => $cms->id,
                    'meta_key' => $key,
                ],
                [
                    'meta_value' => $value ?? '',
                ]
            );
        }

        return redirect()->route('admin.cms.meta.newsletter.form')->with('success', 'Newsletter section updated successfully.');
    }

    public function aboutPageSection()
    {
        $cms = Cms::firstOrCreate(
            ['page' => 'about', 'type' => 'about_section']
        );

        $metas = CmsMeta::where('cms_id', $cms->id)
            ->pluck('meta_value', 'meta_key')
            ->toArray();

        return view('screens.admin.cms.about-cms.about-section.form', compact('cms', 'metas'));
    }

    public function saveAboutPageSection(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'author_image' => 'nullable|image|mimes:jpeg,png,jpg,webp,svg|max:5120',
        ]);

        $cms = Cms::firstOrCreate(
            ['page' => 'about', 'type' => 'about_section']
        );

        $inputs = $request->except(['_token', 'author_image']);

        if ($request->hasFile('author_image')) {
            $image = $request->file('author_image');
            $imageName = 'about_page_' . time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/cms'), $imageName);
            $inputs['author_image'] = asset('uploads/cms/' . $imageName);
        }

        foreach ($inputs as $key => $value) {
            CmsMeta::updateOrCreate(
                [
                    'cms_id' => $cms->id,
                    'meta_key' => $key,
                ],
                [
                    'meta_value' => $value ?? '',
                ]
            );
        }

        return redirect()->route('admin.cms.meta.about-page.form')->with('success', 'About page section updated successfully.');
    }

    public function contactSection()
    {
        $cms = Cms::firstOrCreate(
            ['page' => 'contact', 'type' => 'get_in_touch_section']
        );

        $metas = CmsMeta::where('cms_id', $cms->id)
            ->pluck('meta_value', 'meta_key')
            ->toArray();

        return view('screens.admin.cms.contact-cms.get-in-touch.form', compact('cms', 'metas'));
    }

    public function saveContactSection(Request $request)
    {
        $request->validate([
            'page_title' => 'required|string|max:255',
            'page_subtitle' => 'nullable|string|max:500',
            'section_heading' => 'required|string|max:255',
            'section_description' => 'required|string',

            'email_label' => 'nullable|string|max:100',
            'email_value' => 'nullable|string|max:255',
            'email_icon' => 'nullable|string|max:100',

            'location_label' => 'nullable|string|max:100',
            'location_value' => 'nullable|string|max:255',
            'location_icon' => 'nullable|string|max:100',

            'social_instagram' => 'nullable|string|max:255',
            'social_x' => 'nullable|string|max:255',
            'social_facebook' => 'nullable|string|max:255',
        ]);

        $cms = Cms::firstOrCreate(
            ['page' => 'contact', 'type' => 'get_in_touch_section']
        );

        $inputs = $request->except(['_token']);

        foreach ($inputs as $key => $value) {
            CmsMeta::updateOrCreate(
                [
                    'cms_id' => $cms->id,
                    'meta_key' => $key,
                ],
                [
                    'meta_value' => $value ?? '',
                ]
            );
        }

        return redirect()->route('admin.cms.meta.contact.getInTouch')->with('success', 'Contact page content updated successfully.');
    }
}
