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
            'message' => "Read the problem statement above.\nWhere to start?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The first digit that grows', 'next' => 's2'],
                ['label' => 'The largest gain anywhere', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Earlier positions dominate later ones.\nStep back to when you chased the biggest gain.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Continue through change[d] == d?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No, stop', 'next' => 'wrong_b'],
                ['label' => 'Yes', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Equal digits cost nothing and later digits may still grow.\nStep back to when you stopped on equals.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Stop when?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'change[d] < d', 'next' => 'success'],
                ['label' => 'At the end of the string always', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Shrinking a digit lowers the number.\nStep back to when you kept going.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → \"832\", \"934\", \"5\".\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
