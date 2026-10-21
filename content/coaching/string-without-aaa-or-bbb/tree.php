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
            'message' => "Read the problem statement above.\nAlternate a and b strictly?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: the counts can differ a lot', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. With a = 4, b = 1 you need \"aabaa\".\nStep back to when you alternated.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Which letter do you write by default?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The one with fewer copies left', 'next' => 'wrong_b'],
                ['label' => 'The one with more copies left', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The majority would pile up at the end.\nStep back to when you wrote the minority.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "The last two letters are \"aa\". Then?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Write b', 'next' => 'success'],
                ['label' => 'Write a', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. That makes \"aaa\".\nStep back to when you wrote a.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(a + b). a = 1, b = 2 → \"bab\" (any valid string is accepted). a = 4, b = 1 → \"aabaa\".\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
