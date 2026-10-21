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
            'message' => "Problem: Given stick lengths, joining sticks of lengths x and y costs x + y and leaves one stick of that length. Return the minimum total cost to end with one stick. For instance, [2,4,3] costs 14 and [1,8,3,5] costs 30. (Restated from memory; limits and examples may differ slightly.)\nMerge which two?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The two shortest', 'next' => 's2'],
                ['label' => 'The two longest', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Long sticks would be paid again and again.\nStep back to when you took the longest.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Sort once and merge left to right?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Yes', 'next' => 'wrong_b'],
                ['label' => 'No: the merged stick re-enters a heap', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. A merged stick may not be the next shortest.\nStep back to when you sorted once.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Only one stick. Cost?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '0', 'next' => 'success'],
                ['label' => 'Its length', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. No join is needed.\nStep back to when you charged its length.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n). [2,4,3] → 14. [1,8,3,5] → 30.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
