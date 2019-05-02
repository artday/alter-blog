<?php

namespace App\Breadcrumbs;

use Illuminate\Http\Request;

class Segment
{
    private $request;
    private $segment;

    public function __construct(Request $request, $segment)
    {
        $this->request = $request;
        $this->segment = $segment;
    }

    public function model()
    {
        return collect($this->request->route()->parameters())
            ->where('slug', $this->segment)
            ->first();
    }

    public function name()
    {
        return title_case($this->segment);
    }

    public function url()
    {
        return url(implode(array_slice($this->request->segments(), 0, $this->position()+1), $this->delimiter()));
    }

    private function position()
    {
        return array_search($this->segment, $this->request->segments());
    }

    private function delimiter()
    {
        return '/';
    }
}