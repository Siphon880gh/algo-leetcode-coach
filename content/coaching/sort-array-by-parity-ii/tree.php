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
            'message' => "Read the problem statement above.\nAn even slot holds an odd value. Where is its partner?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'An odd slot that holds an even value', 'next' => 's2'],
                ['label' => 'Any later slot', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Swapping with another even slot would break that slot.\nStep back to when you used any slot.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Restart the odd pointer from 1 each time?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Yes', 'next' => 'wrong_b'],
                ['label' => 'No: it only moves forward', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. That is O(n²).\nStep back to when you restarted.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Why does a partner always exist?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Evens and even slots are equal in number', 'next' => 'success'],
                ['label' => 'It may not; return early', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Half the values are even and half the slots are even, so mistakes come in pairs.\nStep back to when you gave up.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n), O(1) space. [4,2,5,7] → [4,5,2,7]. [2,3] → [2,3].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
