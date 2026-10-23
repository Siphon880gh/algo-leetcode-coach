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
            'message' => "Read the problem statement above.\nMixed parities: all odd possible when?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'min(odd) < min(even)', 'next' => 's2'],
                ['label' => 'Whenever an odd value exists', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 2 → true instead of false.\nStep back to when you reused version I.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Only one parity present?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Still compare the minimums', 'next' => 'wrong_b'],
                ['label' => 'True', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 3 → false instead of true.\nStep back to when you compared with no odd value.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → true, false, true.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
