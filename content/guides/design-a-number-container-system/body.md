## Clean up only when asked

1. `at` = map index → number; `h[x]` = min-heap of indices for number `x`.
2. `change(i, x)`: `at[i] = x`; push `i` onto `h[x]`.
3. `find(x)`: while `h[x]` is non-empty and `at[top] ≠ x`, pop; return the top, or −1.

Example → null, −1, null, null, null, null, 1, null, 2.

A replaced index stays in its old heap until a find reaches it, and each push is popped at most once, so the cost is amortised. A sorted set per number with real deletion works too.

Time: O(log n) amortised per call  
Space: O(number of calls)

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
