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
            'message' => "Read the problem statement above.\nArrows to win section k?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'aliceArrows[k] + 1', 'next' => 's2'],
                ['label' => 'aliceArrows[k]', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. A tie goes to Alice, so Bob needs one more.\nStep back to when you matched Alice.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Which sections?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Take the highest affordable sections first', 'next' => 'wrong_b'],
                ['label' => 'Try every subset of the 12', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. numArrows = 9, aliceArrows = [0,0,1,0,0,1,1,1,3,0,1,1] → 38 greedily, but 44 is possible.\nStep back to when you chose greedily.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Arrows left over?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Put them on any section, e.g. 0', 'next' => 'success'],
                ['label' => 'Leave them unused', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Bob’s array must sum to numArrows.\nStep back to when you left arrows out.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(2^12 · 12). Examples → scores 47, 27.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
