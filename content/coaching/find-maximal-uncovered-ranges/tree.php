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
            'message' => "Problem: You get the length n of an array of cells and a list of ranges, each covering a contiguous block of cells with both ends included; ranges may overlap. Return the maximal blocks of cells that no range covers, as [start, end] pairs sorted by start, so two uncovered blocks are never adjacent. The limits are in the official statement; the method below does not depend on n. For instance, n = 8 with ranges [1,2], [2,3] and [6,6] → [[0,0],[4,5],[7,7]], and n = 4 with the single range [0,3] → []. (Restated from memory; limits and examples may differ slightly.)\nProcess ranges in which order?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'By start', 'next' => 's2'],
                ['label' => 'By end', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. A later-ending range can start earlier; n = 10 with [4,5] and [0,9] → [[0,3]] instead of [].\nStep back to when you sorted by end.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Update the covered end?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'last = r', 'next' => 'wrong_b'],
                ['label' => 'last = max(last, r)', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. A range nested inside an earlier one shrinks it; n = 8 with [0,5] and [1,2] → [[3,7]] instead of [[6,7]].\nStep back to when you dropped max.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(m log m). Constructed checks → [[0,0],[4,5],[7,7]], [].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
