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
            'message' => "Read the problem statement above.\nn % groupSize != 0. Then?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Return false immediately', 'next' => 's2'],
                ['label' => 'Keep checking', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. The cards cannot split into equal groups.\nStep back to when you kept checking.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Which card must start a group?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Any card', 'next' => 'wrong_b'],
                ['label' => 'The smallest remaining card', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Nothing smaller is left to come before the smallest card, so it must start a group.\nStep back to when you picked any card.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "The smallest card x has count c. Then?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Take c from each of x, …, x + groupSize − 1; fail if any is short', 'next' => 'success'],
                ['label' => 'Take c copies of x only', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Each of the c groups starting at x needs all of x … x + groupSize − 1.\nStep back to when you took only x.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n). [1,2,3,6,2,3,4,7,8], groupSize 3 → true. [1,2,3,4,5], groupSize 4 → false.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
