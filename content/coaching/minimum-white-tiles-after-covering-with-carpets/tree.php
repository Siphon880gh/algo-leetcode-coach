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
            'message' => "Read the problem statement above.\nPlace carpets?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'DP: skip or start a carpet at each tile', 'next' => 's2'],
                ['label' => 'Greedy: cover the most white tiles each time', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. 000101111 with 2 carpets of length 3 → 1 greedily, but 0 is possible.\nStep back to when you chose greedily.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "After a carpet at i?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Continue at i + carpetLen − 1', 'next' => 'wrong_b'],
                ['label' => 'Continue at i + carpetLen', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The tile at i + carpetLen − 1 is already covered and could be counted again.\nStep back to when you jumped one short.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Uncovered tile cost?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '1 if it is white, else 0', 'next' => 'success'],
                ['label' => '1 for every tile', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Only white tiles count; Example 1 → 4 instead of 2, counting uncovered black tiles too.\nStep back to when you counted every tile.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n · numCarpets). Examples → 2, 0.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
