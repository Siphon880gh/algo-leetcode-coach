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
            'message' => "Read the problem statement above.\nWeight each colour split?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'C(count, x)', 'next' => 's2'],
                ['label' => 'Weight 1', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Balls are shuffled individually.\nStep back to when you weighted 1.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Valid end state?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Equal distinct counts only', 'next' => 'wrong_b'],
                ['label' => 'Half the balls each and equal distinct counts', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Each box gets exactly n balls.\nStep back to when you ignored sizes.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Denominator?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'C(total, total/2)', 'next' => 'success'],
                ['label' => 'total!', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. That mixes in arrangement order.\nStep back to when you used factorial.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. [1,1] → 1.0. [2,1,1] → 0.66667. [1,2,1,2] → 0.6.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
