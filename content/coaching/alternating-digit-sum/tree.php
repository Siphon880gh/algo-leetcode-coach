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
            'message' => "Read the problem statement above.\nWhich digit gets the first + sign?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The most significant', 'next' => 's2'],
                ['label' => 'The least significant', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. With an even digit count the signs flip; n = 12 → 1 instead of −1.\nStep back to when you started from the right.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Sign of the next digit?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '+ for odd digits, − for even digits', 'next' => 'wrong_b'],
                ['label' => 'Opposite of the previous one', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Signs depend on position, not value; Example 2 → 3 instead of 1.\nStep back to when you used the digit’s value.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(digits). Examples → 4, 1, 0.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
