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
            'message' => "Read the problem statement above.\nCompare s and target by?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Whether each contains a 1', 'next' => 's2'],
                ['label' => 'Their numbers of 1s', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. A 1 can spread; s = 10, target = 11 → false instead of true.\nStep back to when you compared counts.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "s has a 1 and target is all zeros?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'True: clear the 1s one by one', 'next' => 'wrong_b'],
                ['label' => 'False: the last 1 stays', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Clearing needs another 1; Example 2 → true instead of false.\nStep back to when you cleared the last 1.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → true, false.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
