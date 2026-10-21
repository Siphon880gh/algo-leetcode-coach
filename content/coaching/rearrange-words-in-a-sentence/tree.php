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
            'message' => "Read the problem statement above.\nTie between equal lengths?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Keep original order', 'next' => 's2'],
                ['label' => 'Alphabetical', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. The statement keeps the original order.\nStep back to when you sorted alphabetically.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Capitalised first word?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Keep its capital', 'next' => 'wrong_b'],
                ['label' => 'Lowercase it first', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. It may move to the middle.\nStep back to when you kept the capital.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Sort type?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Stable', 'next' => 'success'],
                ['label' => 'Any', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Unstable sorts may reorder ties.\nStep back to when you used any sort.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n). \"Leetcode is cool\" → \"Is cool leetcode\". \"To be or not to be\" → \"To be or to be not\".\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
