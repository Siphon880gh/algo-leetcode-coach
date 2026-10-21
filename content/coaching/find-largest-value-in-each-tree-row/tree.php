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
                ['label' => 'BFS one level at a time, track the max', 'next' => 's2'],
                ['label' => 'Take the rightmost node of each level', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Following the rightmost node gives the right side view (199), not the largest value.\nStep back to when you took the rightmost node.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Starting value for mx?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '0', 'next' => 'wrong_b'],
                ['label' => 'Negative infinity, or the first node in the level', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Rows can be all negative. mx = 0 would report 0 for a row of [−5, −3].\nStep back to when you started at 0.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Pop size nodes per level, update mx, push children, append mx. DFS: if d == len(ans) append, else ans[d] = max(ans[d], v). O(n).\nLock it in?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Per-level max from −∞, and [] for an empty tree', 'next' => 'success'],
                ['label' => 'Assume the root exists', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. A null root has no rows. Returning [0] or crashing on it is wrong.\nStep back to when you skipped the empty case.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Per-level max with a safe start and an empty check. → [1,3,9].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
