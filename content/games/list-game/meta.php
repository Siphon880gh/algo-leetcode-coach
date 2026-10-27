<?php
declare(strict_types=1);

return [
    'title' => 'Dynamic List: Growth by Doubling',
    'summary' => 'A dynamic array keeps a capacity. Appending when size equals capacity allocates double the capacity, copies every element over, then writes the new one. Doubling makes n appends cost O(n) in total, so O(1) each on average.',
    'category' => 'Data Structures',
    'subcategory' => 'Arrays',
    'topic' => 'Data Structures · Arrays',
    'tags' => ['array', 'mini-game'],
    'entry' => 'index.html',
    'related_guide' => 'list',
    'related_session' => 'list',
];
