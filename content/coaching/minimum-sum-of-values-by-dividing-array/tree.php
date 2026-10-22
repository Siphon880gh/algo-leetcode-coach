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
            'message' => "Read the problem statement above.\nA part’s value is?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Its last element, added when it closes', 'next' => 's2'],
                ['label' => 'Its first element', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 1 → 9 instead of 12.\nStep back to when you used the first element.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "All parts closed but elements remain?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Fine, return 0', 'next' => 'wrong_b'],
                ['label' => 'Invalid', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. nums = [2, 3], andValues = [2] → 2 instead of 3.\nStep back to when you ignored the leftover elements.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Few AND values per (index, part). Examples → 12, 17, −1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
