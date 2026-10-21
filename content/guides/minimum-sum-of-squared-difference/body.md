## Lower the top level

1. `d[i] = |nums1[i] − nums2[i]|`, `k = k1 + k2`. If `Σ d ≤ k`, return 0.
2. Binary search the smallest level `t` with `Σ max(0, d[i] − t) ≤ k`.
3. Cap every gap at `t`; spend the remaining budget lowering gaps equal to `t` by 1 each.
4. Return `Σ d[i]²`.

Examples → 579, 43. Checked against lowering the largest gap one step at a time on 400 random cases.

A change to either array moves a gap by 1, so the two budgets merge. Lowering the largest gap always saves the most, which levels the top. Squares reach 10^10 each, so sum in 64-bit.

Time: O(n log(max d))  
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
