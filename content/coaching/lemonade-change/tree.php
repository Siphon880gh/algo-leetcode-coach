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
            'message' => "Read the problem statement above.\nTrack what?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The counts of $5 and $10 bills', 'next' => 's2'],
                ['label' => 'The total cash', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Holding \$20 in tens cannot change a \$10.\nStep back to when you tracked the total.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "A customer pays \$20. Prefer?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Three $5', 'next' => 'wrong_b'],
                ['label' => 'One $10 and one $5', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Fives can change both \$10 and \$20, so keep them.\nStep back to when you spent three fives.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Track the \$20 bills too?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: they are never given as change', 'next' => 'success'],
                ['label' => 'Yes', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Change is \$5 or \$15, which never uses a \$20.\nStep back to when you counted twenties.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n), O(1) space. [5,5,5,10,20] → true. [5,5,10,10,20] → false.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
