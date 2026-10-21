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
            'message' => "Problem: Problem: Given an array coins (1-indexed) where -1 marks a blocked index, and a number maxJump, travel from index 1 to index n. Each jump moves forward at most maxJump, and you pay coins[i] at every index you land on. Return the cheapest path as a list of indexes, picking the lexicographically smallest one on ties, or an empty list if n cannot be reached. (Restated from memory; limits and examples may differ slightly.)\nDP forward from the start, or backward from the end?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Backward: cost[i] is the cheapest way from i to n', 'next' => 's2'],
                ['label' => 'Forward, then trace the path back', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Ties broken by tracing back do not yield the lexicographically smallest path, since the choices nearest the start matter most.\nStep back to when you chose forward.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "For index i, scan j = i + 1 … i + maxJump. How do you break ties?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Keep the last j with the minimum', 'next' => 'wrong_b'],
                ['label' => 'Scan j upward and update only on a strictly smaller cost', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The smallest next index gives the lexicographically smallest path.\nStep back to when you kept the last tie.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Build the answer how?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Follow next[] from index 1; if cost[1] is infinite, return []', 'next' => 'success'],
                ['label' => 'Sort the visited indexes', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. next[] already chains the path; sorting would lose it.\nStep back to when you sorted.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Backward DP with the smallest-index tie-break: O(n · maxJump). [1,2,4,-1,2], maxJump = 2 → [1,3,5]; maxJump = 1 → [].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
