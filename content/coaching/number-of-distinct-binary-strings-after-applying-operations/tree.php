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
            'message' => "Problem: You get a binary string s and an integer k. In one operation you pick any substring of length k and flip every character in it. Return how many distinct strings you can reach, counting s itself, modulo the large prime the statement gives. For instance, s = 1001 with k = 3 → 4, and s = 10110 with k = 5 → 2. (Restated from memory; limits and examples may differ slightly.)\nHow many windows?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'n − k + 1', 'next' => 's2'],
                ['label' => 'n − k', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. The window starting at n − k counts too; s = 1001, k = 3 → 2 instead of 4.\nStep back to when you dropped the last window.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Find the count how?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'BFS over the reachable strings', 'next' => 'wrong_b'],
                ['label' => '2^(n − k + 1) modulo the prime', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The BFS visits all 2^(n − k + 1) strings, far too many once n − k reaches a few dozen.\nStep back to when you searched.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(log n). Constructed checks → 4, 2.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
