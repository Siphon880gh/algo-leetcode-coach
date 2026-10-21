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
            'message' => "Read the problem statement above.\nWhere does −1 go?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'At the death year', 'next' => 's2'],
                ['label' => 'At death + 1', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. People are not counted in the year they die.\nStep back to when you used death + 1.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Tie between years?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Use >= and keep the later', 'next' => 'wrong_b'],
                ['label' => 'Keep the earliest via strict >', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The statement wants the earliest year.\nStep back to when you used >=.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Array size?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '101 years from 1950', 'next' => 'success'],
                ['label' => 'One slot per person', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Index by year, not person.\nStep back to when you indexed by person.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n + 101). Examples → 1993, 1960.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
