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
            'message' => "Read the problem statement above.\nA mismatched pair?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Write the smaller letter into both', 'next' => 's2'],
                ['label' => 'Copy the left letter onto the right', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. The left letter may be larger; seven → seves instead of neven.\nStep back to when you copied the left side.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "The middle letter of an odd length?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Change it to a', 'next' => 'wrong_b'],
                ['label' => 'Leave it', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The count of changes must stay minimal; egcfe → efafe with 2 changes instead of efcfe with 1.\nStep back to when you changed the middle.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → efcfe, abba, neven.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
