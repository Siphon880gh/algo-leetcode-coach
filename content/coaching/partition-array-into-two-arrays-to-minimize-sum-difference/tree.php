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
            'message' => "Read the problem statement above.\nTry every choice of n elements from 2n?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: meet in the middle', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. C(30, 15) is about 1.5 · 10^8 subsets, each needing a sum.\nStep back to when you enumerated directly.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Group each half's subset sums by?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Nothing: one list per half', 'next' => 'wrong_b'],
                ['label' => 'How many elements they take', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Taking k from the left forces exactly n − k from the right.\nStep back to when you merged all sizes.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "After the binary search, which candidates?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Both neighbours of the insertion point', 'next' => 'success'],
                ['label' => 'Only the first value ≥ the target', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The closest sum may be just below the target.\nStep back to when you checked one side.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(2^n · n). Examples → 2, 72, 0.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
