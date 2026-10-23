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
            'message' => "Read the problem statement above.\nUse every pick?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Only positive gains', 'next' => 's2'],
                ['label' => 'All m picks', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 3 → 0 instead of 7.\nStep back to when you spent picks on negative gains.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Repeat an index?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No, once each', 'next' => 'wrong_b'],
                ['label' => 'Yes, while its gain is high enough', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 1 → 15 instead of 19.\nStep back to when you picked each index once.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log V). Examples → 19, 11, 7.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
