## Bucket by anti-diagonal

1. For each `(i, j)` with a value: append to `groups[i + j]`.
2. Output groups in increasing key order, each reversed (bottom-left to top-right).

`[[1,2,3],[4,5,6],[7,8,9]]` → `[1,4,2,7,5,3,8,6,9]`. The ragged example → `[1,6,2,8,7,3,9,4,12,10,5,13,11,14,15,16]`.

Do not loop over `max_row_length × rows`; ragged rows make that wasteful. A BFS from `(0, 0)` that moves down only from column 0 also yields this order.

Time: O(total values)  
Space: O(total values)

> [!ui-builder] Mini game
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a mini-game in this Algo Learning IDE app that teaches [INPUT_TOPIC]. Place it under content/games/[INPUT_SLUG]/. Follow meta.php + index.html. Use .agents/skills/game-development-sickn33 for web/2d craft if needed.

> [!ui-builder] Step-by-step
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a step-by-step session for [INPUT_TOPIC] under content/coaching/[INPUT_SLUG]/. Include branching choices with clear labels, at least one wrong-path leaf with rewind_to, and a success leaf. Follow the tree.php contract so Step back and the Path visualizer work.
