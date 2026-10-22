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
            'message' => "Read the problem statement above.\nCheck a substring against?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Every other string', 'next' => 's2'],
                ['label' => 'Every string, itself included', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Each string contains its own substrings, so example 1 → all empty.\nStep back to when you included the string itself.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Within a length?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'First by position', 'next' => 'wrong_b'],
                ['label' => 'Lexicographically smallest', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 1 gives ca for cab instead of ab.\nStep back to when you took the first by position.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Strings are at most 20 long. Examples → [ab, “”, ba, “”], [“”, “”, abcd].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
