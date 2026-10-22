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
            'message' => "Problem: You are given a permutation of 1 … n. Return its index among all permutations of 1 … n in lexicographic order, modulo the number the statement gives. Limits are in the official statement. For instance, counting from 0, [3, 1, 2] → 4. (Restated from memory; limits and examples may differ slightly.)\nCount at position i?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Unused values below perm[i]', 'next' => 's2'],
                ['label' => 'All values below perm[i]', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. [3, 1, 2] → 5 instead of 4.\nStep back to when you counted used values.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Weight?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '(n − i)!', 'next' => 'wrong_b'],
                ['label' => '(n − 1 − i)!', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. [3, 1, 2] → 12 instead of 4.\nStep back to when you used (n − i)!.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n). Counting from 0, [3, 1, 2] → 4.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
