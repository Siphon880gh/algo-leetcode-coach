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
            'message' => "Read the problem statement above.\nWhich ends make a move?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'A 1 and a −1', 'next' => 's2'],
                ['label' => 'Any two non-zero positions', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. The army must end on an empty spot; [1,0,0,1] → 2 instead of 0.\nStep back to when you paired any two forts.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Remember which position?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Only the last 1', 'next' => 'wrong_b'],
                ['label' => 'The last non-zero of either sign', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The army can move leftward too; [−1,0,0,1] → 0 instead of 2.\nStep back to when you tracked only 1s.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → 4, 0.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
