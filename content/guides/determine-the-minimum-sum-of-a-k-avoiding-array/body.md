## Greedy

1. `s = {}`; i = 1.
2. While `|s| < n`: if `k − i ∉ s`, add i; `i += 1`.
3. Return sum(s).

Examples → 18, 3. Checked against trying every set for n ≤ 4 and k ≤ 8.

Of each pair (i, k − i), the smaller is always the better one to keep. Taking 1 … n blindly gives example 1 → 15, which uses 1 and 3 that sum to 4.

Time: O(n + k)  
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
