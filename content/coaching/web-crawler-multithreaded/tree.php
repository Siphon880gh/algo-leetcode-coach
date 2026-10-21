<?php
declare(strict_types=1);

/**
 * Step-by-step tree contract:
 * - start: node id
 * - nodes[id]: message, outcome (continue|wrong|success), choices[{label, next}], optional rewind_to on wrong
 */
return [
    'start' => 'start',
    'nodes' => [
        'start' => [
            'message' => "Problem: Same as Web Crawler (collect every same-host URL reachable from the start through a slow HtmlParser.getUrls), but crawl with multiple threads to finish faster. (Restated from memory; limits and examples may differ slightly.)\nWho updates the seen set?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'One coordinator thread, or any thread under a lock', 'next' => 's2'],
                ['label' => 'Workers without a lock', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Two threads can claim the same URL.\nStep back to when you dropped the lock.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Wait for all pending fetches each round?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Yes', 'next' => 'wrong_b'],
                ['label' => 'No: handle each as it completes', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. That is level-by-level BFS and wastes threads.\nStep back to when you waited for all.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "When is the crawl done?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No fetches are pending', 'next' => 'success'],
                ['label' => 'The queue is empty once', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Running fetches can still add URLs.\nStep back to when you checked only the queue.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. About pages / threads fetch rounds. Same result as the single-threaded crawl.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
