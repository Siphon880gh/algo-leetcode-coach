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
            'message' => "Read the problem statement above.\nWhich numbers can never be good?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Those on both sides of the same card', 'next' => 's2'],
                ['label' => 'Those that appear twice anywhere', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Appearing on two different cards is fine; you can flip one.\nStep back to when you banned any repeat.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Why can any other number x be made good?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Only if x is on a back already', 'next' => 'wrong_b'],
                ['label' => 'Flip every card so x is not on its front, then pick a card with x on its back', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Flipping can move x to the back of whichever card shows it.\nStep back to when you required it on a back.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "No number qualifies. Return?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '0', 'next' => 'success'],
                ['label' => '-1', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The problem returns 0 in that case.\nStep back to when you returned -1.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). fronts [1,2,4,4,7], backs [1,3,4,1,3] → 2. fronts [1], backs [1] → 0.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
