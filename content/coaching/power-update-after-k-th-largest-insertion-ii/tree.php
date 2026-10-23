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
            'message' => "Problem: You get an integer array nums, an integer p and queries of the form [val, k]. For each query, add val to nums, let x be the k-th largest value now in nums, and replace p with p^x modulo 10^9 + 7. Return the value of p after each query. This is the larger version of the problem. Limits are in the official statement. (Restated from memory; limits and examples may differ slightly.)\nWhich order?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'k-th largest', 'next' => 's2'],
                ['label' => 'k-th smallest', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Constructed check (made-up values, run in code): nums = [3, 1, 2], p = 2, queries = [[4, 1], [1, 3]] → [2, 4] instead of [16, 256].\nStep back to when you counted from the bottom.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Insert first?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Select, then insert', 'next' => 'wrong_b'],
                ['label' => 'Yes, then select', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Same check → [8, 64] instead of [16, 256].\nStep back to when you selected before inserting.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O((n + q) log (n + q) + q log V). Constructed checks → [16, 256], [9, 4782969].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
