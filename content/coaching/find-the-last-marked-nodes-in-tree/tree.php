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
            'message' => "Problem: In a tree, marking spreads each second from marked nodes to all their unmarked neighbours. For each node i, if only i is marked at time 0, return a node that is marked last. Limits are in the official statement. (Restated from memory; limits and examples may differ slightly.)\nLast marked from i?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The farthest node from i', 'next' => 's2'],
                ['label' => 'The farthest node from node 0', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. On the guide’s tree start 4 gets 4, itself.\nStep back to when you used node 0.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Farthest from i is?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Always the second endpoint b', 'next' => 'wrong_b'],
                ['label' => 'Whichever diameter endpoint is farther', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. On the guide’s tree start 0 gets 0, itself.\nStep back to when you always used b.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). The guide’s check → [4, 4, 4, 0, 0].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
