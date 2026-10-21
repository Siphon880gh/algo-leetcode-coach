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
            'message' => "Read the problem statement above.\nPair buys with sells explicitly?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: a signed sum suffices', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. The statement guarantees balanced pairs.\nStep back to when you paired them.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Buy rows count as?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '+price', 'next' => 'wrong_b'],
                ['label' => '−price', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Buying spends money.\nStep back to when you added it.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Losses?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Stay negative', 'next' => 'success'],
                ['label' => 'Use the absolute value', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Handbags must show −23000.\nStep back to when you took the absolute value.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Corona Masks → 9500. Leetcode → 8000. Handbags → −23000.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
