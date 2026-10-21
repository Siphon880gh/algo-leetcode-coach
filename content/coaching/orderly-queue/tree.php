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
            'message' => "Read the problem statement above.\nk = 1. Which strings can you reach?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Only rotations of s', 'next' => 's2'],
                ['label' => 'Any permutation', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Moving the first letter to the back only rotates.\nStep back to when you allowed any order.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "k ≥ 2. Which strings can you reach?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Only rotations', 'next' => 'wrong_b'],
                ['label' => 'Any permutation, so return the sorted string', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. With two choices you can swap neighbors in effect, which reaches every order.\nStep back to when you limited it to rotations.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Simulate moves for k ≥ 2?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: sort directly', 'next' => 'success'],
                ['label' => 'Yes, BFS over strings', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The state space is huge and the answer is known.\nStep back to when you simulated.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n²) for k = 1, O(n log n) otherwise. \"cba\", k = 1 → \"acb\". \"baaca\", k = 3 → \"aaabc\".\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
