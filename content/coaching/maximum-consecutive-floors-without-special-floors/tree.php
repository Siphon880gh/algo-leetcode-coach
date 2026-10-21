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
            'message' => "Read the problem statement above.\nFree floors between specials a < b?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'b − a − 1', 'next' => 's2'],
                ['label' => 'b − a', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. That counts one of the specials; Example 2 → 1 instead of 0.\nStep back to when you used b − a.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Floors below the first and above the last special?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Only gaps between specials', 'next' => 'wrong_b'],
                ['label' => 'Include them', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 1 → 1 instead of 3 (floors 7 to 9).\nStep back to when you skipped the ends.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Special order?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Sort first', 'next' => 'success'],
                ['label' => 'Use the input order', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Example 2 arrives as [7,6,8] → 1 instead of 0.\nStep back to when you skipped sorting.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(k log k). Examples → 3, 0.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
