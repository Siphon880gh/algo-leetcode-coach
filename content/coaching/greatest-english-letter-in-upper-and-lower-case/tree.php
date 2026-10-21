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
            'message' => "Read the problem statement above.\nOrder to check letters?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Z down to A', 'next' => 's2'],
                ['label' => 'In the order they appear in s', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 2 → A instead of R: a appears first but is not the greatest.\nStep back to when you scanned s in order.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Case of the answer?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Whichever form appears first in s', 'next' => 'wrong_b'],
                ['label' => 'Always uppercase', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 2 → r instead of R.\nStep back to when you returned the first form seen.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Letter qualifies when?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Both its uppercase and lowercase are in s', 'next' => 'success'],
                ['label' => 'Either form is in s', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Example 3 → K instead of the empty string.\nStep back to when you accepted one form.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → E, R, empty.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
