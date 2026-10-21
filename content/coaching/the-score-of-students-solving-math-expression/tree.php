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
            'message' => "Read the problem statement above.\nCorrect value?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Multiplication first, then addition', 'next' => 's2'],
                ['label' => 'Left to right', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. 7+3*1*2 is 13, not 20.\nStep back to when you evaluated left to right.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Results above 1000 in the interval sets?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Keep everything', 'next' => 'wrong_b'],
                ['label' => 'Drop them', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Answers are at most 1000 and values never shrink, so larger results are dead weight that can blow up the sets.\nStep back to when you kept them.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "An answer equal to the correct value?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '5 points only', 'next' => 'success'],
                ['label' => '5 + 2 = 7 points', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The 2-point rule applies only when the answer is not correct.\nStep back to when you added both.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Examples → 7, 19, 10.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
