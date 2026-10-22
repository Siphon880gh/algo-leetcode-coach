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
            'message' => "Read the problem statement above.\nAlice wins when?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'There is a vowel', 'next' => 's2'],
                ['label' => 'The vowel count is odd', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 1 has 4 vowels → false instead of true.\nStep back to when you required odd.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Even count: Alice’s first move?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Take the whole string', 'next' => 'wrong_b'],
                ['label' => 'Leave exactly one vowel', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The whole string has an even count, which Alice cannot remove.\nStep back to when you took everything.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → true, false.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
