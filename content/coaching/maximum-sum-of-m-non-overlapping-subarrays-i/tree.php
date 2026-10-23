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
            'message' => "Read the problem statement above.\nHow many subarrays?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Any count from 1 to m', 'next' => 's2'],
                ['label' => 'Exactly m', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 4 → −4 instead of −1.\nStep back to when you forced m subarrays.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Allowed starts for a subarray ending at i?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Any t < i', 'next' => 'wrong_b'],
                ['label' => 't in [i − r, i − l]', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 3 → 7 instead of 6.\nStep back to when you dropped the length limits.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(m · n). Examples → 7, 8, 6, −1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
