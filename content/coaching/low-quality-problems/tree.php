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
            'message' => "Problem: A problems table records each problem's id with its number of likes and dislikes. Report the ids of problems whose like percentage (likes divided by likes plus dislikes) is below the threshold the statement gives, in the order it asks for. For instance, with a sample threshold of 60%, a problem with 1290 likes and 425 dislikes (75%) is fine, while one with 2677 likes and 8659 dislikes (24%) is low-quality. (Restated from memory; table names and details may differ slightly.)\nUsing the column names the statement gives:\nLike percentage?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'likes / (likes + dislikes)', 'next' => 's2'],
                ['label' => 'likes / dislikes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. That is a likes-to-dislikes ratio; the percentage divides by all votes.\nStep back to when you divided by dislikes.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Compute the division how?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'With integer division', 'next' => 'wrong_b'],
                ['label' => 'In floating point, or by cross-multiplying', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Integer division turns every ratio into 0 or 1 in some engines.\nStep back to when you used integer division.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Constructed check with a sample threshold → 7, 10, 11, 13.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
