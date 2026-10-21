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
            'message' => "Read the problem statement above.\nModel each pair as?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'A directed edge start → end', 'next' => 's2'],
                ['label' => 'A vertex to visit once', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. That becomes a Hamiltonian path, which is far harder; here each pair is an edge used once.\nStep back to when you made pairs vertices.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Where to start?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Always pairs[0][0]', 'next' => 'wrong_b'],
                ['label' => 'The vertex with out − in = 1, else anywhere', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 1 must start at 11, but pairs[0] starts at 5.\nStep back to when you started at pairs[0].",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Walk how?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Hierholzer: back out when stuck and splice', 'next' => 'success'],
                ['label' => 'Follow any unused edge until stuck', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. In Example 3, starting 1 → 3 gets stuck with 1 → 2 and 2 → 1 unused.\nStep back to when you walked greedily.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(V + E). Examples checked to use every pair once.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
