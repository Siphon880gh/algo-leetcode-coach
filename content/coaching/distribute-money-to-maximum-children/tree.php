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
            'message' => "Read the problem statement above.\nAll children have 8 and money is left?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'One fewer 8', 'next' => 's2'],
                ['label' => 'Keep all of them', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. All money must be given out; money = 17, children = 2 → 2 instead of 1.\nStep back to when you kept every 8.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "One child left and exactly 3 more dollars?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Give that child 4', 'next' => 'wrong_b'],
                ['label' => 'One fewer 8', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Nobody may receive 4; money = 12, children = 2 → 1 instead of 0.\nStep back to when you gave 4.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(1). Examples → 1, 2.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
