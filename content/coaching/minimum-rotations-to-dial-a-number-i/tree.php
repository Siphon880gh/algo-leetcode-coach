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
            'message' => "Read the problem statement above.\nPointer on 1, next digit 9. How many rotations?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '8, counting up', 'next' => 'wrong_a'],
                ['label' => '2, going down through 0', 'next' => 's2'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. 1 to 0 to 9 is 2 steps. Turning one way only gives 45 instead of 25 for Example 1.\nStep back to when you only turned up.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Where does the pointer start?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'On 0', 'next' => 'success'],
                ['label' => 'On the first digit of s', 'next' => 'wrong_b'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The pointer starts on 0, so the first digit can cost rotations too. In Example 2 the first move, 0 to 1, costs 1.\nStep back to when you started on s[0].",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Sum of min(d, 10 − d). O(n). Examples give 25 and 12.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
