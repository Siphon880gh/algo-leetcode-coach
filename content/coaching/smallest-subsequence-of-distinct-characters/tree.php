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
            'message' => "Read the problem statement above.\nThe letter is already in the stack. Then?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Skip it', 'next' => 's2'],
                ['label' => 'Push it again', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Each letter appears exactly once.\nStep back to when you pushed it again.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "When may you pop the top?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'It is larger', 'next' => 'wrong_b'],
                ['label' => 'It is larger and occurs again later', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. A letter with no later copy would be lost.\nStep back to when you ignored later copies.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "How do you know a letter occurs later?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Precompute its last index', 'next' => 'success'],
                ['label' => 'Search the rest of the string each time', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. That makes it O(n²).\nStep back to when you searched.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). \"bcabc\" → \"abc\". \"cbacdcbc\" → \"acdb\".\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
