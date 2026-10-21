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
            'message' => "Problem: Problem: A sorted array of unique integers is only reachable through get(i), which returns the value at index i, or 2³¹ − 1 past the end. Return the index of target, or -1, without knowing the length. (Restated from memory; limits and examples may differ slightly.)\nFind the length first by stepping one index at a time?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: double hi until get(hi) ≥ target', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. That is O(n); doubling brackets the target in O(log p).\nStep back to when you stepped one at a time.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "get(hi) returns 2³¹ − 1. Problem?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Yes: handle it separately', 'next' => 'wrong_b'],
                ['label' => 'No: it acts like +∞ and stops the doubling', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. A value larger than any real one fits the sorted order.\nStep back to when you added a special case.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Binary search over which range?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '[hi / 2, hi]', 'next' => 'success'],
                ['label' => '[0, 2³¹ − 1]', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. That works but wastes steps; the doubling already narrowed it.\nStep back to when you searched the full range.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Doubling plus binary search: O(log p). [-1,0,3,5,9,12], target 9 → 4; target 2 → -1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
