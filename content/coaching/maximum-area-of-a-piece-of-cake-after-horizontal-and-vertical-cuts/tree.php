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
            'message' => "Read the problem statement above.\nEdges 0 and h?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Include them', 'next' => 's2'],
                ['label' => 'Only between cuts', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. The border pieces count.\nStep back to when you skipped the edges.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Unsorted cuts?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Use input order', 'next' => 'wrong_b'],
                ['label' => 'Sort first', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Gaps need sorted positions.\nStep back to when you skipped sorting.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Overflow?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '64-bit product, then mod', 'next' => 'success'],
                ['label' => '32-bit product', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Gaps up to 10^9 overflow.\nStep back to when you used 32 bits.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(H log H + V log V). Examples → 4, 6, 9.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
