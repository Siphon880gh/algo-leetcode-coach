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
            'message' => "Read the problem statement above.\nHow many rotations to try?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Every k from 0 to n − 1', 'next' => 's2'],
                ['label' => 'None, just buy everything', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Rotating lets cheap chocolates stand in for dear ones; example 1 → 36 instead of 13.\nStep back to when you skipped rotations.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "With k rotations, each type costs?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Its price after all k rotations', 'next' => 'wrong_b'],
                ['label' => 'The minimum of the k + 1 prices it passed through', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. You may buy at any moment along the way; example 1 → 36 instead of 13.\nStep back to when you used only the final prices.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n²). Examples → 13, 6.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
