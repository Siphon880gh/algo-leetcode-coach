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
            'message' => "Read the problem statement above.\nSort with a comparator that searches arr2 every time?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: count values once', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Each comparison would cost O(len(arr2)).\nStep back to when you searched arr2.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "After placing arr2's values, what is left?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Values not in arr2, in input order', 'next' => 'wrong_b'],
                ['label' => 'Values not in arr2, in ascending order', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Leftovers must be sorted.\nStep back to when you kept input order.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Why does a counting array work?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Values are at most 1000', 'next' => 'success'],
                ['label' => 'arr1 is sorted', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. arr1 is not sorted.\nStep back to when you said sorted.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n + 1001). [2,3,1,3,2,4,6,7,9,2,19], [2,1,4,3,9,6] → [2,2,2,1,4,3,3,9,6,7,19]. [28,6,22,8,44,17], [22,28,8,6] → [22,28,8,6,17,44].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
