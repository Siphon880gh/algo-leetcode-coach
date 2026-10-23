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
            'message' => "Read the problem statement above.\nTie on count?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Earlier first occurrence first', 'next' => 's2'],
                ['label' => 'Alphabetical', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Constructed check (run in code): \"uo\" → \"ou\" instead of \"uo\".\nStep back to when you broke ties alphabetically.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Count order?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Increasing', 'next' => 'wrong_b'],
                ['label' => 'Non-increasing', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 1 → \"loetcede\" instead of \"leetcedo\".\nStep back to when you put rare vowels first.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → \"leetcedo\", \"aaaaoooiie\", \"baeiou\".\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
