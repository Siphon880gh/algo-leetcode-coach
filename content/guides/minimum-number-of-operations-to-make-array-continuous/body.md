## Maximise what stays

1. `u` = sorted distinct values, `n` = original length.
2. Two pointers: for each `i`, advance `j` while `u[j] ≤ u[i] + n − 1`; `best = max(best, j − i)`.
3. Return `n − best`.

Examples → 0, 1, 3. Checked against trying every target range on random arrays.

Duplicates must change anyway, which is why only distinct values can stay. The optimal range can be assumed to start at a kept value, so starting windows at each `u[i]` is enough. The window width uses the original `n`, not the distinct count.

Time: O(n log n)  
Space: O(n)

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
