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
            'message' => "Read the problem statement above.\nGreedy: load as much as possible?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: it can cost extra trips', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Splitting earlier can save port visits.\nStep back to when you went greedy.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Trip cost for boxes j … i − 1?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Number of boxes', 'next' => 'wrong_b'],
                ['label' => '2 + port changes inside', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Consecutive boxes for one port share a stop.\nStep back to when you counted boxes.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Window validity?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Box count ≤ maxBoxes and weight ≤ maxWeight', 'next' => 'success'],
                ['label' => 'Box count only', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The weight limit applies too.\nStep back to when you ignored weight.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → 4, 6, 6.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
