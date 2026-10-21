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
            'message' => "Read the problem statement above.\nFirst drop floor with m drops?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Floor m', 'next' => 's2'],
                ['label' => 'Floor n / 2', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. If it breaks, the second egg needs up to n / 2 − 1 more drops.\nStep back to when you bisected.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Gap after a survival?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The same gap', 'next' => 'wrong_b'],
                ['label' => 'One smaller each time', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Each drop used shrinks the budget for the second egg.\nStep back to when you kept the gap.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "n = 100?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '14', 'next' => 'success'],
                ['label' => '10', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. 10 drops cover only 55 floors.\nStep back to when you chose 10.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(√n). Examples → 2, 14.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
