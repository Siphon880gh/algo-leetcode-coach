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
            'message' => "Read the problem statement above.\nWhat to add per message?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Its word count, spaces + 1', 'next' => 's2'],
                ['label' => '1 per message', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. messages [a b c, d, e] from [X, Y, Y] → Y instead of X.\nStep back to when you counted messages.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "A tie?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The smallest name', 'next' => 'wrong_b'],
                ['label' => 'The lexicographically largest name', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 2 → Bob instead of Charlie.\nStep back to when you took the smallest.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Compare names how?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Plain string order, uppercase before lowercase', 'next' => 'success'],
                ['label' => 'Ignoring case', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. A tie between alice and Bob → Bob instead of alice.\nStep back to when you ignored case.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(total length). Examples → Alice, Charlie.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
