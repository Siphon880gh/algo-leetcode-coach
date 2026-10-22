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
            'message' => "Read the problem statement above.\nBefore the greedy check?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Sort the prices', 'next' => 's2'],
                ['label' => 'Keep the input order', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Gaps between unsorted neighbours mean nothing; Example 1 → 0 instead of 8.\nStep back to when you skipped sorting.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Take the next candy when?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'x − last > d', 'next' => 'wrong_b'],
                ['label' => 'x − last ≥ d', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. A gap of exactly d is allowed; Example 1 → 7 instead of 8.\nStep back to when you used >.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n + n log(max price)). Examples → 8, 2, 0.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
