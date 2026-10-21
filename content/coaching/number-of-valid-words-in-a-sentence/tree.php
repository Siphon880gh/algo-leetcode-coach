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
            'message' => "Read the problem statement above.\nA token with a digit?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Invalid', 'next' => 's2'],
                ['label' => 'Valid if the rest is letters', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Valid words contain no digits; b8d! is invalid.\nStep back to when you allowed digits.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Hyphen rule?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'At most one, anywhere', 'next' => 'wrong_b'],
                ['label' => 'At most one, with letters on both sides', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. -ab and ab- are invalid.\nStep back to when you allowed an edge hyphen.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Punctuation rule?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'At most one, only at the end', 'next' => 'success'],
                ['label' => 'At most one, anywhere', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. a!b is invalid.\nStep back to when you allowed it in the middle.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → 3, 0, 5.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
