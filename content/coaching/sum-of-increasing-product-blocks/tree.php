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
            'message' => "Problem: Write the positive integers in order and cut them into blocks: the first block holds 1 number, the second the next 2, the third the next 3, and so on. Each block’s value is the product of its numbers. Return the sum of the first n block values modulo 10^9 + 7. Limits are in the official statement. (Restated from memory; limits and examples may differ slightly.)\nBlock i starts at?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Right after the previous block', 'next' => 's2'],
                ['label' => 'At i', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Constructed check (run in code): n = 4 → 907 instead of 5167.\nStep back to when you restarted at i.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "After block i, move the start by?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '1', 'next' => 'wrong_b'],
                ['label' => 'i', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Constructed check (run in code): n = 4 → 907 instead of 5167.\nStep back to when you moved by 1.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n²). Constructed checks → 1, 7, 5167.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
