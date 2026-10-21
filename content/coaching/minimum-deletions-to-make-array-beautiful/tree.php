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
            'message' => "Read the problem statement above.\nWhich positions pair up?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Positions in the kept array', 'next' => 's2'],
                ['label' => 'Original even indices', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. After a deletion everything shifts left, so original indices no longer show the pairs.\nStep back to when you used original indices.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Kept length ends odd?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Leave it', 'next' => 'wrong_b'],
                ['label' => 'Delete one more', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. A beautiful array has even length; [1,2,3] → 1.\nStep back to when you left it odd.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "[1,1]?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Delete both: → 2', 'next' => 'success'],
                ['label' => 'Must keep something: → 1', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. An empty array is beautiful, and [1] is odd.\nStep back to when you kept an element.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → 1, 2.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
