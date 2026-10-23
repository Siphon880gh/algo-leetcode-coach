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
            'message' => "Read the problem statement above.\nCheck what?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'How often the middle value appears', 'next' => 's2'],
                ['label' => 'Only its two neighbours', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Constructed check (run in code): [3, 1, 3, 5, 3] → true instead of false.\nStep back to when you checked only the neighbours.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Other values repeated?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Must be distinct too', 'next' => 'wrong_b'],
                ['label' => 'Irrelevant', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Constructed check (run in code): [1, 1, 2, 3, 3] → false instead of true.\nStep back to when you required every value distinct.",
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
