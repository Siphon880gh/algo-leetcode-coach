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
            'message' => "Read the problem statement above.\nQuery values up to?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'x − 1', 'next' => 's2'],
                ['label' => 'x', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Equal values are not strictly increasing; nums = [1,1,1], k = 1 → 3 instead of 1.\nStep back to when you included x.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Query values down to?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'x − k − 1', 'next' => 'wrong_b'],
                ['label' => 'x − k', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The gap would reach k + 1; nums = [1,3], k = 1 → 2 instead of 1.\nStep back to when you widened the range.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Range maximum how?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'A segment tree over values', 'next' => 'success'],
                ['label' => 'Scan every earlier element', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. That is about 10^5 · 10^5 / 2 = 5 · 10^9 steps.\nStep back to when you scanned.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log V). Examples → 5, 4, 1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
