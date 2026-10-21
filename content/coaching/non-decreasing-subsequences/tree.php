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
            'message' => "Read the problem statement above.\nWhat do you try first?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Backtrack in original order; at each depth pick the next element', 'next' => 's2'],
                ['label' => 'Sort first, then skip duplicates like 90', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Sorting changes which subsequences exist. Order matters here.\nStep back to when you sorted.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Two 7s can both start the same branch.\nHow do you stop duplicates?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'One set for the whole search', 'next' => 'wrong_b'],
                ['label' => 'A fresh used set per depth: each value at most once per level', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. A global set of chosen values blocks [7,7], which is a valid answer.\nStep back to when you used one global set.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Skip nums[i] < path[-1]. Record a copy when len(path) >= 2. Worst case O(2^n · n).\nLock it in?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Per-level used set, record at every length ≥ 2. Not 300 / 90', 'next' => 'success'],
                ['label' => 'Record only when i reaches the end', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Recording only at leaves loses the shorter lists like [4,6].\nStep back to when you recorded at leaves only.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Backtrack in order with a per-level set and record on the way. [4,6,7,7] → 8 lists.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
