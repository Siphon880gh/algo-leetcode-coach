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
            'message' => "Read the problem statement above.\nCount transfers how?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Simulate 5 liters at a time', 'next' => 's2'],
                ['label' => 'Up front as min(extra, main / 5)', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Injected fuel can trigger more transfers; main = 24, extra = 10 → 280 instead of 290.\nStep back to when you counted up front.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Transfer when the extra tank is empty?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Yes, every 5 liters', 'next' => 'wrong_b'],
                ['label' => 'No', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Fuel cannot come from nowhere; main = 10, extra = 1 → 120 instead of 110.\nStep back to when you always transferred.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(main). Examples → 60, 10.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
