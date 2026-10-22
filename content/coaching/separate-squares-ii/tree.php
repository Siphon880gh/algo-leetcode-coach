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
            'message' => "Read the problem statement above.\nOverlaps?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Count once', 'next' => 's2'],
                ['label' => 'Count twice', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 2 → 7 / 6 instead of 1.\nStep back to when you counted twice.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Width per strip?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Rescan every square', 'next' => 'wrong_b'],
                ['label' => 'Segment tree over x', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. That is O(n²), about 2.5 · 10^9 at n = 5 · 10^4.\nStep back to when you rescanned.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n). Examples → 1, 1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
