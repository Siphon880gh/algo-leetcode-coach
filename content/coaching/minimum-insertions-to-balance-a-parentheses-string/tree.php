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
            'message' => "Read the problem statement above.\nOdd need when a new ( arrives?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Insert one ) first', 'next' => 's2'],
                ['label' => 'Ignore it', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. The pending )) must be consecutive.\nStep back to when you ignored it.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "need < 0 on a )?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Insert ( and set need = 0', 'next' => 'wrong_b'],
                ['label' => 'Insert ( and set need = 1', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The new ( needs one more ).\nStep back to when you set 0.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "End of string?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Add the remaining need', 'next' => 'success'],
                ['label' => 'Ignore it', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Unclosed ( still need closers.\nStep back to when you ignored it.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). \"(()))\" → 1. \"())\" → 0. \"))())(\" → 3.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
