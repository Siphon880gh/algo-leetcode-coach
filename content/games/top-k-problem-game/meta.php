<?php
declare(strict_types=1);

return [
    'title' => 'Top K with a Min-Heap',
    'summary' => 'Keep a min-heap of size k. Push the first k values. For each later value x, if x is bigger than the heap top (the smallest of the kept values), pop the top and push x. At the end the heap holds the k largest values.',
    'category' => 'Data Structures',
    'subcategory' => 'Heap',
    'topic' => 'Data Structures · Heap',
    'tags' => ['heap', 'mini-game'],
    'entry' => 'index.html',
    'related_guide' => 'top-k-problem',
    'related_session' => 'top-k-problem',
];
