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
            'message' => "Read the problem statement above.\nXOR what?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Values on their second sighting', 'next' => 's2'],
                ['label' => 'Every element', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Pairs cancel: example 3 → 0 instead of 3.\nStep back to when you XORed everything.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "No duplicates?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Return −1', 'next' => 'wrong_b'],
                ['label' => 'Return 0', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The statement asks for 0: example 2 → −1 instead of 0.\nStep back to when you returned −1.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → 1, 0, 3.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
