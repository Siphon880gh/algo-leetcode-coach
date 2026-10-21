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
            'message' => "Problem: 1 to 500 words, each 1 to 500 lowercase letters. It is a word square when row k and column k read the same string for every k. Rows can be jagged. [\"abcd\",\"bnrt\",\"crmy\",\"dtye\"] → true. [\"abcd\",\"bnrt\",\"crm\",\"dt\"] → true. [\"ball\",\"area\",\"read\",\"lady\"] → false (row 2 is read, column 2 is lead). (Restated from memory; limits and examples may differ slightly.)\nWhat do you try first?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Check every cell: words[i][j] must equal words[j][i]', 'next' => 's2'],
                ['label' => 'Sort the words first, then compare rows with columns', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Row order is part of the square. Sorting moves rows, so column k no longer lines up with row k. [\"ball\",\"area\",\"read\",\"lady\"] sorted is a different grid.\nStep back to when you sorted the words.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Walk every i and every j < len(words[i]).\nWhat must you check before reading words[j][i]?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Nothing; assume every row is as long as the number of rows', 'next' => 'wrong_b'],
                ['label' => 'j < number of rows, and i < len(words[j]). If either fails, return false', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Reading without bounds checks crashes, or silently passes a jagged grid that is not a square. A missing mirror cell means false.\nStep back to when you skipped the bounds checks.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Every character is checked once against its mirror. O(total letters) time, O(1) extra space. Word Squares (425) builds squares from a dictionary instead of checking one.\nLock it in?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Mirror check every cell with bounds. Missing cell is false. Not 425', 'next' => 'success'],
                ['label' => 'Only compare the first row with the first column, and the last with the last', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Comparing only the first and last rows misses the middle. [\"ball\",\"area\",\"read\",\"lady\"] fails only at row 2.\nStep back to when you checked a subset of rows.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Mirror every cell, a missing mirror is false, jagged rows are fine. [\"ball\",\"area\",\"read\",\"lady\"] → false.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
