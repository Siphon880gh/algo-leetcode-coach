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
            'message' => "Read the problem statement above.\nList exhausted during a match?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'True', 'next' => 's2'],
                ['label' => 'False', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. All list nodes matched.\nStep back to when you returned false.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Match failed at some depth?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Continue matching from that node', 'next' => 'wrong_b'],
                ['label' => 'Try new starts from isSub', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. A partial match cannot be resumed midway.\nStep back to when you continued.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Allowed moves?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Down to a child', 'next' => 'success'],
                ['label' => 'Up or sideways too', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Paths go downward only.\nStep back to when you moved up.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n · m). [4,2,8] → true. [1,4,2,6] → true. [1,4,2,6,8] → false.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
