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
            'message' => "Read the problem statement above.\nBuild the table and sort it?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: binary search on the value instead', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. m · n can be 9 · 10⁸ entries.\nStep back to when you built the table.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "How many entries in row i are ≤ x?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'x // i', 'next' => 'wrong_b'],
                ['label' => 'min(x // i, n)', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. A row has only n entries, so cap the count at n.\nStep back to when you left it uncapped.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "count(mid) ≥ k. Then?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'hi = mid, keeping mid as a candidate', 'next' => 'success'],
                ['label' => 'Return mid', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. mid may not be in the table; keep narrowing to the smallest value that reaches k.\nStep back to when you returned early.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Binary search over [1, m · n] with an O(m) count: O(m log(m · n)). m = 3, n = 3, k = 5 → 3. m = 2, n = 3, k = 6 → 6.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
