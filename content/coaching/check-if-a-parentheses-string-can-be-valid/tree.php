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
            'message' => "Read the problem statement above.\nOdd length?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Always false', 'next' => 's2'],
                ['label' => 'Check it like the others', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. A valid string pairs every bracket, so its length is even.\nStep back to when you checked it.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Unlocked characters count as?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Their current character', 'next' => 'wrong_b'],
                ['label' => 'Whichever bracket the sweep needs', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 1, ))())), is true only because unlocked characters can change.\nStep back to when you fixed them.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Is a left-to-right sweep enough?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No, also sweep right to left', 'next' => 'success'],
                ['label' => 'Yes', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. (( with both locked passes the left sweep but can never close.\nStep back to when you stopped after one sweep.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n), O(1) extra. Examples → true, true, false, true.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
