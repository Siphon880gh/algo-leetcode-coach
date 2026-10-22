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
            'message' => "Problem: Given an integer array nums, count the subarrays whose product is even. For instance, [9,6,7,13] → 6 and [7,3,5] → 0. (Restated from memory; limits and examples may differ slightly.)\nFor end i, add?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'last + 1', 'next' => 's2'],
                ['label' => 'i − last', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. That counts the all-odd subarrays; [9,6,7,13] → 4 instead of 6.\nStep back to when you added i − last.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Before any even number, last is?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '0', 'next' => 'wrong_b'],
                ['label' => '−1', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Index 0 would count as even; [7,3,5] → 3 instead of 0.\nStep back to when you started at 0.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Constructed checks → 6, 0.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
