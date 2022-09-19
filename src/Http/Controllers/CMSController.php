<?php

namespace Apurv\LaravelSite\Http\Controllers;

use App\Http\Controllers\Controller;
use Artesaos\SEOTools\Facades\SEOTools;
use Apurv\LaravelSite\Models\Page;
use Illuminate\Support\Facades\Storage;

class CMSController extends Controller
{
    /**
     * Dynamic CMS Function to render editable content
     *
     * @author Apurv Bhavsar <apurv.bhavsar.09@gmail.com>
     * @param string $slug
     * @return void
     */
    public function index(string $slug = null)
    {
        $slug = $slug ?? config('voyager-site.homepage-blade');

        /**
         * TODO : Add new feature to fetch content from different models like Blog, Post.
         * IDEA : Create JSON data in config file which store the Model Path, Search Column, Scope, Meta title, Meta description
         */

        $content = Page::where('slug', $slug)->active()->first();

        if(!$content) {
            $extra = config('voyager-site.extra');
            if(!$extra) abort(404);

            foreach ($extra as $key => $model) {
                $content = $model['model']::where($model['slug'], $slug)->first();
                if($content) {
                    $this->SetSEO($content[$model['seo']['title']], $content[$model['seo']['description']]);

                    if(isset($model['seo']['image'])) {
                        $images = $this->setImages($content[$model['seo']['image']]);
                    }

                    if(isset($model['template'])) {
                        return view($model['template'], compact('content'));
                    }
                }
            }

            abort(404);
        }


        $this->SetSEO($content->title, $content->meta_description);

        $blade = $content->template ?? config('voyager-site.default-blade');
        $view = "voyager-site::".config('voyager-site.views').".".$blade;

        return view($view, compact('content'));
    }

    /**
     * Set title & description for SEO
     *
     * @param [String] $title
     * @param [String] $description
     * @return void
     */
    private function SetSEO($title, $description) : void
    {
        SEOTools::setTitle($title);
        SEOTools::setDescription($description);
        SEOTools::setCanonical(request()->url);
    }

    /**
     * Check image type and set image for SEO
     *
     * @param [Array || String] $images
     * @return void
     */
    private function setImages($images)
    {
        SEOTools::addImages([$images]);
    }
}
