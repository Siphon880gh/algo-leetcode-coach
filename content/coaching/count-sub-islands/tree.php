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
            'message' => "Read the problem statement above.\nHit water in grid1 mid-flood?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Mark it failed, keep flooding', 'next' => 's2'],
                ['label' => 'Stop the flood', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. The rest of the island would be counted later.\nStep back to when you stopped early.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Flood method on 500 × 500?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Plain recursion', 'next' => 'wrong_b'],
                ['label' => 'Iterative stack or queue', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Deep islands overflow the call stack.\nStep back to when you recursed.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Count when?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'After the flood, if no failure', 'next' => 'success'],
                ['label' => 'At every land cell', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Count islands, not cells.\nStep back to when you counted cells.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(m · n). Examples → 3, 2.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
