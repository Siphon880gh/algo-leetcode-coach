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
            'message' => "Read the problem statement above.\nCheck first?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'All five suits equal → Flush', 'next' => 's2'],
                ['label' => 'Rank counts', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 1 has five distinct ranks → High Card instead of Flush.\nStep back to when you checked ranks first.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Three of a Kind when the top count is?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Exactly 3', 'next' => 'wrong_b'],
                ['label' => '3 or more', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 2 has four 4s → High Card instead of Three of a Kind.\nStep back to when you required exactly 3.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Pair needs?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Top count of 2', 'next' => 'success'],
                ['label' => 'Two different ranks that repeat', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Example 3 has one pair of 10s → High Card instead of Pair.\nStep back to when you required two pairs.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(1). Examples → Flush, Three of a Kind, Pair.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
