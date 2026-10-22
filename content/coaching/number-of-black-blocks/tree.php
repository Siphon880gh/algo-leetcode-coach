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
            'message' => "Read the problem statement above.\nWhich blocks to visit?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The up to 4 around each black cell', 'next' => 's2'],
                ['label' => 'Every 2 × 2 block', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. For m = n = 10^5 there are about 10^10 blocks.\nStep back to when you scanned every block.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "arr[0] equals?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '(m − 1)(n − 1)', 'next' => 'wrong_b'],
                ['label' => '(m − 1)(n − 1) − touched blocks', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Touched blocks are not empty; example 1 → [4, 1, 0, 0, 0] instead of [3, 1, 0, 0, 0].\nStep back to when you used the total.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(k). Examples → [3, 1, 0, 0, 0], [0, 2, 2, 0, 0].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
