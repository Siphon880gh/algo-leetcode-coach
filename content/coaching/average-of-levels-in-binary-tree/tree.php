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
            'message' => "Read the problem statement above.\nHow do you separate the levels in BFS?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Record the queue size at the start of each level and pop that many', 'next' => 's2'],
                ['label' => 'Use a visited set', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. A tree has no cycles, and a visited set does not tell you where a level ends.\nStep back to when you used visited.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "What type is the running sum?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '32-bit int', 'next' => 'wrong_b'],
                ['label' => '64-bit integer or float', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Values go up to 2³¹ − 1, so a wide level overflows 32 bits.\nStep back to when you used 32 bits.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "A DFS alternative?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Keep sum[depth] and count[depth], then divide at the end', 'next' => 'success'],
                ['label' => 'Average each node with its parent', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. That mixes levels; the average must be over all nodes at one depth.\nStep back to when you mixed levels.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. BFS level snapshots or per-depth totals: O(n) time. [3,9,20,null,null,15,7] → [3.0, 14.5, 11.0].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
