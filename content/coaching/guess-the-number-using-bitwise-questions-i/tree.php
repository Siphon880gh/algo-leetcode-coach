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
            'message' => "Problem: There is a hidden number n. You may call an API, named in the statement, with a number num; it returns how many set bits n and num have in common, that is, the number of 1 bits in n AND num. Find n. The API name and limits on n are in the official statement. For instance, if n = 31, asking with 1, 2, 4, 8, 16 each returns 1, and asking with 32 returns 0. (Restated from memory; limits and examples may differ slightly.)\nAsk with?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '2^i for each bit', 'next' => 's2'],
                ['label' => 'All ones', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. That only gives the bit count; 3 and 5 both answer 2.\nStep back to when you asked with all ones.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "An answer of 1 for 2^i means?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Add 1', 'next' => 'wrong_b'],
                ['label' => 'Add 2^i', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. n = 31 comes out 5.\nStep back to when you added 1.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. One question per bit. n = 31 → 31.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
