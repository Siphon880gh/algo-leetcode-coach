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
            'message' => "Read the problem statement above.\nReverse which numbers?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Only the originals', 'next' => 's2'],
                ['label' => 'Keep reversing every new number too', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. [120] → 3 instead of 2, since 21 reverses to 12.\nStep back to when you reversed the added numbers.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Answer?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Twice the length of nums', 'next' => 'wrong_b'],
                ['label' => 'The size of the set', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Duplicates count once; Example 2 → 6 instead of 1.\nStep back to when you counted every addition.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n · digits). Examples → 6, 1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
