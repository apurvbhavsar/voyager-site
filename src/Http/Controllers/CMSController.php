<?php

namespace Apurv\LaravelSite\Http\Controllers;

use App\Http\Controllers\Controller;
use Artesaos\SEOTools\Facades\SEOTools;
use Apurv\LaravelSite\Models\Page;

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
         * IDEA : Create JSON file which store the Model Path, Search Column, Scope, Meta title, Meta description
         */

        $content = Page::where('slug', $slug)->active()->first();

        if(!$content) abort(404);

        $this->SetSEO($content);

        $blade = $content->template ?? config('voyager-site.default-blade');
        $view = "voyager-site::".config('voyager-site.views').".".$blade;

        return view($view, compact('content'));
    }

    private function SetSEO($content) : void
    {
        SEOTools::setTitle($content->title);
        SEOTools::setDescription($content->meta_description);
        SEOTools::setCanonical(request()->url);
    }
}
