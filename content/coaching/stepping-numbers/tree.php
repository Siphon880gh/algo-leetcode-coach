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
            'message' => "Problem: A stepping number has adjacent digits differing by exactly 1. Given low and high, return all stepping numbers in that range in increasing order. For instance, low = 10, high = 15 gives [10,12]. (Restated from memory; limits and examples may differ slightly.)\nTest every number in the range?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: generate stepping numbers', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. The range can be huge.\nStep back to when you tested every number.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Seed the BFS with 0?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Yes', 'next' => 'wrong_b'],
                ['label' => 'No: add 0 separately when low is 0', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. It would create numbers with leading zeros.\nStep back to when you seeded 0.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Children of 9?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Only 98', 'next' => 'success'],
                ['label' => '98 and 910', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. 10 is not a digit.\nStep back to when you appended 10.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(count). low = 10, high = 15 → [10,12]. low = 0, high = 21 → [0,1,…,9,10,12,21].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
