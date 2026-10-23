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
            'message' => "Read the problem statement above.\nReverse which part?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The first k characters', 'next' => 's2'],
                ['label' => 'The last k characters', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 1 → \"abdc\" instead of \"bacd\".\nStep back to when you took the end.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "And the rest?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Reverse the whole string', 'next' => 'wrong_b'],
                ['label' => 'Append it unchanged', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 1 → \"dcba\" instead of \"bacd\".\nStep back to when you reversed everything.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → \"bacd\", \"zyx\", \"hey\".\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
