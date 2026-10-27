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
            'message' => "Read the problem statement above.\n[8, 8, 2] has counts 2 and 1. Is it a staircase?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Yes, the counts are 1 and 2', 'next' => 'wrong_a'],
                ['label' => 'No, 8 appears first, so it must appear once', 'next' => 's2'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. The order of first appearance matters. Ignoring it gives 10 instead of 9 for Example 1.\nStep back to when you ignored the order.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "From a fixed left end, a count passes its order. Can extending further fix it?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Yes, a new value might balance it', 'next' => 'wrong_b'],
                ['label' => 'No, counts only grow, so stop', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The extra copy stays inside every longer subarray from this left end.\nStep back to when you kept extending.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. One scan per left end with an early stop. O(n²). Examples give 9, 5 and 8.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
