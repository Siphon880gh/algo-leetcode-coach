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
            'message' => "Read the problem statement above.\nWalk stops at a stamped node. A cycle when?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Only if stamped during this walk', 'next' => 's2'],
                ['label' => 'Always', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. edges = [1,2,−1,0,3] → 4 instead of −1.\nStep back to when you counted every stamped node.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Cycle length?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Nodes visited in this walk', 'next' => 'wrong_b'],
                ['label' => 'Clock now minus the node’s stamp', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The tail before the cycle is counted; Example 1 → 4 instead of 3.\nStep back to when you counted the whole walk.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "No cycle found?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Return −1', 'next' => 'success'],
                ['label' => 'Return 0', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Example 2 → 0 instead of −1.\nStep back to when you returned 0.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → 3, −1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
