<?php
declare(strict_types=1);

return [
    'title' => 'Web Crawler Multithreaded: parallel BFS with a shared set',
    'leetcode' => 1242,
    'difficulty' => 'Med',
    'summary' => 'Run getUrls calls in a thread pool. Keep a visited set guarded by a lock (or only touched by the coordinating thread), submit a task for each new same-host URL, and finish when no tasks are pending.',
    'category' => 'LeetCode',
    'subcategory' => 'Concurrency',
    'topic' => 'LeetCode · Concurrency',
    'kind' => 'algo',
    'tags' => ['concurrency', 'bfs', 'graphs', 'leetcode'],
    'related_session' => 'web-crawler-multithreaded',
];
