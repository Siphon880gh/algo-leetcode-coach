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
            'message' => "Read the problem statement above.\nPop the top when?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Its value is strictly smaller', 'next' => 's2'],
                ['label' => 'Its value is smaller or equal', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Equal values survive; Example 2 → [1] instead of [1,1,1,1].\nStep back to when you popped equals.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Link the answer from?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Top to bottom', 'next' => 'wrong_b'],
                ['label' => 'Bottom to top of the stack', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. That reverses the list; Example 1 → [8,13] instead of [13,8].\nStep back to when you read from the top.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → [13,8], [1,1,1,1].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
