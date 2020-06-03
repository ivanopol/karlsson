<?php


namespace App\Services;

use Illuminate\Support\Facades\DB;

class ModelService
{
    public function __construct()
    {

    }

    public function get_model_page_view_data()
    {
        $reviews = DB::select('select * from review');
        $colors = DB::select('select * from color');
        $blocks = DB::select('select * from block');
        $blocks_slider = DB::select('select * from block_slider');
        $slides = DB::select('select * from slide');
        $slide_mini = DB::select('select * from slide_mini');

        foreach ($blocks as &$block) {
            $block->slider = [];

            foreach ($blocks_slider as $slider) {
                if ($block->id == $slider->block_id) {
                    $block->slider = $slider;
                }
            }
        }
        $data = [
            'slider' => [
                'slides_mini' => $slide_mini,
                'slides' => $slides,
            ],
            'blocks' => $blocks,
            'reviews' => $reviews,
            'colors' => $colors
        ];

        return $data;
    }
}
