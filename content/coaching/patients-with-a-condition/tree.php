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
            'message' => "Read the problem statement above.\nLIKE '%DIAB1%'?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: it matches inside codes', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. A code like XDIAB1 would match.\nStep back to when you used a bare wildcard.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Code not first in the list?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Ignore it', 'next' => 'wrong_b'],
                ['label' => 'Match \' DIAB1\' after a space', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. George has ACNE DIAB100.\nStep back to when you ignored later codes.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "DIAB201?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Not a match', 'next' => 'success'],
                ['label' => 'Match', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The prefix must be DIAB1.\nStep back to when you matched it.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Bob and George are returned.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
