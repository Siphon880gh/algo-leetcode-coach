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
            'message' => "Read the problem statement above.\nRolling direction?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Right to left: hash · p + new first letter', 'next' => 's2'],
                ['label' => 'Left to right, dividing by p', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. m need not be prime, so p may have no inverse mod m.\nStep back to when you divided.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Which match?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The first one found', 'next' => 'wrong_b'],
                ['label' => 'The last one found, which is the leftmost', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Scanning right to left finds the rightmost match first.\nStep back to when you stopped at the first.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "After removing the old last letter?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Add m before taking mod', 'next' => 'success'],
                ['label' => 'Take mod directly', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The subtraction can go negative, and a negative remainder never equals hashValue.\nStep back to when you skipped the fix.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → ee, fbx.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
