## Candidates for i, then for j

1. Build a stack of indices with strictly decreasing values: push `i` if the stack is empty or `nums[i] < nums[stack top]`.
2. For `j` from `n − 1` down to 0: while the stack is non-empty and `nums[stack top] ≤ nums[j]`, set `best = max(best, j − top)` and pop.

Return `best`.

A start that is not a prefix minimum is beaten by an earlier, smaller start. Popping is safe because later (smaller) `j` values would only give that start a narrower ramp.

Sorting indices by value and tracking the smallest index seen so far also works in O(n log n).

Do not check all pairs; that is O(n²). Do not scan `j` from the left; the widest ramps come from the right end first.

Time: O(n)  
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
