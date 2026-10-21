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
            'message' => "Read the problem statement above.\nBucket by?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Height (at most 100)', 'next' => 's2'],
                ['label' => 'Length (up to 10^9)', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. There can be 5 · 10^4 distinct lengths, so each query would scan far too many buckets.\nStep back to when you bucketed by length.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Heights to include?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Only h = y', 'next' => 'wrong_b'],
                ['label' => 'Every h ≥ y', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 1 → [0,0] instead of [2,1].\nStep back to when you used one height.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Point on an edge?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Contained: l ≥ x and h ≥ y', 'next' => 'success'],
                ['label' => 'Not contained: l > x and h > y', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Example 1 → [0,1] instead of [2,1].\nStep back to when you used strict comparisons.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(P · 100 · log R). Examples → [2,1], [1,3].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
