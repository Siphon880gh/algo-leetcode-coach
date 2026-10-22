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
            'message' => "Read the problem statement above.\nApproach?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Reverse the removals into additions with union-find', 'next' => 's2'],
                ['label' => 'Recompute segments after each removal', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. n = 10^5 makes that about 10^10 steps.\nStep back to when you recomputed every time.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Record ans[i] when?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'After adding it', 'next' => 'wrong_b'],
                ['label' => 'Before adding removeQueries[i]', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 1 → [15,14,7,2,2] instead of [14,7,2,2,0].\nStep back to when you recorded after adding.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "best after an addition?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'max(best, sum of the new segment)', 'next' => 'success'],
                ['label' => 'Sum of the new segment', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. A bigger segment elsewhere still exists; Example 1 → [14,7,1,2,0].\nStep back to when you dropped the maximum.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n α(n)). Examples → [14,7,2,2,0], [16,5,3,0].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
