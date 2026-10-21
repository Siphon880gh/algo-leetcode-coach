## Moves are prefix choices

1. `p[i]` = sum of the first `i` stones.
2. `f = p[n]` (take everything).
3. For `i = n − 1` down to 2: `f = max(f, p[i] − f)`.
4. Return `f`.

`[-1,2,-3,4,-5]` → 5. `[7,-6,5,10,5,-2,-6]` → 13. `[-10,-12]` → −22.

The merged stone keeps the total of the removed prefix, so the row always looks like the original with a prefix collapsed. `f` stands for the best over all `j ≥ i`, so no inner loop is needed.

Time: O(n)  
Space: O(n), or O(1) with a running sum

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
