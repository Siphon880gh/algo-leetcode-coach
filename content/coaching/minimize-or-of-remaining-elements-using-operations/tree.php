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
            'message' => "Read the problem statement above.\nMerges needed for a mask?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'n minus the number of groups', 'next' => 's2'],
                ['label' => 'The number of groups', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 1 → 2^30 − 4 instead of 3.\nStep back to when you counted groups.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Keep a bit when merges are?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Fewer than k', 'next' => 'wrong_b'],
                ['label' => 'At most k', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Exactly k merges are allowed; example 1 → 7 instead of 3.\nStep back to when you used fewer than k.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(30 n). Examples → 3, 2, 15.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
