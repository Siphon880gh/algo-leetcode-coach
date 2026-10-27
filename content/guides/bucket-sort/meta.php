<?php
declare(strict_types=1);

return [
    'title' => 'Bucket sort: split by range, then sort each bucket',
    'summary' => 'Bucket sort drops values into buckets by range, sorts each small bucket, and joins them, which is fast when the data is spread evenly.',
    'category' => 'Algorithms',
    'subcategory' => 'Sorting',
    'kind' => 'algo',
    'tags' => ['bucket-sort'],
    'related_session' => 'bucket-sort',
    'topic' => 'Algorithms · Sorting',
    'related_game' => 'bucket-sort-game',
];
