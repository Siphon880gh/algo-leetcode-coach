<?php
declare(strict_types=1);

return [
    'title' => 'Web Crawler Multithreaded: parallel fetches',
    'leetcode' => 1242,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: submit getUrls calls to a thread pool, process results as they complete, mark new same-host URLs as seen before submitting them, and stop when nothing is pending. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Concurrency',
    'topic' => 'LeetCode · Concurrency',
    'related_guide' => 'web-crawler-multithreaded',
    'tags' => ['concurrency', 'bfs', 'graphs', 'step-by-step'],
];
