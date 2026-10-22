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
            'message' => "Read the problem statement above.\nConsonant means?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'A letter that is not a vowel', 'next' => 's2'],
                ['label' => 'Any non-vowel', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Digits are not consonants: a3e → true instead of false.\nStep back to when you counted digits.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Allowed characters?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Anything', 'next' => 'wrong_b'],
                ['label' => 'Letters and digits only', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. ab\$ → true instead of false.\nStep back to when you allowed every character.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → true, false, false.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
