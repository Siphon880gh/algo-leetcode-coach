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
            'message' => "Read the problem statement above.\nTest the first unselected student with?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'a[k] > k', 'next' => 's2'],
                ['label' => 'a[k] ≥ k', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Not selected needs strictly fewer selected; example 2 → 4 instead of 3.\nStep back to when you allowed equality.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Group sizes to test?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '1 … n − 1', 'next' => 'wrong_b'],
                ['label' => '0 … n', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Empty and full groups can work; the examples → 0 and 2 instead of 2 and 3.\nStep back to when you dropped the ends.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n). Examples → 2, 3.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
