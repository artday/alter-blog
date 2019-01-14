<?php

use Illuminate\Database\Seeder;

class BlogCategoriesTableSeeder extends Seeder
{
    /**
     * Run the database Categories seeds.
     *
     * @return void
     */
    public function run()
    {
        // categories count
        $catCnt = 20;

        // has parent chance
        $withParentChance = 25;

        $categories =[];

        for ($i = 1; $i <= $catCnt; $i++) {
            $title = 'Category #' . $i;
            $categories[] = [
              'title' => $title,
              'slug' => str_slug($title)
            ];
        }

        // insert categories
        DB::table('blog_categories')->insert($categories);

        // get categories
        $categories = DB::table('blog_categories')->get();

        // set parent category and update DB
        foreach ($categories as $key => $category) {
            $hasParent = rand(1, 100) <= $withParentChance;
            $parentID = rand(1, $catCnt);
            $parentID = $parentID == $category->id ? null : $parentID;

            if ($hasParent && $parentID) {
                DB::table('blog_categories')->where('id', $category->id)->update([
                    'parent_id' => $parentID
                ]);
            }
        }
    }
}
