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
            'message' => "Problem: Given a start URL and an HtmlParser whose getUrls(url) lists a page's links, return every URL reachable from the start that shares its hostname, visiting each once. (Restated from memory; limits and examples may differ slightly.)\nFollow links to other hosts?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No', 'next' => 's2'],
                ['label' => 'Yes, they may link back', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Pages on other hosts are out of scope.\nStep back to when you followed them.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Compare hosts how?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'URL prefix match', 'next' => 'wrong_b'],
                ['label' => 'Exact hostname equality', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. A prefix can match a longer, different hostname.\nStep back to when you used a prefix.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Mark visited when?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'When enqueuing', 'next' => 'success'],
                ['label' => 'When dequeuing', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. A URL could be enqueued many times.\nStep back to when you marked on dequeue.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(pages + links). Every same-host URL once.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
