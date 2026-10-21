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
            'message' => "Read the problem statement above.\nStates?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Next added vs next subtracted', 'next' => 's2'],
                ['label' => 'Just the best sum so far', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. The next sign depends on the length so far.\nStep back to when you used one state.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Update order?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'One after the other in place', 'next' => 'wrong_b'],
                ['label' => 'Both from the old values at once', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Using a fresh value would take x twice.\nStep back to when you updated in place.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Return?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The state that last added', 'next' => 'success'],
                ['label' => 'The state that last subtracted', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Ending on a minus only lowers the sum.\nStep back to when you returned it.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → 7, 8, 10.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
