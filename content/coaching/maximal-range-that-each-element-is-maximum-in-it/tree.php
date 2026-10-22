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
            'message' => "Problem: Given an array of distinct integers, return for each index the length of the longest subarray in which that element is the maximum. The limits are in the official statement. For instance, [1, 5, 4, 3, 6] → [1, 4, 2, 1, 5]. (Restated from memory; limits and examples may differ slightly.)\nBound i by?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The nearest greater element on each side', 'next' => 's2'],
                ['label' => 'The nearest smaller element', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. That is where i is the minimum; in code [1, 5, 4, 3, 6] → [5, 1, 2, 4, 1].\nStep back to when you used smaller.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Length?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'right − left + 1', 'next' => 'wrong_b'],
                ['label' => 'right − left − 1', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Both bounds lie outside; in code [1, 5, 4, 3, 6] → [3, 6, 4, 3, 7].\nStep back to when you added 1.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). [1, 5, 4, 3, 6] → [1, 4, 2, 1, 5].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
