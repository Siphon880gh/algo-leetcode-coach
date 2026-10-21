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
            'message' => "Read the problem statement above.\nOn a 0?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'z = 2z + 1', 'next' => 's2'],
                ['label' => 'z = z + 1', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Each existing 0-run can include or skip the new 0.\nStep back to when you only added one.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "On a 1?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'o = o + z', 'next' => 'wrong_b'],
                ['label' => 'o = 2o + z', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Existing 0+1+ sequences can also take this 1.\nStep back to when you dropped the doubling.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Answer?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 't', 'next' => 'success'],
                ['label' => 'z + o + t', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Only complete 0+1+2+ sequences count.\nStep back to when you added partial ones.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → 3, 0, 7.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
