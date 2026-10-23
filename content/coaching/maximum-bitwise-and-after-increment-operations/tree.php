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
            'message' => "Read the problem statement above.\nBit order?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'High to low', 'next' => 's2'],
                ['label' => 'Low to high', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 1 → 3 instead of 6.\nStep back to when you started at bit 0.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Cost for x to contain t?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 't − x, or free when x > t', 'next' => 'wrong_b'],
                ['label' => 'Smallest y ≥ x with y AND t = t, minus x', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 2 → 6 instead of 4.\nStep back to when you treated big numbers as free.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(B · n log n). Examples → 6, 4, 2.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
