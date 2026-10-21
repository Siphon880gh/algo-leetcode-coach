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
            'message' => "Read the problem statement above.\nState?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '(operations done, picks from the left)', 'next' => 's2'],
                ['label' => '(left pointer, right pointer)', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. With n up to 10^5 that table is too large.\nStep back to when you used both pointers.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Greedy the larger product?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Yes', 'next' => 'wrong_b'],
                ['label' => 'No, DP', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Negative values make greedy fail, as in example 2.\nStep back to when you went greedy.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Memory?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Roll over i: O(m)', 'next' => 'success'],
                ['label' => 'Full m × n table', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Only m + 1 left counts matter per row.\nStep back to when you built m × n.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(m²). Examples → 14, 102.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
