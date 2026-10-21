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
            'message' => "Read the problem statement above.\nWindow over?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Daily totals', 'next' => 's2'],
                ['label' => 'Raw customer rows', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Two visits on one day would take two slots.\nStep back to when you used raw rows.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Frame?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '7 preceding through current', 'next' => 'wrong_b'],
                ['label' => '6 preceding through current', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. That is 8 days.\nStep back to when you used 7 preceding.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "First six days?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Excluded', 'next' => 'success'],
                ['label' => 'Included with partial windows', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Their windows are incomplete.\nStep back to when you included them.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. 2019-01-07 → 860, 122.86. 2019-01-10 → 1000, 142.86.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
