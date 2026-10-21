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
            'message' => "Problem: Two roads meet at an intersection where only one road is green at a time. Cars arrive on separate threads; for each you get its road and callbacks to switch the light to that road and to let the car cross. Ensure no car crosses on red and the light switches only when needed. (Restated from memory; limits and examples may differ slightly.)\nSwitch on every arrival?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: only when the road differs', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Needless switches are not allowed.\nStep back to when you always switched.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Release the lock after switching?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Yes', 'next' => 'wrong_b'],
                ['label' => 'No: after crossing', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Another thread could flip the light before the car crosses.\nStep back to when you released early.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "State to keep?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The green road', 'next' => 'success'],
                ['label' => 'A queue of cars', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The lock already orders arrivals.\nStep back to when you built a queue.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(1) per car. For instance, road 1, road 2, road 1 → two switches.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
