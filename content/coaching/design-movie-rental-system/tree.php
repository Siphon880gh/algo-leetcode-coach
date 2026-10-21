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
            'message' => "Read the problem statement above.\nUnrented copies stored?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Per movie, ordered by (price, shop)', 'next' => 's2'],
                ['label' => 'One flat list scanned on search', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Scanning all entries per search is slow.\nStep back to when you used a flat list.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Rent?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Only add to rented', 'next' => 'wrong_b'],
                ['label' => 'Move the entry from available to rented', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The copy would still show up in search.\nStep back to when you left it available.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Report tie order?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Price, then shop, then movie', 'next' => 'success'],
                ['label' => 'Price, then movie', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Shop comes before movie in the tie-break.\nStep back to when you skipped shop.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Example → [1,0,2], [[0,1],[1,2]], [0,1].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
