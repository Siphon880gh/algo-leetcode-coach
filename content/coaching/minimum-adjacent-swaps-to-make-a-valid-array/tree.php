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
            'message' => "Problem: You are given an integer array nums. In one operation you may swap two adjacent elements. The array is valid when its leftmost element is a smallest element of the array and its rightmost element is a largest element. Return the minimum number of swaps needed to make nums valid. For instance, [3,4,5,5,3,1] → 6; [2,5,1] → 2; [9] → 0. (Restated from memory; limits and examples may differ slightly.)\nWhich minimum moves to the front?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The leftmost', 'next' => 's2'],
                ['label' => 'The rightmost', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. A farther copy costs more swaps; [1,3,1] → 2 instead of 1.\nStep back to when you chose the rightmost minimum.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Which maximum moves to the back?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The leftmost', 'next' => 'wrong_b'],
                ['label' => 'The rightmost', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. A farther copy costs more swaps; [3,1,3] → 2 instead of 1.\nStep back to when you chose the leftmost maximum.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Minimum starts right of the maximum?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Subtract 1', 'next' => 'success'],
                ['label' => 'No adjustment', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. One swap moves both; [2,5,1] → 3 instead of 2.\nStep back to when you skipped the adjustment.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Constructed checks → 6, 2, 0.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
