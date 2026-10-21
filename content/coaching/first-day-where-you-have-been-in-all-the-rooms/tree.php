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
            'message' => "Read the problem statement above.\nCan you skip past the first unvisited room?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No, nextVisit[i] ≤ i', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Moves go back or one step forward, so rooms are first reached in order.\nStep back to when you allowed skipping.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "First visit to room i − 1 (odd count). Next day?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Go forward to i', 'next' => 'wrong_b'],
                ['label' => 'Go back to nextVisit[i − 1]', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Odd counts send you to nextVisit; only the even visit moves forward.\nStep back to when you went forward.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "The subtraction under the modulus?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Add the modulus before reducing', 'next' => 'success'],
                ['label' => 'Reduce directly; a negative remainder is fine', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. In C++ or Java the remainder of a negative number is negative.\nStep back to when you reduced directly.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → 2, 6, 6.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
