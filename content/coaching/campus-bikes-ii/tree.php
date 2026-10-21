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
            'message' => "Problem: There are n workers and m bikes on a grid, 1 ≤ n ≤ m ≤ 10. Give each worker a different bike so the total Manhattan distance is as small as possible, and return that total. workers = [[0,0],[2,1]], bikes = [[1,2],[3,3]] → 6. workers = [[0,0],[1,1],[2,0]], bikes = [[1,0],[2,2],[2,1]] → 4. (Restated from memory; limits and examples may differ slightly.)\nUse the greedy closest-pair order from Campus Bikes?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: that does not minimize the total', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. A locally closest pair can force long trips later.\nStep back to when you used greedy.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "What does the state need?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The worker index and the last bike', 'next' => 'wrong_b'],
                ['label' => 'The set of used bikes; the worker index is its popcount', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. You need to know every bike already taken.\nStep back to when you kept only the last bike.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Where is the answer?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Min dp[mask] over masks with n bits set', 'next' => 'success'],
                ['label' => 'dp[all bikes used]', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. With m > n, not every bike is used.\nStep back to when you took the full mask.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(2^m · m). The two examples give 6 and 4.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
