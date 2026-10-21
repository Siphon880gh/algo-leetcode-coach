## Masks and submasks

1. `pre[i]` = mask of prerequisites of course i.
2. `f(mask)`: available `A` = untaken `i` with `pre[i] ⊆ mask`.
3. If `|A| ≤ k`: `1 + f(mask | A)`. Else min over submasks `s ⊆ A` with `|s| = k` of `1 + f(mask | s)`.

n = 4, `[[2,1],[3,1],[1,4]]`, k = 2 → 3. n = 5, `[[2,1],[3,1],[4,1],[1,5]]`, k = 2 → 4.

Do not use greedy topological layers (for example by out-degree or depth); counterexamples exist. Enumerate submasks with `s = (s − 1) & A`.

Time: O(3^n) worst case  
Space: O(2^n)

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
