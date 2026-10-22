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
            'message' => "Read the problem statement above.\nCan letters move between words?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Yes, swaps reach any position', 'next' => 's2'],
                ['label' => 'No, only within a word', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 1 → 1 instead of 3.\nStep back to when you kept letters in place.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Spend pairs on?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Longest words first', 'next' => 'wrong_b'],
                ['label' => 'Shortest words first', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. ['ad', 'dc', 'cbdc'] → 1 instead of 2.\nStep back to when you started with the longest.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(total + n log n). Examples → 3, 2, 1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
