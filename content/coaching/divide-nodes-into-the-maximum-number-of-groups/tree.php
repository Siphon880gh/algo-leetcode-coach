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
            'message' => "Read the problem statement above.\nAn edge joins two nodes on the same BFS level?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Return −1', 'next' => 's2'],
                ['label' => 'Ignore it', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. That edge lies on an odd cycle, which no grouping allows; Example 2 → 2 instead of −1.\nStep back to when you ignored it.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "BFS from which nodes?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'One node per component', 'next' => 'wrong_b'],
                ['label' => 'Every node, keeping each component’s best', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The start decides how many levels appear; Example 1 from node 1 alone → 3 instead of 4.\nStep back to when you used one start.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n · (n + m)). Examples → 4, −1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
