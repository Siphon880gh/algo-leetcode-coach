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
            'message' => "Read the problem statement above.\nRestricted node?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Never enter it', 'next' => 's2'],
                ['label' => 'Enter it but do not count it', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Paths pass through it; Example 1 → 5 instead of 4.\nStep back to when you entered restricted nodes.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Edges?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Only a → b', 'next' => 'wrong_b'],
                ['label' => 'Add both directions', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 1 → 3 instead of 4.\nStep back to when you used one direction.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Check restriction with?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'A hash set or boolean array', 'next' => 'success'],
                ['label' => 'Scanning the restricted list each time', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Up to 10^5 checks over a list of up to 10^5 is about 10^10.\nStep back to when you scanned the list.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → 4, 3.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
