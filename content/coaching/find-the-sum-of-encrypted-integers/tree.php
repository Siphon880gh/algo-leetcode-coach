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
            'message' => "Read the problem statement above.\nencrypt(x)?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Largest digit, once per digit of x', 'next' => 's2'],
                ['label' => 'Largest digit once', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 2 → 6 instead of 66.\nStep back to when you dropped the repeats.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Repeat count?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Distinct digits of x', 'next' => 'wrong_b'],
                ['label' => 'All digits of x', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. 100 → 11 instead of 111.\nStep back to when you counted distinct digits.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n · digits). Examples → 6, 66.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
