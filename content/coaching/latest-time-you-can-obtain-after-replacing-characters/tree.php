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
            'message' => "Read the problem statement above.\nFill ?? in the hour with?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '11', 'next' => 's2'],
                ['label' => '19', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Hours stop at 11: ??:?? → 19:59 instead of 11:59.\nStep back to when you filled 19.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "First hour digit is ? and the second is 5?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '1', 'next' => 'wrong_b'],
                ['label' => '0', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. 15 is not a valid hour: ?5:00 → 15:00 instead of 05:00.\nStep back to when you filled 1.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Or try all 720 times from 11:59 down. Examples → 11:54, 09:59.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
