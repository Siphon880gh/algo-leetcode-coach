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
            'message' => "Problem: You get a permutation nums of 0 … n − 1 and a list pre of allowed lengths. One operation picks a length x from pre and reverses the first x elements of nums. Return the fewest operations that sort nums in increasing order, or −1 if it cannot be sorted. n is very small. Limits are in the official statement. (Restated from memory; limits and examples may differ slightly.)\nSearch how?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'BFS over permutations', 'next' => 's2'],
                ['label' => 'Greedily fix the most positions', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Constructed check (made-up values, run in code): nums = [1, 2, 0], pre = [1, 3, 2] → 4 instead of 2.\nStep back to when you chose greedily.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Visited set?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No visited set', 'next' => 'wrong_b'],
                ['label' => 'Mark each permutation when it is queued', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Constructed check (made-up values, run in code): nums = [1, 0, 2, 3, 4, 5, 6, 7], pre = [8, 7] never finishes instead of returning −1.\nStep back to when you dropped the visited set.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n! · |pre| · n). Constructed checks → 2, −1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
