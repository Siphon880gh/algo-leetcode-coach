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
            'message' => "Read the problem statement above.\nDuplicates by?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'subset=email', 'next' => 's2'],
                ['label' => 'Whole rows', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. The ids differ, so nothing is dropped; all 6 rows stay.\nStep back to when you compared whole rows.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Keep?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'keep=last', 'next' => 'wrong_b'],
                ['label' => 'The first occurrence (default)', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. That keeps customer 5 instead of 4.\nStep back to when you kept the last.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). The example keeps customers 1, 2, 3, 4, 6.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
