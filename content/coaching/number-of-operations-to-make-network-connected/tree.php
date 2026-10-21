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
            'message' => "Read the problem statement above.\nFewer than n − 1 cables?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Return −1', 'next' => 's2'],
                ['label' => 'Count components anyway', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. A connected network needs n − 1 cables.\nStep back to when you skipped the check.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Enough cables, answer?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Number of redundant cables', 'next' => 'wrong_b'],
                ['label' => 'components − 1', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Each move joins two components.\nStep back to when you counted redundant cables.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Isolated computer?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Its own component', 'next' => 'success'],
                ['label' => 'Ignore it', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. It still needs a cable.\nStep back to when you ignored it.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O((n + E) · α(n)). First example → 1. Second → 2. Third → −1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
