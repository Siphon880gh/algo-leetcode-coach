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
            'message' => "Read the problem statement above.\nSame timestamp?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'OFFLINE before MESSAGE', 'next' => 's2'],
                ['label' => 'MESSAGE before OFFLINE', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. [MESSAGE 10 HERE, OFFLINE 10 0] → [1, 1] instead of [0, 1].\nStep back to when you put messages first.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Online at time t?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'back[u] < t', 'next' => 'wrong_b'],
                ['label' => 'back[u] ≤ t', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 1 → [1, 2] instead of [2, 2].\nStep back to when you used <.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(e log e + e · users). Examples → [2, 2], [2, 2], [0, 1].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
