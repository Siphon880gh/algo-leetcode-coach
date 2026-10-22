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
            'message' => "Read the problem statement above.\nOrder of edges?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'By max(vals[a], vals[b]), smallest first', 'next' => 's2'],
                ['label' => 'As given', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. A large node can join first and block the pair; vals = [2,2,3], edges = [[2,1],[1,0]] → 3 instead of 4.\nStep back to when you used the input order.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Merging two parts with the same maximum?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Add countA + countB', 'next' => 'wrong_b'],
                ['label' => 'Add countA · countB', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Each pair of ends is one path; Example 1 → 7 instead of 6.\nStep back to when you added counts.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Answer starts at?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'n', 'next' => 'success'],
                ['label' => '0', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Single nodes count; Example 3 → 0 instead of 1.\nStep back to when you started at 0.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n). Examples → 6, 7, 1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
