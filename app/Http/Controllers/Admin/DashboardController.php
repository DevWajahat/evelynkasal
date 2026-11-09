<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cms;
use App\Models\CmsMeta;
use Illuminate\Support\Facades\File;

class DashboardController extends Controller
{
    public function index()
    {
        $totalSections = Cms::count();
        $totalMetaKeys = CmsMeta::count();

        $storageLinked = File::exists(public_path('storage')) || File::exists(public_path('uploads'));

        $uploadFilesCount = 0;
        if (File::exists(public_path('uploads/cms'))) {
            $uploadFilesCount = count(File::files(public_path('uploads/cms')));
        }

        $definedSections = [
            [
                'page' => 'home',
                'type' => 'hero_section',
                'name' => 'Hero & Headline',
                'scope' => 'Main taglines, author sub-heading, and background image',
                'assets' => 'Background Banner',
                'route' => 'admin.cms.meta.herosection.form',
            ],
            [
                'page' => 'home',
                'type' => 'featured_book_section',
                'name' => 'Featured Book',
                'scope' => '3D Cover, multiple thumbnail gallery, ratings, and narrative text',
                'assets' => 'Featured Cover, Gallery, Author Avatar',
                'route' => 'admin.cms.meta.featured-book.form',
            ],
            [
                'page' => 'home',
                'type' => 'about_section',
                'name' => 'Home About Author',
                'scope' => 'Front-page biographical summary and portrait preview',
                'assets' => 'Author Portrait',
                'route' => 'admin.cms.meta.about-section.form',
            ],
            [
                'page' => 'home',
                'type' => 'newsletter_section',
                'name' => 'Home Newsletter',
                'scope' => 'Subscriber call-to-action title and description blurb',
                'assets' => 'Text Copy',
                'route' => 'admin.cms.meta.newsletter.form',
            ],
            [
                'page' => 'about',
                'type' => 'about_section',
                'name' => 'About Page Main',
                'scope' => 'Full-page author biography, accomplishments, and high-res photo',
                'assets' => 'Author Portrait',
                'route' => 'admin.cms.meta.about-page.form',
            ],
            [
                'page' => 'contact',
                'type' => 'get_in_touch_section',
                'name' => 'Get In Touch',
                'scope' => 'Contact details, email/location icons, and social media handles',
                'assets' => 'Social Links & Icons',
                'route' => 'admin.cms.meta.contact.getInTouch',
            ],
        ];

        $cmsRecords = Cms::with('meta')->get()->keyBy(function ($item) {
            return $item->page . '_' . $item->type;
        });

        $sections = collect($definedSections)->map(function ($section) use ($cmsRecords) {
            $key = $section['page'] . '_' . $section['type'];
            $record = $cmsRecords->get($key);

            $metaCount = $record ? $record->meta->count() : 0;
            $updatedAt = $record ? $record->updated_at : null;

            return array_merge($section, [
                'exists' => (bool) $record,
                'meta_count' => $metaCount,
                'updated_at' => $updatedAt ? $updatedAt->diffForHumans() : 'Not Configured',
                'is_published' => $metaCount > 0,
            ]);
        });

        $activePublishedCount = $sections->where('is_published', true)->count();

        return view('screens.admin.index', compact(
            'totalSections',
            'totalMetaKeys',
            'storageLinked',
            'uploadFilesCount',
            'sections',
            'activePublishedCount'
        ));
    }
}
