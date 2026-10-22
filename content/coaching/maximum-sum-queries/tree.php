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
            'message' => "Read the problem statement above.\nAnswer each query how?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Offline by x, with a suffix-max tree over nums2', 'next' => 's2'],
                ['label' => 'Scan every index', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. n · q = 10^10 steps.\nStep back to when you scanned all indices.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Store sums in?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'A 32-bit int', 'next' => 'wrong_b'],
                ['label' => 'A 64-bit integer', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. A sum reaches 2 · 10^9, past 2^31 − 1.\nStep back to when you chose 32 bits.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O((n + q) log n). Examples → [6, 10, 7], [9, 9, 9], [−1].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
