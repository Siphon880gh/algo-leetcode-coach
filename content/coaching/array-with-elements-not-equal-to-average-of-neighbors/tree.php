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
            'message' => "Read the problem statement above.\nSorted order as is?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No, neighbours average to the middle', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Equally spaced values like 1, 2, 3 fail.\nStep back to when you kept sorted order.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Interleave which halves?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Odd with even values', 'next' => 'wrong_b'],
                ['label' => 'Small half with large half', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Parity does not create peaks and valleys.\nStep back to when you split by parity.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Why it works?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Each element is a local peak or valley', 'next' => 'success'],
                ['label' => 'Values are distinct', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Distinctness alone is not enough.\nStep back to when you relied on it.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n). Any valid arrangement is accepted.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
