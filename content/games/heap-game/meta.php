<?php
declare(strict_types=1);

return [
    'title' => 'Heap Basics: Peek and Push',
    'summary' => 'A max-heap stored in an array: the parent of index i is (i − 1) divided by 2 rounded down, its children are 2i + 1 and 2i + 2, and every parent is at least as large as its children. Peek reads index 0. Push appends at the end and sifts up, swapping with the parent while it is bigger.',
    'category' => 'Data Structures',
    'subcategory' => 'Heap',
    'topic' => 'Data Structures · Heap',
    'tags' => ['heap', 'mini-game'],
    'entry' => 'index.html',
    'related_guide' => 'heap',
    'related_session' => 'heap',
];
