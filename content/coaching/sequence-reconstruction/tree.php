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
            'message' => "Problem: nums is a permutation of 1..n. Every sequences[i] is a subsequence of nums. Return true if nums is the only shortest sequence that contains all of them. [1,2,3], [[1,2],[1,3]] → false ([1,3,2] also works). [1,2,3], [[1,2]] → false. [1,2,3], [[1,2],[1,3],[2,3]] → true. (Restated from memory; limits and examples may differ slightly.)\nWhat do you try first?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Build edges from adjacent pairs and check for a unique topological order', 'next' => 's2'],
                ['label' => 'Check that each sequence is a subsequence of nums and stop there', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Every sequence is already a subsequence of nums by the statement, so that check always passes. The real question is whether another order also works.\nStep back to when you only checked that nums contains each sequence.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Edges: for each sequence, a → b for every adjacent pair. In-degrees counted. Kahn's queue starts with in-degree 0 nodes.\nWhen is the order not unique?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Only when there is a cycle', 'next' => 'wrong_b'],
                ['label' => 'Whenever the queue holds two or more nodes at the same time', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Two ready nodes at once means either could go first, so more than one shortest order exists.\nStep back to when you allowed several ready nodes.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Also every node must be popped: if a node never reaches in-degree 0 or is never constrained, nums is not the only answer. O(n + total sequence length). Course Schedule II (210) returns any order.\nLock it in?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Adjacent-pair edges, Kahn with exactly one ready node each step. Not 210', 'next' => 'success'],
                ['label' => 'Add an edge between every pair in each sequence, not just adjacent ones', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Edges only between adjacent elements are enough; extra edges between far elements are implied and slow things down.\nStep back to when you added all pairs.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Adjacent pairs become edges, and Kahn must always have exactly one ready node. [[1,2],[1,3],[2,3]] → true.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
