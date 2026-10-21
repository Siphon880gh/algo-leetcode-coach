## Overlap, then drop the earlier end

`i = j = 0`. While both lists have intervals:

1. `lo = max(A[i][0], B[j][0])`, `hi = min(A[i][1], B[j][1])`.
2. If `lo ≤ hi`, record `[lo, hi]`.
3. If `A[i][1] < B[j][1]`, `i += 1`; else `j += 1`.

Return the recorded list.

The interval that ends first cannot overlap anything later in the other list, so it is safe to drop.

Do not compare every pair; that is O(n · m). Do not use `<` in step 2; touching endpoints like `[5,5]` count.

Time: O(n + m)  
Space: O(1) besides the answer

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
