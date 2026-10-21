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
            'message' => "Read the problem statement above.\nCounts from which neighbours?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Only those tied for the best', 'next' => 's2'],
                ['label' => 'All reachable ones', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Only maximum-score paths count.\nStep back to when you added every count.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Obstacle X?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Score 0', 'next' => 'wrong_b'],
                ['label' => 'Unreachable: count 0', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Paths cannot pass through it.\nStep back to when you scored it 0.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "E unreachable?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Return [0, 0]', 'next' => 'success'],
                ['label' => 'Return [−1, 0]', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The statement asks for [0, 0].\nStep back to when you returned −1.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n²). [\"E23\",\"2X2\",\"12S\"] → [7,1]. [\"E12\",\"1X1\",\"21S\"] → [4,2]. [\"E11\",\"XXX\",\"11S\"] → [0,0].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
