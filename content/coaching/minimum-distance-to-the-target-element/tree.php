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
            'message' => "Read the problem statement above.\nStop at the first match from the left?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No, check all matches', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. A later match can be closer to start.\nStep back to when you stopped early.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Distance?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'i − start', 'next' => 'wrong_b'],
                ['label' => 'abs(i − start)', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Matches left of start give negatives.\nStep back to when you dropped abs.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Return what?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The distance', 'next' => 'success'],
                ['label' => 'The index', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The statement asks for abs(i − start).\nStep back to when you returned i.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → 1, 0, 0.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
