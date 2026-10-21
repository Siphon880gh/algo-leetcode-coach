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
            'message' => "Read the problem statement above.\nUse a hash map?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: the array is sorted', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Equal values are contiguous already.\nStep back to when you counted with a map.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Compare arr[i] with?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'arr[i + 1]', 'next' => 'wrong_b'],
                ['label' => 'arr[i + n / 4]', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. That only finds a duplicate.\nStep back to when you compared neighbours.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Return?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The first match', 'next' => 'success'],
                ['label' => 'The last match', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Exactly one value qualifies; return it at once.\nStep back to when you kept scanning.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). [1,2,2,6,6,6,6,7,10] → 6. [1,1] → 1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
