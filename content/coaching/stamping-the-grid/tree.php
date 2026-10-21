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
            'message' => "Read the problem statement above.\nWhich stamps to place?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Every legal position, overlaps allowed', 'next' => 's2'],
                ['label' => 'Non-overlapping tiles only', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Example 1 needs two overlapping 4 × 3 stamps to cover the 5 × 3 empty area.\nStep back to when you forbade overlap.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Is a block free of occupied cells?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Scan the h × w block', 'next' => 'wrong_b'],
                ['label' => 'One 2D prefix-sum query', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Scanning each block costs O(m · n · h · w).\nStep back to when you scanned.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Mark coverage how?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '2D difference array, then prefix sums', 'next' => 'success'],
                ['label' => 'Increment every cell of every stamp', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. That repeats the h · w cost per stamp.\nStep back to when you marked cell by cell.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(m · n). Examples → true, false.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
