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
            'message' => "Read the problem statement above.\nApproach?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'A stack of kept letters', 'next' => 's2'],
                ['label' => 'Rebuild the string after each star', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Length 10^5 makes that about 10^10 steps.\nStep back to when you rebuilt the string.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Read the answer how?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Popping from the top', 'next' => 'wrong_b'],
                ['label' => 'Bottom to top', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. That reverses it; Example 1 → eocel instead of lecoe.\nStep back to when you popped the answer out.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "A star removes?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The closest letter to its left', 'next' => 'success'],
                ['label' => 'The closest letter to its right', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Example 1 → leetd instead of lecoe.\nStep back to when you looked right.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → lecoe, (empty string).\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
