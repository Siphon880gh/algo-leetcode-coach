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
            'message' => "State:\na = [1, 2, 2, 2, 5]\nneed the first index where a[i] >= 2\n\nWhat is the answer?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '1', 'next' => 'mid'],
                ['label' => '3, the last 2', 'next' => 'w1'],
            ],
        ],
        'w1' => [
            'message' => "Wrong.\n\nThe first value that is at least 2 is the leftmost 2, at index 1.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        'mid' => [
            'message' => "State:\nthe test answers look like F F T T T\nyou want the first T\n\nIf ok(mid) is true, how do you move?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Set hi = mid, because the answer is mid or somewhere left of it', 'next' => 'final'],
                ['label' => 'Set lo = mid, throwing away everything left of mid', 'next' => 'w2'],
            ],
        ],
        'w2' => [
            'message' => "Wrong.\n\nA true mid might be the very first true, so keep it in range with hi = mid.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'mid',
            'choices' => [],
        ],
        'final' => [
            'message' => "State:\nsame array a = [1, 2, 2, 2, 5]\nneed the last index where a[i] == 2\n\nWhich index is it?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '3', 'next' => 'success'],
                ['label' => '1, because the first and last are the same here', 'next' => 'w3'],
            ],
        ],
        'w3' => [
            'message' => "Wrong.\n\nThere are three 2s. The last one sits at index 3.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'final',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct.\n\n- A boundary search is not the same as finding any match.\n- Move lo and hi differently depending on whether you want the first or the last.\n\nYou finished this path.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
