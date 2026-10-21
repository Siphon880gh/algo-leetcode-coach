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
                ['label' => 'Prefix sums as blocks on a number line', 'next' => 's2'],
                ['label' => 'Build an array with w[i] copies of each index', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Weights sum to 1e9; expanding w[i] copies of i is too big.\nStep back to when you expanded the weights.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Prefix [1,4] for [1,3]. Draw x.\nWhich range and search?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'x in [0, total], bisect_left', 'next' => 'wrong_b'],
                ['label' => 'x in [1, total], first prefix ≥ x (bisect_left)', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. x = 0 with bisect_left lands on index 0, giving it an extra chance.\nStep back to when you drew from 0.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Block i holds exactly w[i] integers. O(log n) per pick. Real-valued: x in [0, total) with bisect_right.\nLock it in?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Prefix sums, matching draw range, binary search', 'next' => 'success'],
                ['label' => 'Scan the prefix array linearly each pick', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. A linear scan per pick is O(n): 1e8 steps over all calls.\nStep back to when you scanned linearly.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Blocks on a number line, found by binary search. [1,3] → 3 to 1 odds.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
