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
            'message' => "Problem: Problem: Given a grid of candies (0 is empty), crush every horizontal or vertical run of three or more equal candies simultaneously, let candies fall into the gaps, and repeat until stable. Return the final board. (Restated from memory; limits and examples may differ slightly.)\nCrush a run the moment you find it?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: mark all runs first, then crush together', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Early crushing can break a crossing run in the other direction.\nStep back to when you crushed immediately.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "How do you drop candies in a column?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Swap a candy down one cell at a time', 'next' => 'wrong_b'],
                ['label' => 'A write pointer from the bottom copies non-zero values down, then zeros fill the top', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. That works but needs repeated passes; one write-pointer pass suffices.\nStep back to when you swapped cell by cell.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "When do you stop?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'When a round marks nothing', 'next' => 'success'],
                ['label' => 'After one round', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Falling candies can form new runs.\nStep back to when you stopped after one round.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Repeat mark, crush, drop until stable: O((m · n)²) worst case. A board with no runs is returned unchanged.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
