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
            'message' => "Read the problem statement above.\nAfter one doubling?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Keep checking and doubling', 'next' => 's2'],
                ['label' => 'Stop', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 1 → 24, not 6.\nStep back to when you stopped after one.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "original not in nums?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Return 0', 'next' => 'wrong_b'],
                ['label' => 'Return it unchanged', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 2 → 4.\nStep back to when you returned 0.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Duplicates of a value?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Ignore them: membership only', 'next' => 'success'],
                ['label' => 'Double once per copy', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. nums = [2,2], original = 2 → 4, not 8.\nStep back to when you doubled per copy.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → 24, 4.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
