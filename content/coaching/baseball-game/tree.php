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
            'message' => "Read the problem statement above.\nIs a running total enough?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: C needs the earlier scores back', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. After a C, a later + must see the scores before the canceled one.\nStep back to when you kept only a total.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "\"+\" arrives. Then?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Replace the top two with their sum', 'next' => 'wrong_b'],
                ['label' => 'Push stack[−1] + stack[−2]', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Both earlier scores stay valid; the sum is a new score.\nStep back to when you replaced them.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "How do you recognize a number?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Anything other than "+", "D", or "C", parsed as an int', 'next' => 'success'],
                ['label' => 'isdigit()', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Negative scores like \"-2\" fail isdigit.\nStep back to when you used isdigit.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. One pass with a stack: O(n). [\"5\",\"2\",\"C\",\"D\",\"+\"] → 30. [\"5\",\"-2\",\"4\",\"C\",\"D\",\"9\",\"+\",\"+\"] → 27.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
